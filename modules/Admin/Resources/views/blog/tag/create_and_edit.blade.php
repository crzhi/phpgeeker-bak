@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>标签</cite></a><span lay-separator="">/</span>
	<a><cite>{{ ($tag->id ? '修改': '新增') . '标签' }}</cite></a>
@stop

@section('content')
<div class="layui-card">
    <div class="layui-card-header">新增标签</div>
    <div class="layui-card-body">
        @if($tag->id)
            <form class="layui-form" action="{{ route('admin.blog.tag.update', ['tag'=>$tag->id]) }}" method="post" id="AdminForm">
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{ old('id', $tag->id) }}">
        @else
            <form class="layui-form" action="{{ route('admin.blog.tag.store') }}" method="post" id="AdminForm">
        @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input value="{{ old('title', $tag->title) }}" type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入标题描述" class="layui-textarea">{{ old('description', $tag->description) }}</textarea>
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