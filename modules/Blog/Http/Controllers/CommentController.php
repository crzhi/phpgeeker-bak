<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Http\Controllers\BlogController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Modules\Passport\Models\User;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogComment;
use Modules\Blog\Models\BlogCategory;

class CommentController extends BlogController
{
	// public function __construct()
 //    {
 //        parent::__construct();
 //    }

    /**
    * 文章评论
    *
    * @access public 
    * @param  BlogArticle $article
    * @return view
    */
    public function comment(Request $request, BlogArticle $article)
    {
        if(!Auth::check()) {
            return error('请登录以评论');
        }

        $this->validateComment($request);

        $this->increcomment($article->id);

    	return $this->storeComment($request, $article);
    }

    /**
    * 回复文章评论
    *
    * @access public 
    * @param  BlogArticle $article
    * @return view
    */
    public function recomment(Request $request, BlogArticle $article)
    {
        if(!Auth::check()) {
            return error('请登录以评论');
        }

        $this->validateComment($request);

        $this->increcomment($article->id);

    	return $this->storeReComment($request, $article);
    }

    public function respond(Request $request, BlogArticle $article) 
    {
        if(!Auth::check()) {
            return error('请登录以回复');
        }

        $respondId = $request->get('respondId');
        $respondUser = BlogComment::find($respondId)->user;
        $respondType = BlogComment::find($respondId)->pid;
        return view('blog::article.respond', [
            'article' => $article,
            'respondId' => $respondId,
            'respondUser' => $respondUser,
            'respondType' => $respondType,
        ]);
    }


    //文章评论加1
    protected function increcomment($article_id)
    {
        BlogArticle::query()->where('id', $article_id)->increment('comment');
    }
    /**
     * 验证
     *
     * @param $data 
     * @return $validator
     *
     * @throws 验证错误消息
     */
    protected function validateComment($request)
    {
        $data = $request->only('content');
        $rules = [
            'content' => 'required|max:200',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return error($validator->errors()->first());
        }
    }


    protected function storeComment($request, $article) 
    {
    	$data = [
    		'article_id' => $article->id,
    		'user_id' => Auth::user()->id,
    		'content' => $request->get('content'),
    		'pid' => 0,
    	];
    	return view('blog::article.comment', [
            'article' => $article,
    		'comment' => BlogComment::create($data),
    	]);
    }

    protected function storeReComment($request, $article) 
    {
    	$respondUserId = $request->get('respondUserId');
    	$data = [
    		'article_id' => $article->id,
    		'user_id' => Auth::user()->id,
    		'content' => $request->get('content'),
    		'pid' => $request->get('pid'),
    	];
    	return view('blog::article.recomment', [
            'article' => $article,
    		'reComment' => BlogComment::create($data),
    		'respondUser' => User::find($respondUserId),
    	]);
    }
}
