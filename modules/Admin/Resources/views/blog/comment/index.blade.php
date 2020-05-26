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
                        @if(count($comments))
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
                                                <th data-field="article">
                                                    <div class="layui-table-cell laytable-cell-3"><span>文章</span></div>
                                                </th>
                                                <th data-field="user">
                                                    <div class="layui-table-cell laytable-cell-4"><span>用户</span></div>
                                                </th>
                                                <th data-field="date">
                                                    <div class="layui-table-cell laytable-cell-5"><span>日期</span></div>
                                                </th>
                                                <th data-field="">
                                                    <div class="layui-table-cell laytable-cell-6"><span>操作</span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($comments as $comment)
                                                <tr data-index="{{ $comment->id }}">
                                                    <td data-field="id">
                                                        <div class="layui-table-cell laytable-cell-1">{{ $comment->id }}</div>
                                                    </td>
                                                    <td data-field="content">
                                                        <div class="layui-table-cell laytable-cell-2">{{ $comment->content }}</div>
                                                    </td>
                                                    <td data-field="article">
                                                        <div class="layui-table-cell laytable-cell-3">{{ $comment->article->title }}</div>
                                                    </td>
                                                    <td data-field="user">
                                                        <div class="layui-table-cell laytable-cell-4">{{ $comment->user->nickname }}</div>
                                                    </td>
                                                    <td data-field="date">
                                                        <div class="layui-table-cell laytable-cell-5">{{ $comment->created_at }}</div>
                                                    </td>
                                                    <td data-field="">
                                                        <div class="layui-table-cell laytable-cell-6">
                                                            <a href="{{ route('blog.article', ['article'=>$comment->article->id]) }}/#comment-{{ $comment->id }}" target="_blank" class="layui-btn layui-btn-normal layui-btn-xs">查看</a>
                                                            <a class="layui-btn layui-btn-danger layui-btn-xs pg-delete-btn" data-href="{{ route('admin.blog.comment.delete', ['comment'=>$comment->id]) }}">删除</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-table-page layui-pagination">
                                {{ $comments->links() }}
                            </div>
                            <style>
                                .laytable-cell-1{ width: 80px; }
                                .laytable-cell-2{ width: 300px; }
                                .laytable-cell-3{ width: 300px; }
                                .laytable-cell-4{ width: 120px; }
                                .laytable-cell-5{ width: 160px; }
                                .laytable-cell-6{ width: 120px; }
                            </style>
                        @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop