@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>分类</cite></a><span lay-separator="">/</span>
	<a><cite>列表</cite></a>
@stop

@section('content')
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">分类列表</div>
                <div class="layui-card-body">
                    <table class="layui-hide"></table>
                    <div class="layui-form layui-border-box layui-table-view">
                        <div class="layui-table-tool">
                            <div class="layui-table-tool-temp">
                                <div class="layui-btn-container">
                                    <a href="{{ route('admin.blog.category.create') }}" class="layui-btn layui-btn-sm">添加分类</a>
                                    <a href="{{ route('admin.blog.category.trashed') }}" class="layui-btn layui-btn-sm layui-btn-danger">回收站</a>
                                </div>
                            </div>
                        </div>
                        @if(count($categories))
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                                        <thead>
                                            <tr>
                                                <th data-field="id">
                                                    <div class="layui-table-cell laytable-cell-1"><span>ID</span></div>
                                                </th>
                                                <th data-field="title">
                                                    <div class="layui-table-cell laytable-cell-2"><span>分类名</span></div>
                                                </th>
                                                <th data-field="description">
                                                    <div class="layui-table-cell laytable-cell-3"><span>描述</span></div>
                                                </th>
                                                <th data-field="">
                                                    <div class="layui-table-cell laytable-cell-4"><span>操作</span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                                <tr data-index="{{ $category->id }}">
                                                    <td data-field="id">
                                                        <div class="layui-table-cell laytable-cell-1">{{ $category->id }}</div>
                                                    </td>
                                                    <td data-field="title">
                                                        <div class="layui-table-cell laytable-cell-2">{{ $category->title }}</div>
                                                    </td>
                                                    <td data-field="description">
                                                        <div class="layui-table-cell laytable-cell-3">{{ $category->description }}</div>
                                                    </td>
                                                    <td data-field="">
                                                        <div class="layui-table-cell laytable-cell-4">
                                                            <a href="{{ route('admin.blog.category.edit', ['category'=>$category->id]) }}" class="layui-btn layui-btn-xs">编辑</a>
                                                            <a class="layui-btn layui-btn-danger layui-btn-xs pg-delete-btn" data-href="{{ route('admin.blog.category.delete', ['category'=>$category->id]) }}">删除</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-table-page layui-pagination">
                                {{ $categories->links() }}
                            </div>
                            <style>
                                .laytable-cell-1{ width: 80px; }
                                .laytable-cell-2{ width: 200px; }
                                .laytable-cell-3{ width: 500px; }
                                .laytable-cell-4{ width: 120px; }
                            </style>
                        @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop