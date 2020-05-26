@extends('mall::layouts.app')

@section('title', '购物车')

@section('content')
	<div class="layui-container house-usershop">
		<table id="house-usershop-table" lay-filter="house-usershop-table"></table>
		<div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-3" lay-id="house-usershop-table" style=" ">
			<div class="layui-table-box">
				<div class="layui-table-header">
					<table class="layui-table" lay-skin="line" cellspacing="0" cellpadding="0" border="0">
						<thead>
							<tr>
								<th data-field="0" data-key="3-0-0" data-unresize="true" class=" layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-0 laytable-cell-checkbox">
										<input type="checkbox" name="layTableCheckbox" lay-skin="primary" lay-filter="layTableAllChoose">
										<div class="layui-unselect layui-form-checkbox" lay-skin="primary">
											<i class="layui-icon layui-icon-ok"></i>
										</div>
									</div>
								</th>
								<th data-field="1" data-key="3-0-1" data-minwidth="260" class=" layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-1" align="center">
										<span>商品</span></div>
								</th>
								<th data-field="2" data-key="3-0-2" data-minwidth="160" class=" layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-2" align="center">
										<span>单价</span></div>
								</th>
								<th data-field="3" data-key="3-0-3" class=" layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-3" align="center">
										<span>数量</span></div>
								</th>
								<th data-field="4" data-key="3-0-4" class=" layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-4" align="center">
										<span>小计</span></div>
								</th>
								<th data-field="5" data-key="3-0-5" class=" layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-5" align="center">
										<span>操作</span></div>
								</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="layui-table-body layui-table-main">
					<table class="layui-table" lay-skin="line" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr data-index="0" class="">
								<td data-field="0" data-key="3-0-0" class="layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-0 laytable-cell-checkbox">
										<input type="checkbox" name="layTableCheckbox" lay-skin="primary">
										<div class="layui-unselect layui-form-checkbox" lay-skin="primary">
											<i class="layui-icon layui-icon-ok"></i>
										</div>
									</div>
								</td>
								<td data-field="1" data-key="3-0-1" data-content="" data-minwidth="260" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-1">
										<div>
											<img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=948415864,1373067741&amp;fm=27&amp;gp=0.jpg">
											<div style="display: inline-block; text-align: left; vertical-align: top;">
												<p>大风力智能电吹风</p>
												<p>粉色 1500W</p>
											</div>
										</div>
									</div>
								</td>
								<td data-field="2" data-key="3-0-2" data-content="" data-minwidth="160" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-2">
										<p>
											<span class="price">￥189.00</span>
											<del>￥280.00</del></p>
									</div>
								</td>
								<td data-field="3" data-key="3-0-3" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-3">
										<div class="numVal">
											<button class="layui-btn layui-btn-primary sup">-</button>
											<input type="text" class="layui-input" value="1">
											<button class="layui-btn layui-btn-primary sub">+</button></div>
									</div>
								</td>
								<td data-field="4" data-key="3-0-4" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-4">
										<span class="total" style="color: #cd2d15;">￥189.00</span></div>
								</td>
								<td data-field="5" data-key="3-0-5" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-5">
										<a lay-event="del">删除</a></div>
								</td>
							</tr>
							<tr data-index="1" class="">
								<td data-field="0" data-key="3-0-0" class="layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-0 laytable-cell-checkbox">
										<input type="checkbox" name="layTableCheckbox" lay-skin="primary">
										<div class="layui-unselect layui-form-checkbox" lay-skin="primary">
											<i class="layui-icon layui-icon-ok"></i>
										</div>
									</div>
								</td>
								<td data-field="1" data-key="3-0-1" data-content="" data-minwidth="260" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-1">
										<div>
											<img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=948415864,1373067741&amp;fm=27&amp;gp=0.jpg">
											<div style="display: inline-block; text-align: left; vertical-align: top;">
												<p>大风力智能电吹风</p>
												<p>粉色 1500W</p>
											</div>
										</div>
									</div>
								</td>
								<td data-field="2" data-key="3-0-2" data-content="" data-minwidth="160" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-2">
										<p>
											<span class="price">￥189.00</span>
											<del>￥280.00</del></p>
									</div>
								</td>
								<td data-field="3" data-key="3-0-3" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-3">
										<div class="numVal">
											<button class="layui-btn layui-btn-primary sup">-</button>
											<input type="text" class="layui-input" value="2">
											<button class="layui-btn layui-btn-primary sub">+</button></div>
									</div>
								</td>
								<td data-field="4" data-key="3-0-4" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-4">
										<span class="total" style="color: #cd2d15;">￥378.00</span></div>
								</td>
								<td data-field="5" data-key="3-0-5" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-5">
										<a lay-event="del">删除</a></div>
								</td>
							</tr>
							<tr data-index="2" class="">
								<td data-field="0" data-key="3-0-0" class="layui-table-col-special">
									<div class="layui-table-cell laytable-cell-3-0-0 laytable-cell-checkbox">
										<input type="checkbox" name="layTableCheckbox" lay-skin="primary">
										<div class="layui-unselect layui-form-checkbox" lay-skin="primary">
											<i class="layui-icon layui-icon-ok"></i>
										</div>
									</div>
								</td>
								<td data-field="1" data-key="3-0-1" data-content="" data-minwidth="260" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-1">
										<div>
											<img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=948415864,1373067741&amp;fm=27&amp;gp=0.jpg">
											<div style="display: inline-block; text-align: left; vertical-align: top;">
												<p>大风力智能电吹风</p>
												<p>粉色 1500W</p>
											</div>
										</div>
									</div>
								</td>
								<td data-field="2" data-key="3-0-2" data-content="" data-minwidth="160" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-2">
										<p>
											<span class="price">￥189.00</span>
											<del>￥280.00</del></p>
									</div>
								</td>
								<td data-field="3" data-key="3-0-3" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-3">
										<div class="numVal">
											<button class="layui-btn layui-btn-primary sup">-</button>
											<input type="text" class="layui-input" value="3">
											<button class="layui-btn layui-btn-primary sub">+</button></div>
									</div>
								</td>
								<td data-field="4" data-key="3-0-4" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-4">
										<span class="total" style="color: #cd2d15;">￥567.00</span></div>
								</td>
								<td data-field="5" data-key="3-0-5" data-content="" class="layui-table-col-special" align="center">
									<div class="layui-table-cell laytable-cell-3-0-5">
										<a lay-event="del">删除</a></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<style>.laytable-cell-3-0-0{ width: 50px; }.laytable-cell-3-0-1{ }.laytable-cell-3-0-2{ }.laytable-cell-3-0-3{ width: 150px; }.laytable-cell-3-0-4{ width: 120px; }.laytable-cell-3-0-5{ width: 100px; }</style></div>
		<div class="house-usershop-table-num layui-form">
			<input type="checkbox" lay-skin="primary">
			<div class="layui-unselect layui-form-checkbox" lay-skin="primary">
				<i class="layui-icon layui-icon-ok"></i>
			</div>
			<span class="numal">已选 0 件</span>
			<a id="batchDel">批量删除</a>
			<p id="total">合计: ￥
				<span>0.00</span></p>
			<div id="toCope">
				<p>应付：
					<big>￥0.00</big></p>
				<span>满减￥20，包邮</span></div>
			<button class="layui-btn">结算</button></div>
	</div>
@stop