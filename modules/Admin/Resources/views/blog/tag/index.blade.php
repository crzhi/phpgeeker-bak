@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>标签</cite></a><span lay-separator="">/</span>
	<a><cite>列表</cite></a>
@stop

@section('content')
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">标签列表</div>
                <div class="layui-card-body">
                    <table class="layui-hide"></table>
                    <div class="layui-form layui-border-box layui-table-view">
                        <div class="layui-table-tool">
                            <div class="layui-table-tool-temp">
                                <div class="layui-btn-container">
                                    <a href="{{ route('admin.blog.tag.create') }}" class="layui-btn layui-btn-sm">添加标签</a>
                                </div>
                            </div>
                        </div>
                        @if(count($tags))
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                                        <thead>
                                            <tr>
                                                <th data-field="ID">
                                                    <div class="layui-table-cell laytable-cell-1"><span>ID</span></div>
                                                </th>
                                                <th data-field="title">
                                                    <div class="layui-table-cell laytable-cell-2"><span>标签名</span></div>
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
                                            @foreach($tags as $tag)
                                                <tr data-index="{{ $tag->id }}">
                                                    <td data-field="id">
                                                        <div class="layui-table-cell laytable-cell-1">{{ $tag->id }}</div>
                                                    </td>
                                                    <td data-field="title">
                                                        <div class="layui-table-cell laytable-cell-2">{{ $tag->title }}</div>
                                                    </td>
                                                    <td data-field="description">
                                                        <div class="layui-table-cell laytable-cell-3">{{ $tag->description }}</div>
                                                    </td>
                                                    <td data-field="logins">
                                                        <div class="layui-table-cell laytable-cell-4">
                                                            <a href="{{ route('admin.blog.tag.edit', ['tag'=>$tag->id]) }}" class="layui-btn layui-btn-xs">编辑</a>
                                                            <a class="layui-btn layui-btn-danger layui-btn-xs pg-delete-btn" data-href="{{ route('admin.blog.tag.delete', ['tag'=>$tag->id]) }}">删除</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-table-page layui-pagination">
                                {{ $tags->links() }}
                            </div>
                            <style>
                                .laytable-cell-1{ width: 80px; }
                                .laytable-cell-2{ width: 200px; }
                                .laytable-cell-3{ width: 300px; }
                                .laytable-cell-4{ width: 120px; }
                            </style>
                        @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop