<?php

namespace Modules\Admin\Http\Controllers\Wechat;

use Modules\Admin\Http\Controllers\Wechat\WechatController;

use Illuminate\Support\Facades\Auth;

class MenuController extends WechatController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index()
    {
    	$menu = $this->app->menu->list();
    	dd($menu);
    	return view('admin::wechat.menu.index',  [
    		'menu' => $menu,
        ]);
    }
}