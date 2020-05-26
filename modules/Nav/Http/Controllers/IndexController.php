<?php

namespace Modules\Nav\Http\Controllers;

use Modules\Nav\Http\Controllers\NavController;
use Modules\Nav\Models\NavCategory;

class IndexController extends NavController
{
    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index()
    {
    	return view('nav::index',  [
    		'FirstCategories' => $this->FirstCategories(),
        ]);
    }
    /**
    * 获取一级分类
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function FirstCategories()
    {
    	return NavCategory::query()->where('pid', '0')->orderBy('rank', 'asc')->get();
    }
}