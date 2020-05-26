@extends('mall::layouts.app')

@section('title', '购物车')

@section('content')
<div class="layui-container house-usershop">
	@if($cartItems && count($cartItems))
		<table id="house-usershop-table"></table>
		<div class="layui-form layui-border-box layui-table-view cart-box">
			<div class="layui-table-box">
				<div class="layui-table-body layui-table-main">
					<table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
						<thead>
							<tr>
								<th class="layui-table-col-special">
									<div class="check-item layui-cart-check-all" style="">
										<i class="layui-icon layui-icon-ok layui-hide"></i>
									</div>
								</th>
								<th class="layui-table-col-special">
									<div class="layui-table-cell" align="center"><span>商品</span></div>
								</th>
								<th class="layui-table-col-special">
									<div class="layui-table-cell" align="center"><span>单价</span></div>
								</th>
								<th class="layui-table-col-special">
									<div class="layui-table-cell" align="center"><span>数量</span></div>
								</th>
								<th class="layui-table-col-special">
									<div class="layui-table-cell" align="center"><span>小计</span></div>
								</th>
								<th class="layui-table-col-special">
									<div class="layui-table-cell" align="center"><span>操作</span></div>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cartItems as $item)
								<tr data-id="{{ $item->id }}">
									<td class="layui-table-cell layui-table-col-special">
										<div>
											<div class="check-item layui-cart-check-this" data-id="{{ $item->productSku->id }}" data-url="{{ route('mall.cart.deletemany') }}">
												<i class="layui-icon layui-icon-ok layui-hide"></i>
											</div>
										</div>
									</td>
									<td align="center" class="layui-table-col-special">
										<div class="layui-table-cell">
											<a href="{{ route('mall.products.show',['product'=>$item->productSku->product->id]) }}" target="_blank">
												<img src="{{ $item->productSku->product->image }}">
												<div class="attribute">
													<p class="title">{{ $item->productSku->product->title }}</p>
													<p class="attr">{!! $item->productSku->attrValue() !!}</p>
												</div>
											</a>
										</div>
									</td>
									<td align="center" class="layui-table-col-special">
										<div class="layui-table-cell">
											<p>￥<span class="item-price">{{ $item->productSku->price }}</span></p>
										</div>
									</td>
									<td align="center" class="layui-table-col-special">
										<div class="layui-table-cell">
											<div class="numVal">
												<button class="layui-btn layui-btn-primary sup">-</button>
												<input type="text" class="layui-input" value="{{ $item->amount }}" data-limit="{{ $item->productSku->product->sold_limit }}" data-stock="{{ $item->productSku->stock }}" data-url="{{ route('mall.cart.update', ['sku'=>$item->productSku->id]) }}">
												<button class="layui-btn layui-btn-primary sub">+</button>
											</div>
										</div>
									</td>
									<td align="center" class="layui-table-col-special">
										<div class="layui-table-cell laytable-cell-3-0-4">
											<p class="sku-total">￥<span class="item-total">{{ $item->productSku->price * $item->amount }}</span></p>
										</div>
									</td>
									<td align="center" class="layui-table-col-special">
										<div class="layui-table-cell">
											<a data-href="{{ route('mall.cart.delete', ['sku'=>$item->productSku->id]) }}" onclick="deleteTips($(this))">删除</a>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="house-usershop-table-num layui-form">
			<div class="check-item layui-cart-check-all">
				<i class="layui-icon layui-icon-ok layui-hide"></i>
			</div>
			<span class="checked-amount">已选(<span class="numal">0</span>)件</span>
			<a id="batchDel">批量删除</a>
			<!-- <p id="total">合计: ￥<span>0.00</span></p> -->
			<div id="toCope">
				<p>应付：<span>￥<big>0.00</big></span></p>
				<!-- <span>满减￥20，包邮</span> -->
			</div>
			<button class="layui-btn layui-cart-calculate" data-url="{{ route('mall.orders.cart.confirm') }}">结算</button>
		</div>
	@else
	    <div class="cart-empty">
	        <div class="m-emptyStatus">
	            <div class="w-icon-empty icon-empty-cart"></div>
	            <div class="emptyText">购物车还是空滴</div>
	            <p class="btnLine" align="center">
                    @guest
                        <a href="{{ route('login') }}" class="w-button-login">登录</a>
                    @endguest
	                <a class="w-button-ghost" href="{{ route('mall') }}">继续逛</a>
	            </p>
	        </div>
	    </div>
	@endif
	<p>猜您喜欢</p>
	<ul class="house-usershop-like">
		<li>
			<a href="detail.html">
				<div><img src="../res/static/img/paging_img5.jpg"></div>
				<p>可爱小瓷杯子</p>
				<p class="price">￥200</p>
			</a>
		</li>
	</ul>
</div>
@stop
