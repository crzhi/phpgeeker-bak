@extends('mall::layouts.app')

@section('title', '商品详情')

@section('content')
    <div class="layui-container house-detail">
        <p class="title">
            <a href="{{ route('mall') }}">首页</a>&gt;<a href="/">家居用品</a>&gt;<span>产品详情</span>
        </p>
        <div class="layui-row price">
            <div class="layui-col-sm6">
                <div class="intro-img"><img src="{{ $product->image }}"></div>
                <ul class="thumb">
                        <li><img src="{{ $product->image }}"></li>
                    @foreach(explode(',', $product->pictures) as $picture)
                        <li><img src="{{ $picture }}"></li>
                    @endforeach
                </ul>
            </div>
            <div class="layui-col-sm6 shopChoose">
                <div class="title">
                    <p>
                        <span class="layui-badge">新品</span> {{ $product->title }}
                    </p>
                    <p class="sub-title">{{ $product->sub_title }}</p>
                    <!-- <span>评分<span class="product-rating" title="{{ $product->rating }}">{{ $product->rating }}</span> -->
                </div>
                <p><span>￥<big><b class="product-price">{{ $product->price }}</b></big></span></p>
                @if(count($skuKeys))
                	@foreach($skuKeys as $skuKey)
	                    <dl class="sku-key" data-key="{{ $skuKey->id }}">
	                    	<dt>{{ $skuKey->title }}</dt>
	                    	@if(count($skuKey->skuValues))
		                    	@foreach($skuKey->skuValues as $skuValue)
			                        <dd class="sku-value" data-value="{{ $skuValue->id }}">{{ $skuValue->title }}</dd>
			                    @endforeach
		                    @endif
	                    </dl>
                    @endforeach
                @endif
                <div class="number layui-form">
                    <label>数量</label>
                    <div class="layui-input-inline btn-input">
                        <button class="layui-btn layui-btn-primary sup">-</button>
                        <input type="text" class="layui-input sku_amount" value="1" data-limit="{{ $product->sold_limit }}" data-stock="">
                        <button class="layui-btn layui-btn-primary sub">+</button>
                    </div>
                    <span class="this-stock-box layui-hide" style="margin-left: 10px">库存：<span class="this-stock"></span></span>
                </div>
                <div class="shopBtn">
                    <button class="layui-btn layui-btn-primary sale layui-btn-buy-now" data-url="{{ route('mall.orders.item.confirm') }}">立即购买</button>
                    <button class="layui-btn shop layui-btn-add-to-cart" data-url="{{ route('mall.cart.add') }}">
                        <i class="layui-icon layui-icon-cart"></i>加入购物车
                    </button>
                    <button class="layui-btn layui-btn-primary collect  @if($favored) disfavor @else favor @endif" data-href="{{ route('mall.products.favor', ['product'=>$product->id]) }}">
                        <i class="layui-icon @if($favored) layui-icon-rate-solid @else layui-icon-rate @endif"></i><span id="favor-text">@if($favored)已@endif收藏</span>
                    </button>

                </div>
            </div>
        </div>
        <div class="layui-row layui-col-space30">
            <div class="layui-col-sm8 detailTab">
                <div class="layui-tab layui-tab-brief">
                    <ul class="layui-tab-title">
                        <li class="layui-this">详情</li>
                        <li>评论
                            <span>({{ count($reviews) }})</span>
                        </li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <div class="properties-list">
                                <div class="properties-list-title">产品参数：</div>
                                <ul class="properties-list-body">
                                      @foreach($properties as $name => $values)
                                        <li>{{ $name }}：{{ join(' ', $values) }}</li>
                                      @endforeach
                                </ul>
                            </div>
                            {!! $product->description !!}
                        </div>
                        <div class="layui-tab-item">
                            <div class="comment">
                                <ul class="product-rating-box">
                                    @foreach($reviews as $index=>$review)
                                        <li>
                                            <div class="img">
                                                <img src="{{ $review->order->user->avatar }}">
                                                <span style="font-size:12px">{{ substr_replace(substr($review->order->user->email, 0, strpos($review->order->user->email, '@')), '*****', '1', '-1') }}{{ strrchr($review->order->user->email, '@') }}</span>
                                            </div>
                                            <p class="rating"><span class="product-rating-{{ $index }}">{{ $review->rating }}</span></p>
                                            <p class="sku">
                                                @foreach(json_decode($review->productSku->product_skus_info, true) as $key=>$val)
                                                    <span>{{ $key }}:{{ $val }}</span>
                                                @endforeach
                                            </p>
                                            <p class="txt">{{ $review->review }}</p>
                                            <p class="time">{{ $review->reviewed_at->format('Y-m-d H:i') }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div id="detailList">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($similarProducts))
                <div class="layui-col-sm4 detailCom">
                <p class="title">热销推荐</p>
                <ul class="detailCom-content hot-sell">
                    @foreach($similarProducts as $similarProduct)
                        <li>
                            <a class="text" href="{{ route('mall.products.show', [$similarProduct->id]) }}">
                                <div><img src="{{ $similarProduct->image }}"></div>
                                <p>{{ $similarProduct->title }}</p>
                                <p class="price">￥{{ $similarProduct->price }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
@stop
@section('script')
    <script src="/modules/mall/js/jquery.sku.js"></script>
    <script type="text/javascript">
        var keys = {!! $keys !!};
        var data = {!! $data !!};
        //初始化用户选择事件
        $(function() {
            initSKU();
            // console.log(SKUResult)
            $('.sku-value').each(function() {
                var self = $(this);
                var value_id = self.attr('data-value');
                if(!SKUResult[value_id]) {
                    self.addClass('forbidden');
                }
            }).click(function() {
                var self = $(this);
                if(!self.hasClass('forbidden')) {
                    //选中自己，兄弟节点取消选中
                    self.addClass("active").siblings().removeClass("active");
                    self.append('<i class="layui-icon layui-icon-ok active"></i>');
                    self.siblings().children("i").replaceWith("");
                }
                //已经选择的节点
                var selectedObjs = $('.sku-key .sku-value.active');
                if(selectedObjs.length) {
                    //获得组合key价格
                    var selectedIds = [];
                    selectedObjs.each(function() {
                        selectedIds.push($(this).attr('data-value'));
                    });
                    selectedIds.sort(function(value1, value2) {
                        return parseInt(value1) - parseInt(value2);
                    });
                    var len = selectedIds.length;
                    //显示价格
                    var prices = SKUResult[selectedIds.join(';')].prices;
                    var maxPrice = Math.max.apply(Math, prices);
                    var minPrice = Math.min.apply(Math, prices);
                    $('.product-price').text(maxPrice > minPrice ? minPrice + "-" + maxPrice : maxPrice);
                    //替换介绍图片
                    // var picture = SKUResult[selectedIds.join(';')].picture;
                    // $('.intro-img').find('img').attr('src', picture);
                    // $('.thumb').find('li').removeClass('active');
                    //库存
                    var stock = SKUResult[selectedIds.join(';')].stock;
                    $('.sku_amount').attr('data-stock', stock);
                    $('.this-stock-box').removeClass('layui-hide');
                    $('.this-stock').html(stock);

                    //库存数量
                    $(".house-detail").find(".shopChoose").find(".btn-input").children(".sub").removeClass('not-allowed');
                    var amount = $(".house-detail").find(".shopChoose").find(".btn-input").children("input")[0].value;
                    if(stock && amount - stock > 0) {
                        $(".house-detail").find(".shopChoose").find(".btn-input").children("input")[0].value = stock;
                        $(".house-detail").find(".shopChoose").find(".btn-input").children(".sub").addClass('not-allowed');
                    } else {
                        $(".house-detail").find(".shopChoose").find(".btn-input").children("input")[0].value = 1;
                    }

                    //用已选中的节点验证待测试节点 underTestObjs
                    $(".sku-value").not(selectedObjs).not(self).each(function() {
                        var siblingsSelectedObj = $(this).siblings('.active');
                        var testAttrIds = [];//从选中节点中去掉选中的兄弟节点
                        if(siblingsSelectedObj.length) {
                            var siblingsSelectedObjId = siblingsSelectedObj.attr('data-value');
                            for(var i = 0; i < len; i++) {
                                (selectedIds[i] != siblingsSelectedObjId) && testAttrIds.push(selectedIds[i]);
                            }
                        } else {
                            testAttrIds = selectedIds.concat();
                        }
                        testAttrIds = testAttrIds.concat($(this).attr('data-value'));
                        testAttrIds.sort(function(value1, value2) {
                            return parseInt(value1) - parseInt(value2);
                        });
                        if(!SKUResult[testAttrIds.join(';')]) {
                            $(this).addClass('forbidden').removeClass('active');
                        } else {
                            $(this).removeClass('forbidden');
                        }
                    });
                } else {
                    //设置默认价格
                    $('.product-price').text('--');
                    //设置属性状态
                    $('.sku').each(function() {
                        SKUResult[$(this).attr('data-value')] ? $(this).removeClass('forbidden') : $(this).addClass('forbidden').removeClass('active');
                    })
                }
            });
        });
    </script>
@stop
