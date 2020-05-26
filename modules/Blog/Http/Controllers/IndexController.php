<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Http\Controllers\BlogController;

use Illuminate\Http\Request;

use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\BlogArticleTag;

class IndexController extends BlogController
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
    	return view('blog::index.index',  [
            'articles' => $this->articles(),
        ]);
    }

    /**
    * 获取最新文章
    *
    * @access protected 
    * @param
    * @return $articles
    */
    protected function articles($categoryId = null)
    {
        $res = BlogArticle::query();
        if($categoryId) {
            $res = $res->where(['category_id'=>$categoryId]);
        }
        return $res->orderBy('id', 'desc')->with(['category', 'tags', 'topic'])->paginate(10);

    }
}