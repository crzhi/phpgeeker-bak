@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>友情链接</cite></a><span lay-separator="">/</span>
	<a><cite>列表</cite></a>
@stop

@section('content')
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">链接列表</div>
                <div class="layui-card-body">
                    <table class="layui-hide"></table>
                    <div class="layui-form layui-border-box layui-table-view">
                        <div class="layui-table-tool">
                            <div class="layui-table-tool-temp">
                                <div class="layui-btn-container">
                                    <a href="{{ route('admin.blog.link.create') }}" class="layui-btn layui-btn-sm">添加链接</a>
                                </div>
                            </div>
                        </div>
                        @if(count($links))
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                                        <thead>
                                            <tr>
                                                <th data-field="ID">
                                                    <div class="layui-table-cell laytable-cell-1"><span>ID</span></div>
                                                </th>
                                                <th data-field="title">
                                                    <div class="layui-table-cell laytable-cell-2"><span>标题</span></div>
                                                </th>
                                                <th data-field="url">
                                                    <div class="layui-table-cell laytable-cell-3"><span>链接</span></div>
                                                </th>
                                                <th data-field="description">
                                                    <div class="layui-table-cell laytable-cell-4"><span>描述</span></div>
                                                </th>
                                                <th data-field="">
                                                    <div class="layui-table-cell laytable-cell-5"><span>操作</span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($links as $link)
                                                <tr data-index="{{ $link->id }}">
                                                    <td data-field="id">
                                                        <div class="layui-table-cell laytable-cell-1">{{ $link->id }}</div>
                                                    </td>
                                                    <td data-field="title">
                                                        <div class="layui-table-cell laytable-cell-2">{{ $link->title }}</div>
                                                    </td>
                                                    <td data-field="url">
                                                        <div class="layui-table-cell laytable-cell-3">{{ $link->url }}</div>
                                                    </td>
                                                    <td data-field="description">
                                                        <div class="layui-table-cell laytable-cell-4">{{ $link->description }}</div>
                                                    </td>
                                                    <td data-field="logins">
                                                        <div class="layui-table-cell laytable-cell-5">
                                                            <a href="{{ route('admin.blog.link.edit', ['link'=>$link->id]) }}" class="layui-btn layui-btn-xs">编辑</a>
                                                            <a class="layui-btn layui-btn-danger layui-btn-xs pg-delete-btn" data-href="{{ route('admin.blog.link.delete', ['link'=>$link->id]) }}">删除</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-table-page layui-pagination">
                                {{ $links->links() }}
                            </div>
                            <style>
                                .laytable-cell-1{ width: 80px; }
                                .laytable-cell-2{ width: 200px; }
                                .laytable-cell-3{ width: 300px; }
                                .laytable-cell-4{ width: 300px; }
                                .laytable-cell-5{ width: 120px; }
                            </style>
                        @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop