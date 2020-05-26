<?php

namespace Modules\Mall\Http\Controllers\User;

use Modules\Mall\Http\Controllers\MallController;

class CartController extends MallController
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
    	return view('mall::user.cart',  [
    		// 'FirstCategories' => $this->FirstCategories(),
        ]);
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function pay()
    {
    	return view('mall::order.pay',  [
    		// 'FirstCategories' => $this->FirstCategories(),
        ]);
    }
}