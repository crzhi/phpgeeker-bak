<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogCategory;

class CategoryController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 分类页
    *
    * @access public 
    * @param  BlogCategory $category
    * @return view
    */
    public function index()
    {
        return view('blog::category.index');
    }

    /**
    * 分类页
    *
    * @access public 
    * @param  BlogCategory $category
    * @return view
    */
    public function category(BlogCategory $category)
    {
    	return view('blog::category.category',[
            'thisCategory' => $category,
            'articles' => $this->categoryArticles($category),
        ]);
    }

    /**
    * 获取分页文章
    *
    * @access protected 
    * @param   $category
    * @return 
    */
    protected function categoryArticles($category)
    {
        return $category->articles()->orderBy('id', 'desc')->with(['category', 'tags', 'topic'])->paginate(10);
    }

}
