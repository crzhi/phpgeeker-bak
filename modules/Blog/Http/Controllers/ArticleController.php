<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Http\Controllers\BlogController;

use Illuminate\Http\Request;

use Modules\Passport\Models\User;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogComment;
use Modules\Blog\Models\BlogCategory;

class ArticleController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 文章页
    *
    * @access public 
    * @param  BlogArticle $article
    * @return view
    */
    public function index(BlogArticle $article)
    {
        // dd($this->getComments($article->id));
        $this->increView($article);
    	return view('blog::article.index',[
            'article' => $article,
            'prevArticle' => $this->prevArticle($article->id),
            'nextArticle' => $this->nextArticle($article->id),
            'comments' => $this->getComments($article->id),
        ]);
    }

    /**
    * 增加浏览量
    *
    * @access protected
    * @param $article 本片文章
    * @return
    */
    protected function increView($article)
    {
        $article->increment('view');
    }

    /**
    * 前一篇文章
    *
    * @access protected
    * @param int $id 文章id
    * @return $prevArticle 上一篇文章
    */
    protected function prevArticle($id)
    {
        return BlogArticle::select('id', 'title', 'cover')->where('id', '<', $id)->orderBy('id','desc')->first();
    }

    /**
    * 后一篇文章
    *
    * @access protected
    * @param int $id 文章id
    * @return $prevArticle 下一篇文章
    */
    protected function nextArticle($id)
    {
        return BlogArticle::select('id', 'title', 'cover')->where('id', '>', $id)->orderBy('id','asc')->first();
    }

    /**
    * 获取文章评论
    *
    * @access protected
    * @param $id 本片文章id
    * @return
    */
    protected function getComments($id)
    {
        $comments = BlogComment::query()
            ->select('blog_comments.*', 'u.nickname', 'u.avatar', 'u.admin')
            ->join('passport_users as u', 'blog_comments.user_id', 'u.id') 
            ->where('blog_comments.pid', 0)
            ->where('blog_comments.article_id', $id)
            ->orderBy('blog_comments.created_at', 'desc')
            ->get()
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
                    $replyUserId = BlogComment::query()->where('id', $reComment['pid'])->pluck('user_id');
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
        $reComments = BlogComment::query()
            ->select('blog_comments.*', 'u.nickname', 'u.avatar', 'u.admin')
            ->join('passport_users as u', 'blog_comments.user_id', 'u.id')
            ->where('blog_comments.pid', $obj['id'])
            ->orderBy('blog_comments.id', 'desc')
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
}
