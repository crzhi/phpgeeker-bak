<?php

namespace Modules\Mall\Http\Controllers\Orders;

use Modules\Mall\Http\Controllers\MallController;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Modules\Mall\Models\Order;
use Modules\Mall\Models\CartItem;
use Modules\Mall\Models\ProductSku;
use Modules\Mall\Models\UserAddress;
use Modules\Mall\Jobs\CloseOrder;
use Modules\Mall\Exceptions\InvalidRequestException;

class OrdersController extends MallController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 购物车下单
    *
    * @access public 
    * @param
    * @return view
    */
    public function cartConfirm(Request $request)
    {
        $items = $request->except('_token');
        $cartItems = CartItem::whereIn('id', $items)->get();
        if(!count($cartItems)) {
            return redirect()->route('mall.cart');
        }
        $addresses = $request->user()->addresses()->orderBy('is_default', 'desc')->orderBy('last_used_at', 'desc')->get();
    	return view('mall::orders.cart_confirm',  [
    		'addresses' => $addresses,
            'cartItems' => $cartItems
        ]);
    }

    /**
    * 立即购买下单
    *
    * @access public 
    * @param
    * @return view
    */
    public function itemConfirm(Request $request)
    {
        $user   = $request->user();
        $sku    = json_decode($request->input('sku'), true);
        $amount = $request->input('amount');
        $array = [];
        foreach($sku as $key=>$val) {
            foreach($val as $k=>$v) {
                $arr = [$val['key'] => (string)$val['value']];
            }
            $array = $array + $arr;
        }
        $skus = json_encode($array);
        $productSku = ProductSku::where('product_skus', $skus)->first();
        $addresses = $request->user()->addresses()->orderBy('is_default', 'desc')->orderBy('last_used_at', 'desc')->get();
        return view('mall::orders.item_confirm',  [
            'addresses' => $addresses,
            'amount' => $amount,
            'productSku' => $productSku
        ]);
    }

    public function store(Request $request)
    {
        if(!$request->input('address_id')) {
            return error('请选择收货地址');
        }
        $user  = $request->user();
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $request) {
            $address = UserAddress::find($request->input('address_id'));
            // 更新此地址的最后使用时间
            $address->update(['last_used_at' => Carbon::now()]);
            // 创建一个订单
            $order   = new Order([
                'address'      => [ // 将地址信息放入订单中
                    'address'       => $address->full_address,
                    // 'zip'           => $address->zip,
                    'contact_name'  => $address->contact_name,
                    'contact_phone' => $address->contact_phone,
                ],
                'remark'       => $request->input('remark'),
                'total_amount' => 0,
            ]);
            // 订单关联到当前用户
            $order->user()->associate($user);
            // 写入数据库
            $order->save();

            $totalAmount = 0;
            $items       = $request->input('items');
            // 遍历用户提交的 SKU
            foreach ($items as $data) {
                $sku  = ProductSku::find($data['sku_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price'  => $sku->price,
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('该商品库存不足');
                }
            }

            // 更新订单总金额
            $order->update(['total_amount' => $totalAmount]);

            // 将下单的商品从购物车中移除
            $skuIds = collect($items)->pluck('sku_id');
            $user->cartItems()->whereIn('product_sku_id', $skuIds)->delete();

            return $order;
        });

        $this->dispatch(new CloseOrder($order, config('app.order_ttl')));

        return success('订单生成成功，请尽快支付', route('mall.pay.type', ['order' => $order->id]));
    }
}
