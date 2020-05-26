@extends('mall::layouts.app')

@section('title', '商品')

@section('content')
    <div class="layui-container house-list">
        <p class="classify">
            <a href="{{ route('mall.products.index') }}">全部</a>
            <span> &gt;</span>
            @if ($category)
                @foreach($category->ancestors as $ancestor)
                    <a href="{{ route('mall.products.index', ['category_id' => $ancestor->id]) }}">{{ $ancestor->title }}</a>
                    <span> &gt;</span>
                @endforeach
                <span class="category">{{ $category->title }}</span>
                <span> &gt;</span>
                <input type="hidden" name="category_id" value="{{ $category->id }}">
            @endif
        </p>
        <!-- <div class="list-banner"></div> -->
        <div class="filter">
            <div>
                <span>排序：</span>
                <ul id="order">
                    <li>
                        <a href="/products"><span @if(!request('order')) class="active" @endif>默认</span></a>
                    </li>
                    <li class="order-select price">
                        <a href="/products?order=price_asc"><span @if(request('order') == 'price_asc') class="active" @endif>价格↑</span></a>
                    </li>
                    <li class="order-select price">
                        <a href="/products?order=price_desc"><span @if(request('order') == 'price_desc') class="active" @endif>价格↓</span></a>
                    </li>
                    <li class="order-select sold_count">
                        <a href="/products?order=sold_count_desc"><span @if(request('order') == 'old_count_desc') class="active" @endif>销量↓</span></a>
                    </li>
                    <li class="order-select rating">
                        <a href="/products?order=rating_desc"><span @if(request('order') == 'rating_desc') class="active" @endif>评分↓</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="layui-row layui-col-space25">
            @if(count($products))
                @foreach($products as $product)
                    <div class="layui-col-xs6 layui-col-sm3">
                        <div class="list-detail">
                            <div class="img"><a href="{{ route('mall.products.show',['product'=>$product->id]) }}"><img src="{{ $product->image }}"></a></div>
                            <p class=price><span>￥</span>{{ $product->price }}</p>
                            <p class="title"><a href="{{ route('mall.products.show',['product'=>$product->id]) }}">{{ $product->title }}</a></p>
                            <p class="sub-title">{{ $product->sub_title }}</p>
                            <p class="other">
                                <span class="rating">评分:{{ $product->rating }}</span>
                                <span class="sold_count">{{ $product->sold_count }}人付款</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="house-list">{{ $products->appends($filters)->render() }}</div>
    </div>
@stop
@section('script')
    <script>
        var filters = {!! json_encode($filters) !!};
        $(document).ready(function () {
            $('.search-input[name=search]').val(filters.search);
            $('.search-form select[name=order]').val(filters.order);
            $('.order-select').on('click', function(){
                var search = $('.search-input').val();
                var url = $('.search-input').data('url');
            })
        })
    </script>
@stop