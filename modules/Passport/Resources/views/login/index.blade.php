@extends('passport::layouts.app')

@section('title', '登录')

@section('content')
    @section('sub_title', '登录')
    <form action="{{ route('login.do') }}" method="post" id="form">
        @csrf
        <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
            <input type="text" name="email" placeholder="邮箱" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-password"></label>
            <input type="password" name="password" placeholder="密码" autocomplete="off" class="layui-input">
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
        <div class="layui-form-item login-tips">
            <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
                <span>记住密码</span><i class="layui-icon layui-icon-ok"></i>
            </div>
            <a href="javascript:;" class="layadmin-user-jump-change layadmin-link login-forget">忘记密码？</a>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid layui-btn-login">登 入</button>
        </div>
    </form>
@stop
@section('where')
    <a href="{{ route('register') }}" class="layadmin-user-jump-change layadmin-link passport-where">注册</a>    
@stop