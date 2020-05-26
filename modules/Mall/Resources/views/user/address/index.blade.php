@extends('mall::layouts.app')

@section('title', '地址列表')

@section('content')
	<div class="layui-container userpublic useradd">
		<div class="layui-row layui-col-space20">
			<p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>	
			@include('mall::layouts.lib._userSider')
			<div class="layui-col-sm10">
				<table class="layui-table" id="user-address" lay-filter="user-address"></table>
				<div class="layui-form layui-border-box layui-table-view">
					<div class="layui-table-box">
						<div class="layui-table-body layui-table-main">
							<table cellspacing="0" cellpadding="0" border="0" class="layui-table" lay-skin="line">
								<thead>
									<tr>
										<th><div class="layui-table-cell laytable-cell-space" align="center"><span></span></div></th>
										<th><div class="layui-table-cell" align="center"><span>收货人</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>地址</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>联系方式</span></div></th>
										<th><div class="layui-table-cell" align="center"><span>操作</span></div></th>
									</tr>
								</thead>
								<tbody>
									@if(count($addresses))
										@foreach($addresses as $address)
											<tr data-index="0">
												<td align="center" class="layui-table-col-special">
													<div class="layui-table-cell laytable-cell-space">
														@if($address->is_default)<span id="default">默认</span>@endif
													</div>
												</td>
												<td align="center">
													<div class="layui-table-cell">{{ $address->contact_name }}</div>
												</td>
												<td align="center">
													<div class="layui-table-cell">{{ $address->getFullAddressAttribute() }}</div>
												</td>
												<td align="center">
													<div class="layui-table-cell">{{ $address->contact_phone }}</div>
												</td>
												<td align="center" data-content="" class="layui-table-col-special">
													<div class="layui-table-cell laytable-cell-1-0-4">
														<a data-href="/user/address/delete/{{ $address->id }}" onclick="deleteTips($(this))" style="color: #e39d55; margin-right: 15px; cursor: pointer;">删除</a>
														<a href="{{ route('mall.user.address.edit', ['address' => $address->id]) }}" style="color: #e39d55; cursor: pointer;">编辑</a>
													</div>
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
                <a href="/user/address/create">
                    <button class="layui-btn layui-btn-primary address-add"><i class="layui-icon layui-icon-add-1">添加按钮</i></button>
                </a>
			</div>
		</div>
	</div>
@stop
