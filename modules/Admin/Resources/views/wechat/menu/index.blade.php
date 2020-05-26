@extends('admin::layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/modules/admin/css/wechat.css') }}">
@stop

@section('left')
    @include('admin::layouts.lib.left._wechat')
@stop

@section('nav')
    <a><cite>微信</cite></a><span lay-separator="">/</span>
    <a><cite>菜单</cite></a>
@stop

@section('content')
<div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">微信菜单</div>
                    <div class="layui-card-body" style="height: 600px;">
                        <div class="layui-col-xs6 layui-col-md4">
                            <div class="menu_preview">
                                <div class="menu-header">测试公众号</div>
                                <div class="menu-body"></div>
                                <ul class="menu-footer">
                                    @if(count($menu['menu']['button']))
                                        @foreach($menu['menu']['button'] as $key => $button)
                                            <li class="parent-menu">
                                                <a @if($key == 0) class="active" @endif data-type="keys" data-content="">
                                                    <i class="layui-icon layui-icon-tabs @if(!isset($button['sub_button'])) layui-hide @endif"></i>
                                                    <span>{{ $button['name'] }}</span>
                                                </a>
                                                <div class="sub-menu text-center @if($key != 0) layui-hide @endif">
                                                    <ul>
                                                        @if(isset($button['sub_button']))
                                                            @foreach($button['sub_button'] as $subButton)
                                                                <li>
                                                                    <a class="bottom-border">
                                                                        <span data-type="keys" data-content="">{{ $subButton['name'] }}</span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                            <li class="menu-add @if(count($button['sub_button']) >= 5) layui-hide @endif">
                                                                <a><i class="layui-icon layui-icon-add-1"></i></a>
                                                            </li>
                                                        @else
                                                            <li class="menu-add layui-hide">
                                                                <a><i class="layui-icon layui-icon-add-1"></i></a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="parent-menu menu-add">
                                        <a>
                                            <i class="icon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="layui-col-xs6 layui-col-md8">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        /**
         * 菜单事件构造方法
         * @returns {menu.index_L2.menu}
         */
        var menu = function () {
            this.version = '1.0';
            this.$btn;
            this.listen();
        };
        menu.prototype.listen = function () {
            var self = this;
            $('.menu-footer').on('click', 'li a', function () {
                self.$btn = $(this);
                self.$btn.parent('li').hasClass('menu-add') ? self.add() : self.checkShow();
            }).find('li:first a:first').trigger('click');
            $('.menu-delete').on('click', function () {
                var index = layer.confirm('确定删除吗？', function () {
                    self.del(), layer.close(index);
                });
            });
            $('.menu-submit').on('click', function () {
                self.submit();
            });
        };

        /**
         * 添加一个菜单
         * @returns {undefined}
         */
        menu.prototype.add = function () {
            var $add = this.$btn.parent('li'), $ul = $add.parent('ul');
            if ($ul.hasClass('menu-footer')) { /* 添加一级菜单 */
                var $li = $('<li class="parent-menu"><a class="active"><i class="icon-sub hide"></i> <span>一级菜单</span></a></li>').insertBefore($add);
                this.$btn = $li.find('a');
                $('<div class="sub-menu text-center hide"><ul><li class="menu-add"><a><i class="icon-add"></i></a></li></ul><i class="arrow arrow_out"></i><i class="arrow arrow_in"></i></div>').appendTo($li);
            } else { /* 添加二级菜单 */
                this.$btn = $('<li><a class="bottom-border"><span>二级菜单</span></a></li>').prependTo($ul).find('a');
            }
            this.checkShow();
        };

        /**
         * 数据校验显示
         * @returns {unresolved}
         */
        menu.prototype.checkShow = function () {
            var $li = this.$btn.parent('li'), $ul = $li.parent('ul');
            /* 选中一级菜单时显示二级菜单 */
            if ($li.hasClass('parent-menu')) {
                $('.parent-menu .sub-menu').not(this.$btn.parent('li').find('.sub-menu').removeClass('layui-hide')).addClass('layui-hide');
            }

            /* 一级菜单添加按钮 */
            var $add = $('li.parent-menu:last');
            $add.siblings('li').size() >= 3 ? $add.addClass('layui-hide') : $add.removeClass('layui-hide');
            /* 二级菜单添加按钮 */
            $add.siblings('li').map(function () {
                var $add = $(this).find('ul li:last');
                $add.siblings('li').size() >= 5 ? $add.addClass('layui-hide') : $add.removeClass('layui-hide');
            });
            /* 处理一级菜单 */
            var parentWidth = 100 / $('li.parent-menu:visible').size() + '%';
            $('li.parent-menu').map(function () {
                var $icon = $(this).find('.layui-icon-tabs');
                $(this).width(parentWidth).find('ul li').size() > 1 ? $icon.removeClass('layui-hide') : $icon.addClass('layui-hide');
            });
            /* 更新选择中状态 */
            $('.menu-footer a.active').not(this.$btn.addClass('active')).removeClass('active');
            this.renderEdit();
            return $ul;
        };

        /**
         * 显示当前菜单的属性值
         * @returns {undefined}
         */
        menu.prototype.renderEdit = function () {
            var $span = this.$btn.find('span'), $li = this.$btn.parent('li'), $ul = $li.parent('ul');
            var $html = '';
            if ($li.find('ul li').size() > 1) { /*父菜单*/
                $html = $($('.menu-editor-parent-tpl').html());
                $html.find('input[name="menu-name"]').val($span.text()).on('change keyup', function () {
                    $span.text(this.value || ' ');
                });
                $('.menu-editor .menu-content').html($html);
            } else {
                $html = $($('.menu-editor-content-tpl').html());
                $html.find('input[name="menu-name"]').val($span.text()).on('change keyup', function () {
                    $span.text(this.value || ' ');
                });
                $('.menu-editor .menu-content').html($html);
                var type = $span.attr('data-type') || 'text';
                $html.find('input[name="menu-type"]').on('click', function () {
                    $span.attr('data-type', this.value || 'text');
                    var content = $span.data('content') || '';
                    var type = this.value;
                    var html = function () {
                        switch (type) {
                            case 'miniprogram':
                                var tpl = '<div><div class="layui-form-item"><label class="layui-form-label">appid</label><div class="layui-input-block"><input type="text" name="appid" required="" lay-verify="required" placeholder="appid" autocomplete="off" class="layui-input" value="{appid}"></div></div><div class="layui-form-item"><label class="layui-form-label">url</label><div class="layui-input-block"><input type="text" name="url" required="" lay-verify="required" placeholder="url" autocomplete="off" class="layui-input" value="/mp/mp/menu.html"></div></div><div class="layui-form-item"><label class="layui-form-label">pagepath</label><div class="layui-input-block"><input type="text" name="pagepath" required="" lay-verify="required" placeholder="pagepath" autocomplete="off" class="layui-input" value="{pagepath}"></div></div></div>';
                                var _appid = '', _pagepath = '', _url = '';
                                if (content.indexOf(',') > 0) {
                                    _appid = content.split(',')[0] || '';
                                    _url = content.split(',')[1] || '';
                                    _pagepath = content.split(',')[2] || '';
                                }
                                $span.data('appid', _appid), $span.data('url', _url), $span.data('pagepath', _pagepath);
                                return tpl.replace('{appid}', _appid).replace('/mp/mp/menu.html', _url).replace('{pagepath}', _pagepath);
                            case 'customservice':
                            case 'text':
                                return '<div>回复内容<textarea style="resize:none;height:225px" name="content" class="form-control input-sm">{content}</textarea></div>'.replace('{content}', content);
                            case 'view':
                                return '<div class="layui-form-item layui-form-text"><label class="layui-form-label">跳转地址</label><div class="layui-input-block"><textarea placeholder="请输入内容" class="layui-textarea" name="content">{content}</textarea></div></div>'.replace('{content}', content);
                            case 'keys':
                                return '<div class="layui-form-item layui-form-text"><label class="layui-form-label">匹配内容</label><div class="layui-input-block"><textarea placeholder="请输入内容" class="layui-textarea" name="content">{content}</textarea></div></div>'.replace('{content}', content);
                            case 'event':
                                var options = {
                                    'scancode_push': '扫码推事件',
                                    'scancode_waitmsg': '扫码推事件且弹出“消息接收中”提示框',
                                    'pic_sysphoto': '弹出系统拍照发图',
                                    'pic_photo_or_album': '弹出拍照或者相册发图',
                                    'pic_weixin': '弹出微信相册发图器',
                                    'location_select': '弹出地理位置选择器'};
                                var select = [], tpl = '<div class="layui-form-item layui-form-text" style="margin-bottom: auto;"><label class="layui-form-label"></label><div><label><input class="cuci-radio" name="content" type="radio" {checked} value="{value}"> {title}</label></div></div>';
                                if (!(options[content] || false)) {
                                    content = 'scancode_push';
                                    $span.data('content', content);
                                }
                                for (var i in options) {
                                    select.push(tpl.replace('{value}', i).replace('{title}', options[i]).replace('{checked}', (i === content) ? 'checked' : ''));
                                }
                                return select.join('');
                        }
                    }.call(this);
                    var $html = $(html), $input = $html.find('input,textarea');
                    $input.on('change keyup click', function () {
                        // 将input值写入到span上
                        $span.data(this.name, $(this).val() || $(this).html());
                        // 如果是小程序，合并内容到span的content上
                        if (type === 'miniprogram') {
                            $span.data('content', $span.data('appid') + ',' + $span.data('url') + ',' + $span.data('pagepath'));
                        }
                    });
                    $('.editor-content-input').html($html);
                }).filter('input[value="{type}"]'.replace('{type}', type)).trigger('click');
            }
        };

        new menu();
    });
</script>
@stop