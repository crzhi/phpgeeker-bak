<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogComment;

class CommentController extends AdminController
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
    	$comments = BlogComment::query()->orderBy('created_at', 'desc')->paginate(10);

    	return view('admin::blog.comment.index',  [
            'comments' => $comments,
        ]);
    }

    /*
    * 删除
    *
    * @access public 
    * @param
    * @return status
    */
    public function delete(BlogComment $comment)
    {
        $comment->delete();
        return success('删除成功', 'refresh');
    }
}
