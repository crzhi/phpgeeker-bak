//懒加载图片
window.onload = function() {
    $("img.lazy").lazyload({threshold :100});
};
//平移滑动
$("a.smooth").click(function(e) {
    $("#main-menu li").each(function() {
        $(this).removeClass("active");
    });
    $(this).parent("li").addClass("active");
    e.preventDefault();
    var href = $(this).attr("href");
    var pos = $(href).position().top - 30;
    $("html,body").animate({
        scrollTop: pos
    },
    500);
    $('#main-menu').removeClass('mobile-is-visible');
});
//收起内容
$('h4.text-gray').click(function() {
    var _this = $(this);
    _this.next('div.row').slideToggle();
    if(_this.children().eq(1).hasClass('fa-caret-down')) {
        _this.children().eq(1).removeClass('fa-caret-down');
        _this.children().eq(1).addClass('fa-caret-square-o-right');
    } else {
        _this.children().eq(1).removeClass('fa-caret-square-o-right');
        _this.children().eq(1).addClass('fa-caret-down');                    
    }
});
//推荐-置顶
$(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() >= 100){
            $('.go-up').removeClass('unvisible')
        }else{
            $('.go-up').addClass('unvisible');
        }
    });
    $('.fl-row-center').on('mouseover', function(){
        $(this).addClass('fix-over');
    })
    $('.fl-row-center').on('mouseout', function(){
        $(this).removeClass('fix-over');
    })
    $('#go-top').on('click', function(){
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    })
})
//手机导航
$('.mobile-menu-toggle').on('click', function(){
    $('.main-menu').toggle();
    $('.main-content').toggleClass('mobile-menu-show');
})

