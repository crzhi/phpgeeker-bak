<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogLink;

class LinkController extends AdminController
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
    	$links = BlogLink::query()->paginate(10);

    	return view('admin::blog.link.index',  [
            'links' => $links,
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
		return view('admin::blog.link.create_and_edit',[
			'link' => new BlogLink(),
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

        $this->validateLink($data);

        $data = $this->handle($data);

        BlogLink::create($data);

        return success('添加成功', route('admin.blog.link'));
    }

    /**
    * 编辑
    *
    * @access public 
    * @param $link
    * @return view
    */
    public function edit(BlogLink $link)
    {
        return view('admin::blog.link.create_and_edit',[
            'link' => $link,
        ]);
    }

    /**
    * 保存编辑
    *
    * @access public
    * @param $link
    * @param $request
    * @return status
    */
    public function update(BlogLink $link, Request $request)
    {
        $data = $request->except('_token');

        $this->validateLink($data);

        $data = $this->handle($data);

        $link->update($data);

        return success('编辑成功', route('admin.blog.link'));
    }

    /**
    * 删除
    *
    * @access public 
    * @param $link
    * @return status
    */
    public function delete(BlogLink $link)
    {
        $link->delete();
        return success('删除成功', 'refresh');
    }

    /**
    * 验证提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function validateLink($data)
    {
        $rule = [
            'title' => 'required',
            'url' => 'required|url',
            'ico' => 'required'
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
    protected function handle($data)
    {
        $data['ico'] = upload_base64_img($data['ico'], 'blog/link', false);        

        return $data;
    }
}
