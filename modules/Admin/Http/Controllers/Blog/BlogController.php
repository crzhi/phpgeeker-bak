<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;

use Modules\Blog\Models\BlogTag;
use Modules\Blog\Models\BlogLink;
use Modules\Blog\Models\BlogTopic;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogComment;
use Modules\Blog\Models\BlogMessage;
use Modules\Blog\Models\BlogCategory;

class BlogController extends AdminController
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index()
    {
    	return view('admin::blog.index',  [
    		'tag' => BlogTag::count(),
            'link' => BlogLink::count(),
            'topic' => BlogTopic::count(),
            'article' => BlogArticle::count(),
            'comment' => BlogComment::count(),
            'message' => BlogMessage::count(),
            'category' => BlogCategory::count(),
        ]);
    }
}