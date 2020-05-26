<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Controller;

use Modules\Blog\Models\BlogTag;
use Modules\Blog\Models\BlogLink;
use Modules\Blog\Models\BlogTopic;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogComment;
use Modules\Blog\Models\BlogSetting;
use Modules\Blog\Models\BlogCategory;

class BlogController extends Controller
{
    /**
    * 程序初始化参数
    *
    * @access public 
    * @param
    * @return
    */
    public function __construct()
    {
        $this->blogSet();
        $this->allCategories();
        $this->topLinks();
        $this->hotArticles();
        $this->newComments();
        $this->allTags();
        $this->allTopics();
    }

    /**
    * 获取所有分类
    *
    * @access protected 
    * @param
    * @return
    */
    protected function blogSet()
    {
        view()->share('set', BlogSetting::query()->first());
    }

    /**
    * 获取所有分类
    *
    * @access protected 
    * @param
    * @return
    */
    protected function allCategories()
    {
        view()->share('categories', BlogCategory::query()->with('articles')->get());
    }

    /**
    * 获取所有分类
    *
    * @access protected 
    * @param
    * @return
    */
    protected function allTopics()
    {
        view()->share('topics', BlogTopic::query()->with('articles')->get());
    }

    /**
    * 友情链接
    *
    * @access protected 
    * @param
    * @return
    */
    protected function topLinks()
    {
        view()->share('topLinks', BlogLink::query()->orderBy('id', 'asc')->take(9)->get());
    }

    /**
    * 热门文章
    *
    * @access protected 
    * @param
    * @return
    */
    protected function hotArticles()
    {
        view()->share('hotArticles', BlogArticle::query()->orderBy('view', 'desc')->take(5)->get());
    }

    /**
    * 最新评论
    *
    * @access protected 
    * @param
    * @return
    */
    protected function newComments()
    {
        view()->share('newComments', BlogComment::query()->orderBy('created_at', 'desc')->take(5)->with(['article', 'user'])->get());
    }

    /**
    * 标签云
    *
    * @access protected 
    * @param
    * @return
    */
    protected function allTags()
    {
        view()->share('tags', BlogTag::query()->with('articles')->get());
    }
}
