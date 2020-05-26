@extends('admin::layouts.app')

@section('left')
    @include('admin::layouts.lib.left._wechat')
@stop

@section('nav')
    <a><cite>微信</cite></a><span lay-separator="">/</span>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop