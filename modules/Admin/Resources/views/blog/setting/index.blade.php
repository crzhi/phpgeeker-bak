@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>设置</cite></a>
@stop

@section('content')
    <div class="layui-card">
    <div class="layui-card-header">网站设置</div>
    <div class="layui-card-body">
        <form class="layui-form" action="{{ route('admin.blog.setting.update') }}" method="post" id="AdminForm">
            {{ method_field('PUT') }}
            <input type="hidden" name="id" value="{{ $set->id }}">
            <div class="layui-form-item">
                <label class="layui-form-label">网站名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="{{ $set->name }}" lay-verify="required|title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站LOGO</label>
                <div class="layui-input-block">
                    <div class="upload-preview">
                        <img src="{{ asset($set->logo) }}" height="200">
                    </div>
                    <div class="upload-input">
                        <input type="hidden" name="logo" value="{{ $set->logo }}">
                        <input type="file" class="pg-upload-btn">
                        <span class="layui-btn">上传图片</span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="{{ $set->title }}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站关键字</label>
                <div class="layui-input-block">
                    <textarea name="keywords"  placeholder="请输入内容" class="layui-textarea">{{ $set->keywords }}</textarea>
                </div>
            </div>           
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网站描述</label>
                <div class="layui-input-block">
                    <textarea name="description" placeholder="请输入内容" class="layui-textarea">{{ $set->description }}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">ICP备案</label>
                <div class="layui-input-block">
                    <input type="text" name="icp" value="{{ $set->icp }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员名</label>
                <div class="layui-input-block">
                    <input type="text" name="admin_name" value="{{ $set->admin_name }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员签名</label>
                <div class="layui-input-block">
                    <input type="text" name="admin_slogan" value="{{ $set->admin_slogan }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员头像</label>
                <div class="layui-input-block">
                    <div class="upload-preview">
                        <img src="{{ asset($set->admin_avatar) }}" height="200">
                    </div>
                    <div class="upload-input">
                        <input type="hidden" name="admin_avatar" value="{{ $set->admin_avatar }}">
                        <input type="file" class="pg-upload-btn">
                        <span class="layui-btn">上传图片</span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="text" name="email" value="{{ $set->email }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">github</label>
                <div class="layui-input-block">
                    <input type="text" name="github_name" value="{{ $set->github_name }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">github地址</label>
                <div class="layui-input-block">
                    <input type="text" name="github_url" value="{{ $set->github_url }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">QQ群</label>
                <div class="layui-input-block">
                    <input type="text" name="qqgroup" value="{{ $set->qqgroup }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">QQ群地址</label>
                <div class="layui-input-block">
                    <input type="text" name="qqgroup_url" value="{{ $set->qqgroup_url }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">微信公众号</label>
                <div class="layui-input-block">
                    <input type="text" name="wechat" value="{{ $set->wechat }}" lay-verify="title" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">微信公众号二维码</label>
                <div class="layui-input-block">
                    <div class="upload-preview">
                        <img src="{{ asset($set->wechat_qrcode) }}" height="200">
                    </div>
                    <div class="upload-input">
                        <input type="hidden" name="wechat_qrcode" value="{{ $set->wechat_qrcode }}">
                        <input type="file" class="pg-upload-btn">
                        <span class="layui-btn">上传图片</span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <div class="layui-footer">
                        <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop