@extends('mall::layouts.app')

@section('title', '订单评价')

@section('content')
    <div class="layui-container userpublic useradd">
        <div class="layui-row layui-col-space20">
            <p class="layui-hide-xs title">首页 &gt;<span>个人中心</span></p>
            @include('mall::layouts.lib._userSider')
            <div class="layui-col-md10">
                <table id="house-user-order" lay-filter="house-user-order"></table>
                <div class="layui-card">
                    <div class="layui-card-header">订单评价</div>
                    <div class="layui-card-body">
                        <form class="layui-form" method="post" action="{{ route('mall.user.orders.review.store', [$order->id]) }}" id="MallForm">
                            <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                                <thead>
                                <tr>
                                    <th><div class="layui-table-cell"><span>商品详情</span></div></th>
                                    <th><div class="layui-table-cell"><span>评分</span></div></th>
                                    <th><div class="layui-table-cell"><span>评价</span></div></th>
                                </tr>
                                </thead>
                                <tbody class="order-review-box">
                                @foreach($order->items as $index => $item)
                                    <tr style="height: 60px;">
                                        <td align="center">
                                            <div class="layui-table-cell">
                                                <a href="{{ route('mall.products.show', [$item->product_id]) }}" target="_blank">
                                                    <img src="{{ $item->productSku->product->image }}">
                                                    <div class="attribute" style="display: inline-block;text-align: left;vertical-align: top;">
                                                        <p class="title">{{ $item->product->title }}</p>
                                                        <p class="attr">{!! $item->productSku->attrValue() !!}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        @if($order->reviewed)
                                            <td><div class="layui-table-cell order-review-rating-{{ $index }}-readonly">{{ $item->rating }}</div></td>
                                            <td><div class="layui-table-cell">{{ $item->review }}</div></td>
                                        @else
                                            <td>
                                                <div class="layui-table-cell layui-form-item layui-form-text">
                                                    <input type="hidden" name="reviews[{{$index}}][id]" value="{{ $item->id }}">
                                                    <input type="text" class="layui-hide order-review-rating-{{ $index }}" name="reviews[{{$index}}][rating]" lay-verify="required">
                                                    <div class="order-review-rate-{{ $index }}"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="layui-table-cell layui-form-item layui-form-text">
                                                    <textarea name="reviews[{{$index}}][review]" placeholder="" class="layui-textarea" lay-verify="required"></textarea>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3" align="center">
                                        <div class="layui-table-cell">
                                            @if(!$order->reviewed)
                                                <button class="layui-btn" lay-submit="">提交评价</button>
                                            @else
                                                <a href="{{ route('mall.user.orders.show', [$order->id]) }}" class="btn btn-primary">查看订单</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
