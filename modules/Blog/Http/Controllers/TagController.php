<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogBanner;
use Modules\Blog\Models\BlogTag;

class TagController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 分标签页
    *
    * @access public 
    * @param BlogTag $tag
    * @return view
    */
    public function index()
    {
        return view('blog::tag.index');
    }

    /**
    * 分标签页
    *
    * @access public 
    * @param BlogTag $tag
    * @return view
    */
    public function tag(BlogTag $tag)
    {
    	return view('blog::tag.tag',  [
    		'tag' => $tag,
    		'articles' => $this->articles($tag),
        ]);
    }

    /**
    * 获取标签最新文章
    *
    * @access protected 
    * @param Request $request
    * @return $count
    */
    protected function articles($tag)
    {
        return $tag->articles()->orderBy('id', 'desc')->with(['category', 'tags', 'topic'])->paginate(10);
    }

}
