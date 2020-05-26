<?php

namespace Modules\Mall\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Mall\Models\Order;
use Modules\Mall\Http\Controllers\MallController;
use Modules\Mall\Policies\OrderPolicy;
use Modules\Mall\Events\OrderReviewed;

class OrdersController extends MallController
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
        $orders = Order::query()
            // 使用 with 方法预加载，避免N + 1问题
            ->with(['items.product', 'items.productSku']) 
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('mall::user.orders.index', ['orders' => $orders]);
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function show(Order $order, Request $request)
    {
        $this->authorize('own', $order);
        return view('mall::user.orders.show', [
            'order' => $order->load(['items.productSku', 'items.product'])
        ]);
    }

    /**
     * 首页
     *
     * @access public
     * @param
     * @return view
     */
    public function received(Order $order, Request $request)
    {
        // 校验权限
        $this->authorize('own', $order);

        // 判断订单的发货状态是否为已发货
        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            return error('发货状态不正确');
        }

        // 更新发货状态为已收到
        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        // 返回原页面
        return success('确认收货成功', 'refresh');
    }

    public function review(Order $order)
    {
        // 校验权限
        $this->authorize('own', $order);
        // 判断是否已经支付
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可评价');
        }
        // 使用 load 方法加载关联数据，避免 N + 1 性能问题
        return view('mall::user.orders.review', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    public function sendReview(Order $order, Request $request)
    {
        // 校验权限
        $this->authorize('own', $order);
        if (!$order->paid_at) {
            return error('该订单未支付，不可评价');
        }
        // 判断是否已经评价
        if ($order->reviewed) {
            return error('该订单已评价，不可重复提交');
        }
        $reviews = $request->input('reviews');
        // 开启事务
        \DB::transaction(function () use ($reviews, $order) {
            // 遍历用户提交的数据
            foreach ($reviews as $review) {
                $orderItem = $order->items()->find($review['id']);
                // 保存评分和评价
                $orderItem->update([
                    'rating'      => $review['rating'],
                    'review'      => $review['review'],
                    'reviewed_at' => Carbon::now(),
                ]);
            }
            // 将订单标记为已评价
            $order->update(['reviewed' => true]);
            event(new OrderReviewed($order));
        });

        return success('评价成功', 'refresh');
    }

    public function applyRefund(Order $order, Request $request)
    {
        // 校验订单是否属于当前用户
        $this->authorize('own', $order);
        // 判断订单是否已付款
        if (!$order->paid_at) {
            return error('该订单未支付，不可退款');
        }
        // 判断订单退款状态是否正确
        if ($order->refund_status !== Order::REFUND_STATUS_PENDING) {
            return error('该订单已经申请过退款，请勿重复申请');
        }
        // 将用户输入的退款理由放到订单的 extra 字段中
        $extra                  = $order->extra ?: [];
        $extra['refund_reason'] = $request->input('reason');
        // 将订单退款状态改为已申请退款
        $order->update([
            'refund_status' => Order::REFUND_STATUS_APPLIED,
            'extra'         => $extra,
        ]);

        return success('申请退款成功', 'refresh');

        return $order;
    }
}
