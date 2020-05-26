<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Http\Controllers\BlogController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Modules\Passport\Models\User;
use Modules\Blog\Models\BlogMessage;

class MessageController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 交换友链
    *
    * @access public 
    * @param Request $request
    * @return view
    */
    public function index()
    {
        // dd($this->getComments());
        return view('blog::message.index',  [
            'comments' => $this->getComments(),
        ]);
    }


    /**
    * 获取文章评论
    *
    * @access protected
    * @param $id 本片文章id
    * @return
    */
    protected function getComments()
    {
        $comments = BlogMessage::query()
            ->select('blog_messages.*', 'u.nickname', 'u.avatar', 'u.admin')
            ->join('users as u', 'blog_messages.user_id', 'u.id') 
            ->where('pid', 0)
            ->orderBy('id', 'desc')
            ->get()
            // ->paginate(10)
            ->toArray();
        foreach($comments as $key => $comment) {
            $comments[$key]['content'] = htmlspecialchars_decode($comment['content']);
            $this->reComments = [];
            $this->getReComments($comment);
            $reComments = $this->reComments;
            if(!empty($reComments)){
                // 按评论时间asc排序
                uasort($reComments, function ($a, $b) {
                    $prev = $a['created_at'] ?? 0;
                    $next = $b['created_at'] ?? 0;
                    if ($prev == $next) {
                        return 0;
                    }
                    return ($prev < $next) ? -1 : 1;
                });
                foreach ($reComments as $k => $reComment) {
                    $replyUserId = BlogMessage::query()->where('id', $reComment['pid'])->pluck('user_id');
                    $reComments[$k]['reply_name'] = User::query()->where('id', $replyUserId)->value('nickname');
                }
            }
            $comments[$key]['reComments'] = $reComments;
        }
        return $comments;
    }

    /**
    * 获取子评论
    *
    * @access protected
    * @param $id 本条评论id
    * @return
    */
    protected function getReComments($obj)
    {
        $reComments = BlogMessage::query()
            ->select('blog_messages.*', 'u.nickname', 'u.avatar', 'u.admin')
            ->join('users as u', 'blog_messages.user_id', 'u.id')
            ->where('pid', $obj['id'])
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        if(!empty($reComments)){
            foreach ($reComments as $key => $reComment) {
                $reComment['content'] = htmlspecialchars_decode($reComment['content']);
                $this->reComments[] = $reComment;
                $this->getReComments($reComment);
            }
        }
    }

    /**
    * 文章评论
    *
    * @access public 
    * @param  BlogArticle $article
    * @return view
    */
    public function comment(Request $request)
    {
        if(!Auth::check()) {
            return error('请登录以评论');
        }

    	$this->validateComment($request);

    	return $this->storeComment($request);
    }

    /**
    * 回复文章评论
    *
    * @access public 
    * @param  BlogArticle $article
    * @return view
    */
    public function recomment(Request $request)
    {
        if(!Auth::check()) {
            return error('请登录以评论');
        }

    	$this->validateComment($request);

    	return $this->storeReComment($request);
    }

    public function respond(Request $request) 
    {
        if(!Auth::check()) {
            return error('请登录以回复');
        }

        $respondId = $request->get('respondId');
        $respondUser = BlogMessage::find($respondId)->user;
        $respondType = BlogMessage::find($respondId)->pid;
        return view('blog::message.respond', [
            'respondId' => $respondId,
            'respondUser' => $respondUser,
            'respondType' => $respondType,
        ]);
    }

    /**
     * 验证
     *
     * @param $data 
     * @return $validator
     *
     * @throws 验证错误消息
     */
    protected function validateComment(Request $request)
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


    protected function storeComment($request) 
    {
    	$data = [
    		'user_id' => Auth::user()->id,
    		'content' => $request->get('content'),
    		'pid' => 0,
    	];
    	return view('blog::message.comment', [
    		'comment' => BlogMessage::create($data),
    	]);
    }

    protected function storeReComment($request) 
    {
        $respondUserId = $request->get('respondUserId');
    	$data = [
    		'user_id' => Auth::user()->id,
    		'content' => $request->get('content'),
    		'pid' => $request->get('pid'),
    	];
    	return view('blog::message.recomment', [
    		'reComment' => BlogMessage::create($data),
            'respondUser' => User::find($respondUserId),
    	]);
    }    
}    