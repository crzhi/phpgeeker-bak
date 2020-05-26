@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>友情链接</cite></a><span lay-separator="">/</span>
	<a><cite>{{ ($link->id ? '修改': '新增') . '链接' }}</cite></a>
@stop

@section('content')
<div class="layui-card">
    <div class="layui-card-header">新增链接</div>
    <div class="layui-card-body">
        @if($link->id)
            <form class="layui-form" action="{{ route('admin.blog.link.update', ['link'=>$link->id]) }}" method="post" id="AdminForm">
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{ old('id', $link->id) }}">
        @else
            <form class="layui-form" action="{{ route('admin.blog.link.store') }}" method="post" id="AdminForm">
        @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input value="{{ old('title', $link->title) }}" type="text" name="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接</label>
                    <div class="layui-input-block">
                        <input value="{{ old('url', $link->url) }}" type="text" name="url" autocomplete="off" placeholder="请输入链接" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图标</label>
                    <div class="layui-input-block">
                        <div class="upload-preview">
                            @if($link->id)
                                <img src="{{ asset(old('ico', $link->ico)) }}" height="200">
                            @endif
                        </div>
                        <div class="upload-input">
                            <input type="hidden" name="ico"  value="{{ old('ico', $link->ico) }}">
                            <input type="file" class="pg-upload-btn" />
                            <span class="layui-btn">上传图片</span>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入链接描述" class="layui-textarea">{{ old('description', $link->description) }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <div class="layui-footer">
                            <button class="layui-btn">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@stop