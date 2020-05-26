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
                <div class="layui-card-header">评论列表</div>
                <div class="layui-card-body">
                    <table class="layui-hide"></table>
                    <div class="layui-form layui-border-box layui-table-view">
                        <div class="layui-table-tool">
                            <div class="layui-table-tool-temp">
                                <div class="layui-btn-container"></div>
                            </div>
                        </div>
                        @if(count($messages))
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                                        <thead>
                                            <tr>
                                                <th data-field="id">
                                                    <div class="layui-table-cell laytable-cell-1"><span>ID</span></div>
                                                </th>
                                                <th data-field="content">
                                                    <div class="layui-table-cell laytable-cell-2"><span>内容</span></div>
                                                </th>
                                                <th data-field="user">
                                                    <div class="layui-table-cell laytable-cell-3"><span>用户</span></div>
                                                </th>
                                                <th data-field="date">
                                                    <div class="layui-table-cell laytable-cell-4"><span>日期</span></div>
                                                </th>
                                                <th data-field="">
                                                    <div class="layui-table-cell laytable-cell-5"><span>操作</span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($messages as $message)
                                                <tr data-index="{{ $message->id }}">
                                                    <td data-field="id">
                                                        <div class="layui-table-cell laytable-cell-1">{{ $message->id }}</div>
                                                    </td>
                                                    <td data-field="content">
                                                        <div class="layui-table-cell laytable-cell-2">{{ $message->content }}</div>
                                                    </td>
                                                    <td data-field="user">
                                                        <div class="layui-table-cell laytable-cell-3">{{ $message->user->nickname }}</div>
                                                    </td>
                                                    <td data-field="date">
                                                        <div class="layui-table-cell laytable-cell-4">{{ $message->created_at }}</div>
                                                    </td>
                                                    <td data-field="">
                                                        <div class="layui-table-cell laytable-cell-5">
                                                            <a href="{{ route('blog.message') }}/#comment-{{ $message->id }}" target="_blank" class="layui-btn layui-btn-normal layui-btn-xs">查看</a>
                                                            <a class="layui-btn layui-btn-danger layui-btn-xs pg-delete-btn" data-href="{{ route('admin.blog.message.delete', ['message'=>$message->id]) }}">删除</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-table-page layui-pagination">
                                {{ $messages->links() }}
                            </div>
                            <style>
                                .laytable-cell-1{ width: 80px; }
                                .laytable-cell-2{ width: 600px; }
                                .laytable-cell-3{ width: 200px; }
                                .laytable-cell-4{ width: 160px; }
                                .laytable-cell-5{ width: 120px; }
                            </style>
                        @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop