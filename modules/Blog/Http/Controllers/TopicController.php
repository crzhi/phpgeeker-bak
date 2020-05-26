<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogBanner;
use Modules\Blog\Models\BlogTopic;

class TopicController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 分标签页
    *
    * @access public 
    * @param BlogTopic $topic
    * @return view
    */
    public function index()
    {
        return view('blog::topic.index');
    }

    /**
    * 分标签页
    *
    * @access public 
    * @param BlogTopic $topic
    * @return view
    */
    public function topic(BlogTopic $topic)
    {
    	return view('blog::topic.topic',  [
    		'topic' => $topic,
    		'articles' => $topic->articles()->orderBy('id', 'desc')->with(['category', 'tags', 'topic'])->paginate(10),
        ]);
    }
}
