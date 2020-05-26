@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>文章</cite></a><span lay-separator="">/</span>
	<a><cite>列表</cite></a>
@stop

@section('content')
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">文章列表</div>
                <div class="layui-card-body">
                    <table class="layui-hide"></table>
                    <div class="layui-form layui-border-box layui-table-view">
                        <div class="layui-table-tool">
                            <div class="layui-table-tool-temp">
                                <div class="layui-btn-container">
                                    <a href="{{ route('admin.blog.article.create') }}" class="layui-btn layui-btn-sm">添加文章</a>
                                </div>
                            </div>
                        </div>
                        @if(count($articles))
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                                        <thead>
                                            <tr>
                                                <th data-field="id">
                                                    <div class="layui-table-cell laytable-cell-1"><span>ID</span></div>
                                                </th>
                                                <th data-field="topic">
                                                    <div class="layui-table-cell laytable-cell-2"><span>专题</span></div>
                                                </th>
                                                <th data-field="category">
                                                    <div class="layui-table-cell laytable-cell-3"><span>分类</span></div>
                                                </th>
                                                <th data-field="title">
                                                    <div class="layui-table-cell laytable-cell-4"><span>标题</span></div>
                                                </th>
                                                <th data-field="view">
                                                    <div class="layui-table-cell laytable-cell-5"><span>浏览</span></div>
                                                </th>
                                                <th data-field="comment">
                                                    <div class="layui-table-cell laytable-cell-6"><span>评论</span></div>
                                                </th>
                                                <th data-field="istop">
                                                    <div class="layui-table-cell laytable-cell-7"><span>置顶</span></div>
                                                </th>
                                                <th data-field="">
                                                    <div class="layui-table-cell laytable-cell-8"><span>操作</span></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($articles as $article)
                                                <tr data-index="{{ $article->id }}">
                                                    <td data-field="id">
                                                        <div class="layui-table-cell laytable-cell-1">{{ $article->id }}</div>
                                                    </td>
                                                    <td data-field="topic">
                                                        <div class="layui-table-cell laytable-cell-2">{{ $article->topic->title }}</div>
                                                    </td>
                                                    <td data-field="category">
                                                        <div class="layui-table-cell laytable-cell-3">{{ $article->category->title }}</div>
                                                    </td>
                                                    <td data-field="title">
                                                        <div class="layui-table-cell laytable-cell-4">{{ $article->title }}</div>
                                                    </td>
                                                    <td data-field="view">
                                                        <div class="layui-table-cell laytable-cell-5">{{ $article->view }}</div>
                                                    </td>
                                                    <td data-field="comment">
                                                        <div class="layui-table-cell laytable-cell-6">{{ $article->comment }}</div>
                                                    </td>
                                                    <td data-field="istop">
                                                        <div class="layui-table-cell laytable-cell-7">@if($article->istop)是@endif</div>
                                                    </td>
                                                    <td data-field="">
                                                        <div class="layui-table-cell laytable-cell-8">
                                                            <a href="{{ route('blog.article', ['article'=>$article->id]) }}" target="_blank" class="layui-btn layui-btn-normal layui-btn-xs">查看</a>
                                                            <a href="{{ route('admin.blog.article.edit', ['article'=>$article->id]) }}" class="layui-btn layui-btn-xs">编辑</a>
                                                            <a class="layui-btn layui-btn-danger layui-btn-xs pg-delete-btn" data-href="{{ route('admin.blog.article.delete', ['article'=>$article->id]) }}">删除</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-table-page layui-pagination">
                                {{ $articles->links() }}
                                <div class="layui-box layui-laypage layui-laypage-default">
                                    <span class="layui-laypage-skip">到第
                                        <input type="text" min="1" value="{{ $page }}" class="layui-input">页
                                        <button type="button" class="layui-laypage-btn" data-url="{{ route('admin.blog.article') }}">确定</button>
                                    </span>
                                    <span class="layui-laypage-count">共 {{ $count }} 条</span>
                                    <span class="layui-laypage-limits">
                                        <select lay-ignore="" data-url="{{ route('admin.blog.article') }}">
                                            @for($i = 1; $i < 10; $i++)
                                                <option value="{{ $i * 10}}" @if($paginate == $i * 10) selected="" @endif>{{ $i * 10}} 条/页</option>
                                            @endfor
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <style>
                                .laytable-cell-1{ width: 80px; }
                                .laytable-cell-2{ width: 200px; }
                                .laytable-cell-3{ width: 100px; }
                                .laytable-cell-4{ width: 300px; }
                                .laytable-cell-5{ width: 100px; }
                                .laytable-cell-6{ width: 100px; }
                                .laytable-cell-7{ width: 100px; }
                                .laytable-cell-8{ width: 160px; }
                            </style>
                        @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop