@extends('mall::layouts.app')

@section('title', '订单管理')

@section('content')
	<div class="layui-container userpublic useradd">
		<div class="layui-row layui-col-space20">
			<p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>	
			@include('mall::layouts.lib._userSider')
			<div class="layui-col-sm10">
				<div class="layui-tab layui-tab-brief">
					<ul class="layui-tab-title">
						<li class="layui-this">全部订单</li>
					<!-- 	<li>等待发货</li>
						<li>已发货</li>
						<li>交易完成</li> -->
					</ul>
					<div class="layui-tab-content">
						<div class="layui-tab-item layui-show">
							<table id="house-user-order" lay-filter="house-user-order"></table>
							<div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-2" lay-id="house-user-order" style=" ">
								<div class="layui-table-box">
									<div class="layui-table-body">
										@if(count($orders))
											@foreach($orders as $order)
                                                <div class="layui-table-cell" style="margin-top: 20px;background:#f2f2f2;">
                                                    <span>订单号：{{ $order->no }}</span>
                                                    <span style="float: right;">交易时间：{{ $order->created_at->format('Y-m-d H:i:s') }}</span>
                                                </div>
                                                <table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
													<thead>
														<tr>
															<th><div class="layui-table-cell" align="center"><span>订购商品</span></div></th>
															<th><div class="layui-table-cell" align="center"><span>单价</span></div></th>
															<th><div class="layui-table-cell" align="center"><span>件数</span></div></th>
															<th><div class="layui-table-cell" align="center"><span>总价</span></div></th>
															<th><div class="layui-table-cell" align="center"><span>订单状态</span></div></th>
															<th><div class="layui-table-cell" align="center"><span>订单操作</span></div></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td align="center">
																@foreach($order->items as $index => $item)
																	<div class="layui-table-cell" style="text-align: center;">
																		<a href="{{ route('mall.products.show', [$item->product_id]) }}" target="_blank">
																			<img src="{{ $item->productSku->product->image }}">
																			<div class="attribute" style="display: inline-block;text-align: left;vertical-align: top;">
																				<p class="title">{{ $item->product->title }}</p>
																				<p class="attr">{!! $item->productSku->attrValue() !!}</p>
																			</div>
																		</a>
																	</div>
																@endforeach
															</td>
															<td align="center">
																@foreach($order->items as $index => $item)
																	<div class="layui-table-cell">￥{{ $item->price }}</div>
																@endforeach
															</td>
															<td align="center">
																@foreach($order->items as $index => $item)
																	<div class="layui-table-cell">{{ $item->amount }}</div>
																@endforeach
															</td>
															<td align="center">
																<div>
																	<div>
																		<p>￥{{ $order->total_amount }}</p>
																		<!-- <p>免运费</p> -->
																	</div>
																</div>
															</td>
															<td align="center">
																<div class="order-status">
                                                                    @if($order->paid_at)
                                                                        <span>已支付</span>
                                                                        @if($order->ship_status ===  \Modules\Mall\Models\Order::SHIP_STATUS_PENDING)
                                                                            <span>待发货</span>
                                                                        @endif
                                                                        @if($order->ship_status ===  \Modules\Mall\Models\Order::SHIP_STATUS_DELIVERED)
                                                                            <span>待收货</span>
                                                                        @endif
                                                                        @if($order->ship_status ===  \Modules\Mall\Models\Order::SHIP_STATUS_RECEIVED)
                                                                            <span>已收货</span>
                                                                            @if($order->reviewed)
                                                                                <span>已评价</span>
                                                                            @else
                                                                                <span>待评价</span>
                                                                            @endif
                                                                        @endif
                                                                        @if($order->refund_status !== \Modules\Mall\Models\Order::REFUND_STATUS_PENDING)
                                                                        	<span title="退款理由：{{ $order->extra['refund_reason'] }}">{{ \Modules\Mall\Models\Order::$refundStatusMap[$order->refund_status] }}</span>
                                                                        @endif
                                                                        @if(isset($order->extra['refund_disagree_reason']))
                                                                        	<span title="拒绝退款理由：{{ $order->extra['refund_disagree_reason'] }}">拒绝退款</span>
                                                                        @endif
                                                                    @elseif($order->closed)
                                                                        <span>已关闭</span>
                                                                    @else
                                                                        未支付<br>
                                                                        请于 {{ $order->created_at->addSeconds(config('app.order_ttl'))->format('H:i') }} 前完成支付<br>
                                                                        否则订单将自动关闭
                                                                    @endif
													            </div>
															</td>
															<td align="center">
																<div>
																	<div class="order-optimize">
																		@if(!$order->paid_at && !$order->closed)
																			<a href="{{ route('mall.pay.alipay', ['order' => $order->id]) }}">支付</a>
																		@endif
                                                                       <a href="{{ route('mall.user.orders.show', ['order' => $order->id]) }}">查看订单</a>
                                                                       @if($order->ship_status ===  \Modules\Mall\Models\Order::SHIP_STATUS_DELIVERED)
                                                                            <a class="order-receive" data-url="{{ route('mall.user.orders.received', [$order->id]) }}">确认收货</a>
																		@endif
                                                                        @if($order->ship_status ===  \Modules\Mall\Models\Order::SHIP_STATUS_RECEIVED)
                                                                            <a href="{{ route('mall.user.orders.review.show', [$order->id]) }}">
                                                                                @if($order->reviewed)查看评价@else评价@endif
                                                                            </a>
                                                                        @endif
                                                                        @if($order->paid_at && $order->refund_status === \Modules\Mall\Models\Order::REFUND_STATUS_PENDING)
																            <a class="order-apply-refund" onclick="refund($(this))" data-url="{{ route('mall.user.orders.apply_refund', [$order->id]) }}">申请退款</a>
																        @endif
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											@endforeach
										@endif
									</div>
								</div>
                                <div class="house-list">{{ $orders->render() }}</div>
							</div>
						</div>
						<div class="layui-tab-item">
							2
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
        $('.order-receive').on('click', function(){
            var url=$(this).data('url');
            $.post(url,function(data){
                tips(data);
            })
        })
    </script>
	
<script type="text/javascript">
	function refund(_this) {
		var url = _this.data('url');
		layer.prompt({title: '请输入申请退款理由', formType: 2}, function(reason, index){
			layer.close(index);
			$.post(url, {reason:reason}, function(data){
				tips(data);
			})	
		});
	}																			
</script>
@stop
