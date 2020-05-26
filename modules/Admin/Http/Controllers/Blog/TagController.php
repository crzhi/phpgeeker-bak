<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogTag;

class TagController extends AdminController
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
    	$tags = BlogTag::query()->paginate(10);

    	return view('admin::blog.tag.index',  [
            'tags' => $tags,
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
		return view('admin::blog.tag.create_and_edit',[
			'tag' => new BlogTag(),
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

        $this->validateTag($data);

        BlogTag::create($data);

        return success('添加成功', route('admin.blog.tag'));
    }

    /**
    * 编辑
    *
    * @access public 
    * @param
    * @return view
    */
    public function edit(BlogTag $tag)
    {
        return view('admin::blog.tag.create_and_edit',[
            'tag' => $tag,
        ]);
    }

    /**
    * 保存编辑
    *
    * @access public 
    * @param
    * @return status
    */
    public function update(BlogTag $tag, Request $request)
    {
        $data = $request->except('_token');

        $this->validateTag($data);

        $tag->update($data);

        return success('编辑成功', route('admin.blog.tag'));
    }

    /**
    * 删除
    *
    * @access public 
    * @param
    * @return status
    */
    public function delete(BlogTag $tag)
    {
        if(count($tag->articles)) {
        	return error('该标签下有文章，不能删除');
        }
        $tag->delete();
        return success('删除成功', 'refresh');
    }

    /**
    * 验证提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function validateTag($data)
    {
        $rule = [
            'title' => 'required',
        ];
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return error($validator->errors()->first());
        }
    }
}