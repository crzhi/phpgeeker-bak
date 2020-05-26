
    /*
    -------------------------
    回复框
    -------------------------
    */
    function respond(_this) {   
        $('.respondComment-box').remove();
        var url = _this.data('href'),
            respondId = _this.data('id');
        $.post(url, {respondId:respondId}, function(data){
            if(typeof(data) == 'object') {
                layer.msg(data.message);
                return false;
            }
            $('#comment-' + respondId).after(data)
        })
    }

    /*
    -------------------------
    取消回复
    -------------------------
    */
    function cancelRespond() {
        $('.respondComment-box').remove();
    }

    /*
    -------------------------
    提交回复
    -------------------------
    */
    function respondComment (event, type = false) {
        event.preventDefault();
        var url = $(".respondform").attr('action'),
            respondUserId = $(".respondform input[name='respondUserId']").val(),
            pid = $(".respondform input[name='pid']").val(),
            content = $(".respondform textarea").val();

        $.post(url, {respondUserId:respondUserId, pid:pid, content:content}, function(data) {
            if(typeof(data) == 'object') {
                layer.msg(data.message);
                return false;
            }
            layer.msg('评论成功');
            $('.respondComment-box').remove();
            if(type) {
                $('#comment-' + pid).parent().parent().append(data);
            } else {
                $('#comment-' + pid).parent().children('.children').append(data)
            }
        })
    }

jQuery(document).ready(function($) {

     /*
    -------------------------
    WEIXIN BOOM
    -------------------------
    */
    $('#tooltip-s-weixin').on('click', function () {
        $('.f-weixin-dropdown').toggleClass('is-visible');
    });

    $('#tooltip-f-weixin').on('click', function () {
        $('.f-weixin-dropdown').toggleClass('is-visible');
    });

    $(".close-weixin").on('click', function () {
        $(".f-weixin-dropdown").removeClass('is-visible');
    });

    $('.su-dropbox .icon-wechat').on('click', function () {
        $('.single-weixin-dropdown').toggleClass('is-visible');
    });

    $(".single-weixin-dropdown .close-weixin").on('click', function () {
        $(".single-weixin-dropdown").removeClass('is-visible');
    });


    /*
    -------------------------
    toTop
    -------------------------
    */
    $('body').append('<a class="to-top"><i class="icon-arrow-up"></i></a>');
    $(function() {
        $('.to-top').toTop();
     });
    !function(o) {"use strict"; o.fn.toTop = function(t) {
        var i = this,
        e = o(window),
        s = o("html, body"),
        n = o.extend({
            autohide: !0,
            offset: 420,
            speed: 500,
            position: !0,
            right: 38,
            bottom: 38
        },t);
        i.css({cursor: "pointer"}),
        n.autohide && i.css("display", "none"),
        n.position && i.css({
            position: "fixed",
            right: n.right,
            bottom: n.bottom
        }),
        i.click(function() {
            s.animate({scrollTop: 0},n.speed)
        }),
        e.scroll(function() {
            var o = e.scrollTop();
            n.autohide && (o > n.offset ? i.fadeIn(n.speed) : i.fadeOut(n.speed))
        })
    }} (jQuery);

    //手机侧边导航
    $(function(){
        $('.navbar-toggle').click(function(e){
            $('html, body').toggleClass('out');
            $('.navbar-fixed-top').toggleClass('out');
            $('.body-overlay').toggleClass('show-overlay');
            $('.navbar-collapse ul.navbar-nav').css({'height':document.documentElement.clientHeight});
            if ($('body').hasClass('out')) {
              $(this).focus();
            } else {
              $(this).blur();
            }
        });
        $('body').on({
            'click touchstart': function (e) {
              if ($('body').hasClass('out') && !$(e.target).closest('.navbar-collapse, button.navbar-toggle').length) {
                e.preventDefault();
                $('button.navbar-toggle').trigger('click');
                $('button.navbar-toggle').blur();
                $('.body-overlay').removeClass('show-overlay');

              }
            },
            keyup: function (e) {
              if (e.keyCode == 27 && $('body').hasClass('out')) {
                $('button.navbar-toggle').trigger('click');
              }
            }
        });
    });

});