@extends('mall::layouts.app')

@section('title', '首页')

@section('content')
    <!-- 定义分类菜单和banner图 -->
    <div class="layui-banner">
        <div class="home_container layui-row">
            <!-- 定义分类栏 -->
            <div class="menu_list layui-col-xs2">
                @if(isset($categoryTree))
                    <ul>
                        @foreach($categoryTree as $category)
                            @if(isset($category['children']) && count($category['children']) > 0)
                                <li>
                                    <a href="{{ route('mall.products.index', ['category_id'=>$category['id']]) }}">{{ $category['title'] }}<span class="arrow">&gt;</span></a>
                                    <div class="menu_list_item">
                                        <ul class="menu_list_goods menu_col_4">
                                            @foreach($category['children'] as $category)
                                                <li>
                                                    <a href="{{ route('mall.products.index', ['category_id'=>$category['id']]) }}">
                                                        <img src="{{ $category['picture'] }}" alt="">
                                                        <span>{{ $category['title'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
            <!-- 结束分类栏 -->
            <!-- 定义banner -->
            <div id="banner" class="layui-col-xs12">
                <div class="layui-carousel house-carousel" id="house-carousel">
                    <div carousel-item>
                        @if(count($banners))
                            @foreach($banners as $k=>$banner)
                                <div>
                                    <a href="{{ $banner->image_url }}"><img src="{{ $banner->image_src }}"></a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- 结束banner -->
        </div>
    </div>
    <!-- 结束分类菜单和banner图 -->
    <div class="layui-container">
        @if(count($hotCategories))
            <div class="hot-cate">
                <p class="house-title">热门分类</p>
                <div class="layui-row">
                    @foreach($hotCategories as $hotCategory)
                        <div class="layui-col-xs4 cateFir cate">
                            <a href="{{ route('mall.products.index', ['category_id'=>$hotCategory->id]) }}">
                                <img src="{{ $hotCategory->picture }}">
                                <div>
                                    <p>{{ $hotCategory->title }}</p>
                                    <span></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($hotProducts))
        <div class="hot-sell">
            <p class="house-title">热销推荐<a href="{{ route('mall.products.index') }}">更多优品 &gt;</a></p>
            <div class="layui-row layui-col-space20">
                @foreach($hotProducts as $hotProduct)
                    <a href="{{ route('mall.products.show',['product'=>$hotProduct->id]) }}" class="layui-col-xs3 text">
                        <div><img src="{{ $hotProduct->image }}"></div>
                        <p>{{ $hotProduct->title }}</p>
                        <p class="price">￥{{ $hotProduct->price }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <a class="layui-fulid" id="goodsAll" href="{{ route('mall.products.index') }}"></a>
@stop
