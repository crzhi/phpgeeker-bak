<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogMessage;

class MessageController extends AdminController
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
    	$messages = BlogMessage::query()->orderBy('created_at', 'desc')->paginate(10);

    	return view('admin::blog.message.index',  [
            'messages' => $messages,
        ]);
    }

    /**
    * 删除
    *
    * @access public 
    * @param
    * @return status
    */
    public function delete(BlogMessage $message)
    {
        $message->delete();
        return success('删除成功', 'refresh');
    }
}