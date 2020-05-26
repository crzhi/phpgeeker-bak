<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogBanner;

class SearchController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 搜索页
    *
    * @access public 
    * @param Request $request
    * @return view
    */
    public function index(Request $request)
    {
    	$keywords = $request->get('keywords');
    	if(!$keywords) {
    		return redirect(route('blog'));
    	}
    	return view('blog::search.index',  [
            'keywords' => $keywords,
    		'number' => $this->number($keywords),
            'articles' => $this->articles($keywords),
        ]);
    }

    /**
    * 获取关键词最新文章
    *
    * @access protected 
    * @param Request $request
    * @return $articles
    */
    protected function articles($keywords)
    {
        return BlogArticle::query()->where('title', 'like', '%'.$keywords.'%')->orderBy('id', 'desc')->with(['category', 'tags', 'topic'])->paginate(10)->appends(['keywords'=>$keywords]);
    }

    /**
    * 获取关键词文章总数
    *
    * @access protected 
    * @param Request $request
    * @return $count
    */
    protected function number($keywords)
    {
        return count(BlogArticle::query()->where('title', 'like', '%'.$keywords.'%')->get());
    }

}
