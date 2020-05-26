<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogTopic;

class TopicController extends AdminController
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
    	$topics = BlogTopic::query()->paginate(10);

    	return view('admin::blog.topic.index',  [
            'topics' => $topics,
        ]);
    }

    /**
    * 新建
    *
    * @access public 
    * @param
    * @return view
    */
    public function create()
	{
		return view('admin::blog.topic.create_and_edit',[
			'topic' => new BlogTopic(),
		]);
	}

    /**
    * 保存新建
    *
    * @access public 
    * @param
    * @return status
    */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $this->validateTopic($data);

        $data = $this->handleData($data);

        BlogTopic::create($data);

        return success('添加成功', route('admin.blog.topic'));
    }

    /**
    * 编辑
    *
    * @access public 
    * @param
    * @return view
    */
    public function edit(BlogTopic $topic)
    {
        return view('admin::blog.topic.create_and_edit',[
            'topic' => $topic,
        ]);
    }

    /**
    * 保存编辑
    *
    * @access public 
    * @param
    * @return status
    */
    public function update(BlogTopic $topic, Request $request)
    {
        $data = $request->except('_token');

        $this->validateTopic($data);

        $data = $this->handleData($data);

        $topic->update($data);

        return success('编辑成功', route('admin.blog.topic'));
    }

    /**
    * 删除
    *
    * @access public 
    * @param
    * @return status
    */
    public function delete(BlogTopic $topic)
    {
        if(count($topic->articles)) {
        	return error('该专题下有文章，不能删除');
        }
        $topic->delete();
        return success('删除成功', 'refresh');
    }

    /**
    * 验证提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function validateTopic($data)
    {
        $rule = [
            'title' => 'required',
            'image' => 'required'
        ];
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return error($validator->errors()->first());
        }
    }

    /**
    * 处理提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function handleData($data)
    {
        $data['image'] = upload_base64_img($data['image'], 'blog/topic', false);

        return $data;
    }
}