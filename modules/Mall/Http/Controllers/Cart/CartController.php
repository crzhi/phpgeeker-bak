<?php

namespace Modules\Mall\Http\Controllers\Cart;

use Modules\Mall\Http\Controllers\MallController;

use Modules\Mall\Http\Requests\AddCartRequest;
use Modules\Mall\Models\ProductSku;
use Modules\Mall\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends MallController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index(Request $request)
    {
        if($user = $request->user()) {
            return view('mall::cart.index',  [
                'cartItems' => $user->cartItems()->with(['productSku.product'])->get(),
            ]);
        }
        return view('mall::cart.index',  [
            'cartItems' => '',
        ]);
    }

    public function add(Request $request)
    {
        if(!($user = $request->user())) {
            return error('请先登录');
        }
        $sku    = $request->input('sku');
        $amount = $request->input('amount');
        $array = [];
        foreach($sku as $key=>$val) {
        	foreach($val as $k=>$v) {
        		$arr = [$val['key']=>$val['value']];
        	}
        	$array = $array + $arr;
        }
        $arr = json_encode($array);
        if($ProductSku = ProductSku::where('product_skus', $arr)->first()) {
        	if ($cart = $user->cartItems()->where('product_sku_id', $ProductSku->id)->first()) {
                if($ProductSku->stock >= ($cart->amount + $amount)) {
    	            $cart->update([
    	                'amount' => $cart->amount + $amount,
    	            ]);
                } else {
                    $cart->update([
                        'amount' => $ProductSku->stock,
                    ]);
                    return success('库存不足');
                }
	        } else {
	            $cart = new CartItem(['amount' => $amount]);
	            $cart->user()->associate($user);
	            $cart->productSku()->associate($ProductSku->id);
	            $cart->save();
	        }
	        return success('添加购物车成功');
        } 
        return error('添加购物车失败');
    }

    public function delete(ProductSku $sku, Request $request)
    {
        $request->user()->cartItems()->where('product_sku_id', $sku->id)->delete();

        return success('移出购物车成功', 'refresh');
    }

    public function deleteMany(Request $request)
    {
        $skuIds = $request->get('skuIds');
        $request->user()->cartItems()->whereIn('product_sku_id', $skuIds)->delete();

        return success('移出购物车成功', 'refresh');
    }

    public function update(ProductSku $sku, Request $request)
    {
        $amount = $request->get('amount');
        $request->user()->cartItems()->where('product_sku_id', $sku->id)->update(['amount'=>$amount]);
        return [];
    }
}