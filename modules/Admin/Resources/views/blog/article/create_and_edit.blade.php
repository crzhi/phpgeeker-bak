@extends('admin::layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/static/editormd/css/editormd.min.css') }}" />
@stop

@section('left')
    @include('admin::layouts.lib.left._blog')
@stop

@section('nav')
	<a><cite>博客</cite></a><span lay-separator="">/</span>
	<a><cite>文章</cite></a><span lay-separator="">/</span>
	<a><cite>{{ ($article->id ? '编辑': '添加') . '文章' }}</cite></a>
@stop

@section('content')
<div class="layui-card">
    <div class="layui-card-header">添加文章</div>
    <div class="layui-card-body">
        @if($article->id)
            <form class="layui-form" action="{{ route('admin.blog.article.update', ['article'=>$article->id]) }}" method="post" id="AdminForm">
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{ old('id', $article->id) }}">
        @else
            <form class="layui-form" action="{{ route('admin.blog.article.store') }}" method="post" id="AdminForm">
        @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input value="{{ old('title', $article->title) }}" type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">专题</label>
                        <div class="layui-input-block">
                            @if(count($topics))
                                <select name="topic_id" lay-filter="aihao">
                                    <option value="">请选择专题</option>
                                    @foreach($topics as $topic)
                                        <option value="{{ $topic->id }}" @if($topic->id == $article->topic_id) selected="" @endif>{{ $topic->title }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">分类</label>
                        <div class="layui-input-block">
                            @if(count($categories))
                                <select name="category_id" lay-filter="aihao">
                                    <option value="">请选择分类</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $article->category_id) selected="" @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">标签</label>
                    <div class="layui-input-block">
                        @if(count($tags))
                            @foreach($tags as $tag)
                                <input type="checkbox" name="tag[{{ $tag->id }}]" title="{{ $tag->title }}" @foreach($article->tags as $articleTag) @if($articleTag->id == $tag->id) checked="" @endif @endforeach>
                            @endforeach
                        @endif
                        <!-- <div class="layui-btn layui-btn-sm"><i class="layui-icon layui-icon-add-1"></i></div> -->
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">封面</label>
                    <div class="layui-input-block">
                        <div class="upload-preview">
                            @if($article->id)
                                <img src="{{ asset(old('cover', $article->cover)) }}" height="200">
                            @endif
                        </div>
                        <div class="upload-input">
                            <input type="hidden" name="cover"  value="{{ old('cover', $article->cover) }}">
                            <input type="file" class="pg-upload-btn" />
                            <span class="layui-btn">上传图片</span>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否置顶</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="istop" lay-skin="switch" lay-text="是|否" value="1" @if($article->istop) checked @endif>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" placeholder="请输入内容，如不输入，则截取文章前200字" class="layui-textarea">{{ old('description', $article->description) }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">文章</label>
                    <div class="layui-input-block">                    
                        <div id="editormd">
                            <textarea name="markdown">{{ old('markdown', $article->markdown) }}</textarea>
                        </div>
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

@section('script')
    <script src="{{ asset('/static/editormd/editormd.js') }}"></script>
    <script type="text/javascript">
        var editor;
        $(function() {
            editor = editormd("editormd", {
                path : "{{ asset('/static/editormd/lib/') }}/",
                height : 400,
                name: 'description',
                toc       : true,
                autoFocus : false,
                todoList  : true,
                placeholder: "填写文章内容",
                toolbarAutoFixed: false,
                toolbarIcons : ['undo', 'redo', 'datetime', 'bold', 'del', 'italic', 'quote', 'ucwords', 'uppercase', 'lowercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'image', 'code', 'code-block', 'table', 'html-entities', 'watch', 'preview', 'search', 'fullscreen'],
                imageUpload: true,
                imageUploadURL : "{{ route('admin.blog.article.uploadImg') }}",
            });
        });
    </script>
@stop