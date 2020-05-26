@extends('mall::layouts.app')

@section('title', '确认订单')

@section('content')
	<div class="layui-container order-confirm">
        <div class="layui-row">
            <div class="layui-col-sm12">
                <div class="layui-card">
                    <div class="layui-card-header">收货信息</div>
                	<div class="layui-card-body">
            			<div class="layui-form row">
        					@if(count($addresses))
            					@foreach($addresses as $k=>$address)
	            					<div class="address-box @if($k==0) address-active @else layui-hide @endif" data-id="{{ $address->id }}">
					                	<p class="contact_name">
					                		<span class="title">联系人</span>：{{ $address->contact_name }}
	            							@if($address->is_default) <span id="default" class="right">默认地址</span> @endif
	            						</p>
					                	<p class="contact_phone"><span class="title">联系电话</span>：{{ $address->contact_phone }}</p>
					                	<p class="address"><span class="title">收货地址</span>：{{ $address->getFullAddressAttribute() }}{{ $address->address }}</p>
					                </div>
					            @endforeach
					        @else
					        	你还没有收货地址，去<a href="/user/address">添加→</a>
					        @endif
                		</div>
    					@if(count($addresses))
				        	<span class="address-more">更多地址↓</span>
				        @endif
                    </div>
                </div>
            </div>
            <div class="layui-col-sm12 house-usershop">
				<table id="house-usershop-table"></table>
				<div class="layui-form layui-border-box layui-table-view confirm-box">
					<div class="layui-table-box">
						<div class="layui-table-body layui-table-main">
							<table class="layui-table" lay-skin="line">
								<thead>
									<tr>
										<th><div class="layui-table-cell" align="center"><span>商品</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>单价</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>数量</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>小计</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>实付</span></div></th>
									</tr>
								</thead>
								<tbody>
									<tr class="item-box" data-id="{{ $productSku->id }}">
										<td align="center">
											<div class="layui-table-cell">
												<div>
													<img src="{{ $productSku->product->image }}">
													<div class="div-center">
														<p>{{ $productSku->product->title }}</p>
														<p>{!! $productSku->attrValue() !!}</p>
													</div>
												</div>
											</div>
										</td>
										<td align="center">
											<div class="layui-table-cell">
												<p>
													<span class="price">￥{{ $productSku->price }}</span>
												</p>
											</div>
										</td>
										<td align="center">
											<div class="layui-table-cell">
												<div>
													<span class="amount">{{ $amount }}</span>
												</div>
											</div>
										</td>
										<td align="center">
											<div class="layui-table-cell">
												<span class="calculate">￥{{ $productSku->price * $amount }}</span>
											</div>
										</td>
										<td align="center">
											<div class="layui-table-cell">
												<p class="order-sku-totals">￥<span class="order-sku-total">{{ $productSku->price * $amount }}</span></p>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="house-usershop-table-num layui-form order-confrim-total">
					<div class="order-confrim-cal">
						<div class="order-confrim-box">
							<p>商品合计：<span class="total-costs">￥<span class="total-cost">0.00</span></span></p><br>
							<p>运费：<span class="trans-cost">￥<span class="trans-cost">0.00</span></span></p><br>
							<p>应付总额：<span class="pay-costs">￥<span class="pay-cost">0.00</span></span></p><br>
						</div>
					</div>
					<button class="layui-btn layui-order-pay-btn" data-order="{{ route('mall.orders.store') }}">去支付</button>
				</div>
            </div>
        </div>
    </div>
@stop
@section('script')
	<script type="text/javascript">
	    //下单-计算金额
	     var skuTotal = $(".house-usershop").find(".confirm-box").find(".order-sku-total"),
	        totalCost = $(".house-usershop").find(".order-confrim-total").find(".total-cost"),
	        payCost = $(".house-usershop").find(".order-confrim-total").find(".pay-cost"),
	        total = 0;
	    skuTotal.each(function(){
	        total += parseInt($(this).html());
	    })
	    totalCost.html(total.toFixed(2));
	    payCost.html(total.toFixed(2));
	</script>
@stop