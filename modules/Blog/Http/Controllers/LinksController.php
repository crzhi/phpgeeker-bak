<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Models\BlogLink;

class LinksController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 友链
    *
    * @access public 
    * @param Request $request
    * @return view
    */
    public function index()
    {
        return view('blog::links.index',  [
            'links' => $this->allLinks(),
        ]);
    }

    /**
    * 获取所有友情链接
    *
    * @access protected 
    * @param 
    * @return $links
    */
    protected function allLinks()
    {
        return BlogLink::all();
    }    
}
