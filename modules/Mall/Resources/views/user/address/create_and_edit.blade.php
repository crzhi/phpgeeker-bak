@extends('mall::layouts.app')

@section('title', ($address->id ? '修改': '新增') . '收货地址')

@section('content')
	<div class="layui-container userpublic useradd">
		<div class="layui-row layui-col-space20">
			<p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>	
			@include('mall::layouts.lib._userSider')
			<div class="layui-col-sm10">
				<div class="address-class" style="border: 1px solid #e6e6e6;height: 400px">
					<div class="layui-layer-title" style="background-color: #f2f2f2;height: 75px;line-height: 75px;">
						{{ ($address->id ? '修改': '新增') . '收货地址' }}
					</div>
					@if($address->id)
						<form class="layui-form" action="{{ route('mall.user.address.update', ['address' => $address->id]) }}" id="MallForm" method="post">
							{{ method_field('PUT') }}
					@else
						<form class="layui-form" action="{{ route('mall.user.address.store') }}" id="MallForm" method="post">
					@endif
							<div class="layui-form" lay-filter="useradd-iframe" id="useradd-iframe" style="padding: 30px 40px 0 20px;">
								<div class="layui-form-item">
									<label class="layui-form-label"><span>*</span>所在地区：</label>
									<div class="layui-input-inline">
										<select lay-verify="required" name="province">
											<option value="">请选择</option>
										</select>
									</div>
									<div class="layui-input-inline">
										<select lay-verify="required" name="city" id="city">
											<option value="">请选择</option>
										</select>
									</div>
									<div class="layui-input-inline">
										<select lay-verify="required" name="district" id="district">
											<option value="">请选择</option>
										</select>
									</div>
									<script type="text/javascript">
									</script>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label"><span>*</span>详细地址：</label>
									<div class="layui-input-block">
										<textarea lay-verify="required" placeholder="详细地址，街道、门牌号等" class="layui-textarea" name="address">{{ old('address', $address->address) }}</textarea>
									</div>
								</div>
								<div class="layui-form-item">
									<label class="layui-form-label"><span>*</span>收货人：</label>
									<div class="layui-input-inline">
										<input type="text" required lay-verify="required" class="layui-input" name="contact_name" value="{{ old('contact_name', $address->contact_name) }}">
									</div>
									<label class="layui-form-label telephone"><span>*</span>手机号码：</label>
									<div class="layui-input-inline">
										<input type="text" required lay-verify="required|phone" class="layui-input" name="contact_phone" value="{{ old('contact_phone', $address->contact_phone) }}">
									</div>
								</div>
								<input class="checkdef" type="checkbox" lay-skin="primary" title="设为默认" value="1" @if(isset($address) && $address->is_default == 1) checked @endif name="is_default">
								<div class="layui-form-item" style="padding: 0;padding-bottom: 20px;text-align: center;">
									<input type="submit" lay-submit lay-filter="useradd-submit" id="useradd-submit" value="确认" style="width: 160px;
    height: 42px;
    background-color: #e8d6c0;
    border: none;
    font-size: 18px;
    line-height: 42px;
    display: inline-block;
    vertical-align: top;color: #fff;    
    /*height: 28px;*/
    /*line-height: 28px;*/
    margin: 5px 5px 0;
    padding: 0 15px;
    /*border: 1px solid #dedede;*/
    /*background-color: #fff;*/
    /*color: #333;*/
    border-radius: 2px;
    font-weight: 400;
    cursor: pointer;
    text-decoration: none;">
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
<script type="text/javascript">
    address_pcd("{{ route('mall.user.address.region') }}","{{ old('province', $address->province) }}","{{ old('city', $address->city) }}","{{ old('district', $address->district) }}" )
</script>
@stop
