@extends('passport::layouts.app')

@section('title', '注册')

@section('content')
    @section('sub_title', '注册')
    <form method="POST" action="{{ route('register') }}" id="form">
        @csrf
        <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
            <input type="text" name="email" autocomplete="off" placeholder="邮箱" class="layui-input">
        </div>
        <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-password"></label>
            <input type="password" name="password" autocomplete="off" placeholder="密码" class="layui-input"></div>
        <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-password"></label>
            <input type="password" name="password_confirmation" autocomplete="off" placeholder="确认密码" class="layui-input">
        </div>
        <div class="layui-form-item">
            <div class="layui-row">
                <div class="layui-col-xs7">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"></label>
                    <input type="text" name="captcha" placeholder="图形验证码" class="layui-input">
                </div>
                <div class="layui-col-xs5">
                    <div class="captcha">
                        <img src="{{ Captcha::src() }}" class="layadmin-user-login-codeimg" onclick="this.src='{{captcha_src()}}'+Math.random()">
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid">注 册</button>
        </div>
    </form>
@stop

@section('where')
    <a href="{{ route('login') }}" class="layadmin-user-jump-change layadmin-link">登录</a>    
@stop