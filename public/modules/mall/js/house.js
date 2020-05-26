layui.define(['element', 'carousel', 'table', 'util'],
function(exports) {
    var $ = layui.$,
    element = layui.element,
    form = layui.form,
    carousel = layui.carousel,
    laypage = layui.laypage,
    util = layui.util,
    table = layui.table,
    rate = layui.rate;

    //ajaxForm
    $('#MallForm').ajaxForm(function(data) {
        tips(data);
    });

    var commentCount = $('.product-rating-box li').length;
    if(commentCount) {
        for(i=0;i<commentCount;i++) {
            commentRate(i);
        }
    };
    function commentRate(i){
        var value = $('.product-rating-' + i).text();
        var ins12 = rate.render({
            elem: '.product-rating-' + i,  //绑定元素
            value: value,
            readonly:true,
        });
    };

    var reviewCount = $('.order-review-box tr').length;
    if(reviewCount) {
        for(i=0;i<reviewCount;i++) {
            orderRating(i);
            orderRate(i);
        }
    };
    function orderRating(i){
        var ins12 = rate.render({
            elem: '.order-review-rate-' + i,  //绑定元素
            theme: '#dbbb92',
            readonly:false,
            choose: function(value){
                console.log(i)
                $('.order-review-rating-' + i).attr('value', value)
            }
        });
    };
    function orderRate(i){
        var value = $('.order-review-rating-' + i + '-readonly').text();
        var ins11 = rate.render({
            elem: '.order-review-rating-' + i + '-readonly',  //绑定元素
            value: value,
            theme: '#dbbb92',
            readonly:true,
    });
    }
    //首页-轮播图
    var elemBanner = $('#house-carousel'),
    ins1 = carousel.render({
        elem: elemBanner,
        width: '100%',
        height: elemBanner.height() + 'px',
        arrow: 'hover',
        interval: 10000
    });
    $(window).on('resize', function() {
        var width = $(this).prop('innerWidth');
        ins1.reload({
            height: (width > 768 ? 460 : 150) + 'px'
        });
    });

    //首页——搜索
    $(".house-header").find("#search").on('click', function() {
        layer.open({
            type: 1,
            title: false,
            shadeClose: true,
            area: '300px',
            content: '<div id="house-search" class="layui-form"><input type="text" placeholder="搜索好物" class="layui-input"></div>',
            success: function(layero, index) {
                $("#house-search").find("input").on('keydown',
                function(e) {
                    if (e.keyCode === 13) {
                        e.preventDefault();
                        layer.close(index);
                    }
                });
            }
        });
    });
    $('.layui-icon-search').on('click',function(){
        var search = $('.search-input').val();
        var url = $('.search-input').data('url');
        window.location.href = url + '?search=' + search;
    })

    //详情页—图片选择
    var imgDetail = $(".house-detail").find(".intro-img").children("img")[0],
    srcDetail = $(imgDetail).attr("src"),
    ulDetail = $(".house-detail").find(".thumb");
    ulDetail.children("li").each(function() {
        $(this).on('click', function() {
            imgDetail.src = $(this).children("img")[0].src;
            $(this).addClass('active').siblings().removeClass('active')
        })
    });

    //详情页—数量选择
    var btnDetail = $(".house-detail").find(".shopChoose").find(".btn-input").children("button"),
    supBtn = $(".house-detail").find(".shopChoose").find(".btn-input").children(".sup"),
    subBtn = $(".house-detail").find(".shopChoose").find(".btn-input").children(".sub"),
    inpDetail = $(".house-detail").find(".shopChoose").find(".btn-input").children("input"),
    // tipDetail = $(".house-detail").find(".shopChoose").find(".number").children(".inputTips"),
    limit = inpDetail.attr('data-limit'),
    change = function() {
        var stock = inpDetail.attr('data-stock');
        subBtn.removeClass('not-allowed');
        if(inpDetail[0].value > 1) {
            supBtn.removeClass('not-allowed');
        }
        if(typeof stock == "undefined" || stock == null || stock == "" || stock - limit >= 0) {
            if(inpDetail[0].value - limit >= 0) {
                inpDetail[0].value = limit;
                subBtn.addClass('not-allowed');
                layer.msg('单品已达上限');  
            }
        } else {
            if(stock - 0 > 0 && inpDetail[0].value - stock >= 0) {
                inpDetail[0].value = stock;
                subBtn.addClass('not-allowed');
                layer.msg('商品库存不足');           
            }
        } 
    };
    //商品数量增减
    btnDetail.each(function(index) {
        $(this).on('click', function() {
            if (index == "1") {
                supBtn.removeClass('not-allowed');
                inpDetail.val(Number(inpDetail.val()) + 1);
            } else {
                if(inpDetail[0].value <= 1) {
                    inpDetail[0].value = 1;
                    layer.msg('本商品一件起售');
                    supBtn.addClass('not-allowed');
                }
                inpDetail[0].value = inpDetail[0].value > 1 ? inpDetail[0].value - 1 : 1;
            };
            change();
        })
    });
    //商品数量输入
    inpDetail.on('keyup', function(e) {
        if(this.value.length==1){
            this.value=this.value.replace(/[^1-9]/g,'')
        } else {
            this.value=this.value.replace(/\D/g,'')
        }
        change();
    });

    //详情页—收藏/取消收藏
    $(".house-detail").find(".shopChoose").find(".collect").on('click', function() {
        var _this = $(this);
        var url = _this.attr('data-href');
        if (_this.hasClass('disfavor')) {
            _this.removeClass('disfavor');
            $.post(url, {_method: 'delete'}, function(data) {
                tips(data);
                if (data.status == 'success') {
                    _this.removeClass('disfavor').addClass('favor');
                    _this.find(".layui-icon").addClass("layui-icon-rate").removeClass("layui-icon-rate-solid");
                    _this.find("#favor-text").text('收藏');
                }
            })
        } else {
            _this.removeClass('favor');
            // $.post(url, function(data) {
            //     tips(data);
            //     if (data.status == 'success') {
            //         _this.addClass('disfavor').removeClass('favor');
            //         _this.find(".layui-icon").addClass("layui-icon-rate-solid").removeClass("layui-icon-rate");
            //         _this.find("#favor-text").text('已收藏');
            //     }
            // })

            $.ajax({
                 type: "POST",
                 url: url,
                 contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                 data: {},
                 dataType: "json",
                 success: function(data){
                            tips(data);
                            _this.addClass('disfavor').removeClass('favor');
                            _this.find(".layui-icon").addClass("layui-icon-rate-solid").removeClass("layui-icon-rate");
                            _this.find("#favor-text").text('已收藏');
                        },
                 error:function(e){
                            layer.msg('请先登录');
                 }
            });
        }
    });

    //详情页-商品评分
    rate.render({
        elem: '.product-rating',
        length: '5',
        half: true,
        readonly: true,
        value:$('.product-rating').text(),
    });

    //个人中心-我的收藏
    $(".house-usercol").find(".layui-tab-content").find(".goods").each(function() {
        $(this).children(".del").on('click', function() {
            var _this = $(this), url = _this.attr('data-href');
            layer.confirm('是否确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function() {
                $.post(url, {_method: 'delete'}, function(data) {
                    if (data.status = 'success') {
                        tips(data);
                        _this.parent("div").parent("div").remove();
                    }
                })
            });
        });
    });

    //购物车商品增减
    var cartTotal = $(".house-usershop").find("#toCope").children("p").children("span").children("big"),
        cartNum = $(".house-usershop-table-num").children('.checked-amount').children(".numal"),
        itemCheck = $('.layui-cart-check-this'),
        itemBtn = $(".house-usershop").find(".cart-box").find(".numVal").children("button"),
        itemSupBtn = $(".house-usershop").find(".cart-box").find(".numVal").children(".sup"),
        itemSubBtn = $(".house-usershop").find(".cart-box").find(".numVal").children(".sub"),
        itemInput = $(".house-usershop").find(".cart-box").find(".numVal").children("input"),
        itemPrice = $(".house-usershop").find(".cart-box").find(".item-price"),
        itemTotal = $(".house-usershop").find(".cart-box").find(".item-total"),
        // goodsVal = $(".house-usershop").find("#total").children("span"),
        // copyTips = $(".house-usershop").find("#toCope").children("span"),

        itemChange = function(j) {
            var itemStock = itemInput.eq(j).attr('data-stock'),
                itemLimit = itemInput.eq(j).attr('data-limit'),
                itemUrl = itemInput.eq(j).attr('data-url'),
                itemCost = total = 0;
            itemSubBtn.eq(j).removeClass('not-allowed');
            if(itemInput.eq(j).val() > 1) {
                itemSupBtn.eq(j).removeClass('not-allowed');
            }
            if(itemStock - itemLimit >= 0) {
                if(itemInput.eq(j).val() - itemLimit > 0) {
                    itemInput.eq(j).val(itemLimit);
                    itemSubBtn.eq(j).addClass('not-allowed');
                    layer.msg('单品已达上限');
                    return ;
                }
            } else {
                if(itemInput.eq(j).val() - itemStock > 0) {
                    itemInput.eq(j).val(itemStock) ;
                    itemSubBtn.eq(j).addClass('not-allowed');
                    layer.msg('商品库存不足');
                    return ;
                }
            }
            itemCost = itemPrice.eq(j).html() * itemInput.eq(j).val();
            itemTotal.eq(j).html(itemCost);
            if(itemCheck.eq(j).hasClass('checked')) {
                itemCheck.each(function(index){
                    if(itemCheck.eq(index).hasClass('checked')) {
                        var cost = itemTotal.eq(index).html();
                        var amount = itemInput.eq(index).val();
                        total += parseInt(cost);
                        i += parseInt(amount);
                    }           
                })
                cartNum.html(i);
                cartTotal.html(total.toFixed(2));
            }
            var amount = itemInput.eq(j).val();
            $.post(itemUrl, {amount: amount}, function(){

            })
        };

    //购物车-全选
    $('.layui-cart-check-all').on('click', function(){
        var self = $('.layui-cart-check-all');
        if(self.hasClass('checked')) {
            self.removeClass('checked');
            self.find('i').addClass('layui-hide');
            $('.layui-cart-check-this').each(function(){
                var _this = $(this);
                _this.removeClass('checked');
                _this.find('i').addClass('layui-hide');
            });
            cartNum.html(0);
            cartTotal.html('0.00');
        } else {
            var total = i = 0;
            self.addClass('checked');
            self.find('i').removeClass('layui-hide');
            itemCheck.each(function(index){                
                var cost = itemTotal.eq(index).html();
                var amount = itemInput.eq(index).val();
                $(this).addClass('checked');
                $(this).find('i').removeClass('layui-hide');
                total += parseInt(cost);
                i += parseInt(amount);
            })
            cartNum.html(i);
            cartTotal.html(total.toFixed(2));
        }
    });

    //购物车-单选
    itemCheck.each(function(index){
        $(this).on('click', function(){
            var self = $(this),
                num = $('.layui-cart-check-this').length;
            if(self.hasClass('checked')) {
                self.removeClass('checked');
                self.find('i').addClass('layui-hide');
                var cost = itemTotal.eq(index).html();
                var amount = itemInput.eq(index).val();
                var costs = parseInt(cartTotal.html()) - parseInt(cost),
                    amounts = parseInt(cartNum.html()) - parseInt(amount);
                cartNum.html(amounts);
                cartTotal.html(costs.toFixed(2));
                var no = $('.layui-cart-check-this.checked').length;
            } else {
                var total = i = 0;
                self.addClass('checked');
                self.find('i').removeClass('layui-hide');
                var cost = itemTotal.eq(index).html();
                var amount = itemInput.eq(index).val();
                var costs = parseInt(cost) + parseInt(cartTotal.html()),
                    amounts = parseInt(amount) + parseInt(cartNum.html());
                cartNum.html(amounts);
                cartTotal.html(costs.toFixed(2));
                var no = $('.layui-cart-check-this.checked').length;
            }
            if(no == num) {
                $('.layui-cart-check-all').addClass('checked');
                $('.layui-cart-check-all').find('i').removeClass('layui-hide');
            } else {
                $('.layui-cart-check-all').removeClass('checked');
                $('.layui-cart-check-all').find('i').addClass('layui-hide');
            }
        });        
    })

    //购物车-商品增减
    itemBtn.each(function(index) {
        $(this).on('click', function() {
            var self = $(this);
            var i = index%2, j = parseInt(index/2);
            if (i == "1") {
                itemSupBtn.eq(j).removeClass('not-allowed');
                itemInput.eq(j).val(Number(itemInput.eq(j).val()) + 1);
            } else {
                if(itemInput[j].value <= 1) {
                    layer.msg('本商品一件起售');
                    itemSupBtn.eq(j).addClass('not-allowed');
                    return ;
                }
                itemInput[j].value = itemInput[j].value > 1 ? itemInput[j].value - 1 : 1;
            };
            itemChange(j);
        })
    });

    //购物车-商品数量输入
    itemInput.each(function(index) {
        $(this).on('keyup', function(e) {
            if(this.value.length==1){
                this.value=this.value.replace(/[^1-9]/g,'')
            } else {
                this.value=this.value.replace(/\D/g,'')
            }
            itemChange(index);
        });
    });

    //购物车-批量删除
    $(".house-usershop").find("#batchDel").on('click', function(){
        var num = $('.layui-cart-check-this.checked'),
            url = num.attr('data-url'),
            skuIds = [];
        if (num.length == 0) {
            layer.msg('请选择数据');
        } else {
            num.each(function(){
                var id = $(this).attr('data-id');
                skuIds.push(id);
            });
            $.post(url, {_method:'delete',skuIds:skuIds}, function(data){
                tips(data);
            })
        }
    })

    //购物车-结算
    $('.layui-cart-calculate').on('click', function(){
        var url = $(this).data('url');
        var items = [];
        $('.house-usershop table tr[data-id]').each(function () {
            var $checkbox = $(this).find('.layui-cart-check-this');
            if (!$checkbox.hasClass('checked')) {
               return;
            }
            var item_id = $(this).data('id');
            items.push(item_id);
        })
        if(items.length == 0) {
            layer.msg('请选择商品');
            return ;
        }
        post(url, items);
    })

    //下单-地址切换
    $('.address-box').on('click', function(){
        $(this).addClass('address-active').siblings().removeClass('address-active').addClass('layui-hide')
        $('.address-more').html('更多地址↓');
        $('.address-more').removeClass('address-hide');
    })

    $('.address-more').on('click', function(){
        if($(this).hasClass('address-hide')){
            $(this).html('更多地址↓');
            $(this).removeClass('address-hide');
            $('.address-box').each(function(){
                if(!$(this).hasClass('address-active')) {
                    $(this).addClass('layui-hide')
                }
            })
        } else {
            $('.address-box').removeClass('layui-hide');
            $(this).addClass('address-hide');
            $(this).html('收起地址↑');
        }
    })

    //下单-结算
    $('.layui-order-pay-btn').on('click', function(){
        var req = {
            address_id: $('.address-active').data('id'),
            items: [],
            remark: '123',
        }
        var orderUrl = $(this).data('order');
        $('.item-box').each(function(){
            req.items.push({
                sku_id:$(this).data('id'),
                amount:$(this).find('.amount').text()
            })
        })
        $.post(orderUrl, req, function(data){
            tips(data);
        })
    })


    //加入购物车
    $('.layui-btn-add-to-cart').click(function () {
        var url=$(this).attr('data-url'),
            amount=$('.sku_amount').val(),
            stock = $(".house-detail").find(".shopChoose").find(".btn-input").children("input").attr('data-stock'),
            sku_json=[],
            i=j=0;
        $('.sku-key').each(function(){
            i++;
            sku_key = $(this).attr('data-key');
            $(this).find('dd.active').map(function(){
                j++;
                sku_value = $(this).attr('data-value');
                var json = {key:sku_key,value:sku_value};
                sku_json.push(json);
            })
        });
        if(i != j) {
            layer.msg('请选择商品规格');
            return ;
        }
        if(stock == 0 || amount - stock > 0) {
            layer.msg('商品库存不足');
            return ;                                
        }

        // $.post(url, {amount:amount,sku:sku_json}, function(data){
        //     tips(data);
        // })

        $.ajax({
             type: "POST",
             url: url,
             contentType: 'application/x-www-form-urlencoded;charset=utf-8',
             data: {amount:amount,sku:sku_json},
             dataType: "json",
             success: function(data){
                         tips(data);
                      },
             error:function(e){
                        layer.msg('请先登录');
             }
         });
     })

    //立即购买
    $('.layui-btn-buy-now').on('click', function(){
        var url=$(this).attr('data-url'),
            amount=$('.sku_amount').val(),
            stock = $(".house-detail").find(".shopChoose").find(".btn-input").children("input").attr('data-stock'),
            sku_json=[],
            i=j=0;
        $('.sku-key').each(function(){
            i++;
            sku_key = $(this).attr('data-key');
            $(this).find('dd.active').map(function(){
                j++;
                sku_value = $(this).attr('data-value');
                var json = {key:sku_key,value:sku_value};
                sku_json.push(json);
            })
        });
        sku_json = JSON.stringify(sku_json);
        if(i != j) {
            layer.msg('请选择商品规格');
            return ;
        }
        if(stock == 0 || amount - stock > 0) {
            layer.msg('商品库存不足');
            return ;                                
        }
        post(url, {amount:amount, sku:sku_json})  
    })





























    //固定 bar
    util.fixbar({
        click: function(type) {
            if (type === 'bar1') {
                //
            }
        }
    });

    exports('house', {});
})
