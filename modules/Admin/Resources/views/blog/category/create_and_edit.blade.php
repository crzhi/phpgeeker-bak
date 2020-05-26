@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>分类</cite></a><span lay-separator="">/</span>
	<a><cite>{{ ($category->id ? '编辑': '添加') . '分类' }}</cite></a>
@stop

@section('content')
<div class="layui-card">
    <div class="layui-card-header">添加分类</div>
    <div class="layui-card-body">
        @if($category->id)
            <form class="layui-form" action="{{ route('admin.blog.category.update', ['category'=>$category->id]) }}" method="post" id="AdminForm">
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{ old('id', $category->id) }}">
        @else
            <form class="layui-form" action="{{ route('admin.blog.category.store') }}" method="post" id="AdminForm">
        @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input value="{{ old('title', $category->title) }}" type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">封面</label>
                    <div class="layui-input-block">
                        <div class="upload-preview">
                            @if($category->id)
                                <img src="{{ asset(old('image', $category->image)) }}" height="200">
                            @endif
                        </div>
                        <div class="upload-input">
                            <input type="hidden" name="image"  value="{{ old('image', $category->image) }}">
                            <input type="file" class="pg-upload-btn" />
                            <span class="layui-btn">上传图片</span>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入标题描述" class="layui-textarea">{{ old('description', $category->description) }}</textarea>
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