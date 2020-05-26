@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
    <a><cite>博客</cite></a><span lay-separator="">/</span>
    <a><cite>首页</cite></a>
@stop

@section('content')
    <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">信息统计</div>
                    <div class="layui-card-body">
                        <div class="layui-carousel layadmin-carousel layadmin-backlog">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.article') }}" class="layadmin-backlog-body">
                                            <h3>文章总数</h3><p><cite>{{ $article }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.category') }}" class="layadmin-backlog-body">
                                            <h3>分类总数</h3><p><cite>{{ $category }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.tag') }}" class="layadmin-backlog-body">
                                            <h3>标签总数</h3><p><cite>{{ $tag }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.topic') }}" class="layadmin-backlog-body">
                                            <h3>专题总数</h3><p><cite>{{ $topic }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.comment') }}" class="layadmin-backlog-body">
                                            <h3>评论总数</h3><p><cite>{{ $comment }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.message') }}" class="layadmin-backlog-body">
                                            <h3>留言总数</h3><p><cite>{{ $message }}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs6 layui-col-sm4 layui-col-md3">
                                        <a href="{{ route('admin.blog.link') }}" class="layadmin-backlog-body">
                                            <h3>友链总数</h3><p><cite>{{ $link }}</cite></p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop