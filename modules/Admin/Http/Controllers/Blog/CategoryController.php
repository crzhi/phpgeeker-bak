<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogTag;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogComment;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\BlogArticleTag;


class CategoryController extends AdminController
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
    	$categories = BlogCategory::query()->paginate(10);

    	return view('admin::blog.category.index',  [
            'categories' => $categories,
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
		return view('admin::blog.category.create_and_edit',[
			'category' => new BlogCategory(),
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

        $this->validateCategory($data);

        $data = $this->handleData($data);

        BlogCategory::create($data);

        return success('添加成功', route('admin.blog.category'));
    }

    /**
    * 编辑
    *
    * @access public 
    * @param
    * @return view
    */
    public function edit(BlogCategory $category)
    {
        return view('admin::blog.category.create_and_edit',[
            'category' => $category,
        ]);
    }

    /**
    * 保存编辑
    *
    * @access public 
    * @param
    * @return status
    */
    public function update(BlogCategory $category, Request $request)
    {
        $data = $request->except('_token');

        $this->validateCategory($data);

        $data = $this->handleData($data);

        $category->update($data);

        return success('编辑成功', route('admin.blog.category'));
    }

    /**
    * 删除
    *
    * @access public 
    * @param
    * @return status
    */
    public function delete(BlogCategory $category)
    {
        if(count($category->articles)) {
        	return error('该分类下有文章，不能删除');
        }
        $category->delete();
        return success('删除成功', 'refresh');
    }

    /**
    * 回收站
    *
    * @access public 
    * @param
    * @return view
    */
    public function trashed()
    {
        $categories = BlogCategory::onlyTrashed()->paginate(10);

        return view('admin::blog.category.trashed',  [
            'categories' => $categories,
        ]);
    }

    /**
    * 回收站还原
    *
    * @access public 
    * @param
    * @return view
    */
    public function restore(Request $request)
    {
        $id = $request->get('id');

        $category = BlogCategory::withTrashed()->find($id);

        $category->restore();

        return success('还原成功', 'refresh');
    }

    /**
    * 回收站还原
    *
    * @access public 
    * @param
    * @return view
    */
    public function destory(Request $request)
    {
        $id = $request->get('id');

        $category = BlogCategory::withTrashed()->find($id);

        $category->forceDelete();

        return success('彻底删除成功', 'refresh');
    }

    /**
    * 验证提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function validateCategory($data)
    {
        $rule = [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
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
        $data['image'] = upload_base64_img($data['image'], 'blog/category', false);

        return $data;
    }
}