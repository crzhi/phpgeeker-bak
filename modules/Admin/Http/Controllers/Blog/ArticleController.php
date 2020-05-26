<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogTag;
use Modules\Blog\Models\BlogTopic;
use Modules\Blog\Models\BlogArticle;
use Modules\Blog\Models\BlogComment;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\BlogArticleTag;


class ArticleController extends AdminController
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
    public function index(Request $request)
    {
    	$order = $request->get('order')??'desc';
    	$page = $request->get('page')??1;
    	$paginate = $request->get('paginate')??10;
    	$count = BlogArticle::query()->count();
    	$articles = BlogArticle::query()->orderBy('id', $order)->with(['category', 'topic'])->paginate($paginate);

    	return view('admin::blog.article.index',  [
    		'page' => $page,
    		'count' => $count,
    		'paginate' => $paginate,
            'articles' => $articles,
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
		return view('admin::blog.article.create_and_edit',[
            'article' => new BlogArticle(),
            'tags' => BlogTag::all(),
            'topics' => BlogTopic::all(),
            'categories' => BlogCategory::all(),
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

        $this->validateArticle($data);

        list($data, $tagIds) = $this->handleData($data);

        $article = BlogArticle::create($data);

        if ($article) {
            $articleTag = new BlogArticleTag();
            $articleTag->addArticleTag($article->id, $tagIds);
        }
        return success('添加成功', route('admin.blog.article'));
    }

    /**
    * 编辑
    *
    * @access public 
    * @param
    * @return view
    */
    public function edit(BlogArticle $article)
    {
        return view('admin::blog.article.create_and_edit',[
            'article' => $article,
            'tags' => BlogTag::all(),
            'topics' => BlogTopic::all(),
            'categories' => BlogCategory::all(),
        ]);
    }

    /**
    * 保存编辑
    *
    * @access public 
    * @param
    * @return status
    */
    public function update(BlogArticle $article, Request $request)
    {
        $data = $request->except('_token');

        $this->validateArticle($data);

        list($data, $tagIds) = $this->handleData($data);

        $article->update($data);

        $articleTag = new BlogArticleTag();
        $articleTag->addArticleTag($article->id, $tagIds);

        return success('编辑成功', route('admin.blog.article'));
    }

    /**
    * 删除
    *
    * @access public 
    * @param
    * @return status
    */
    public function delete(BlogArticle $article)
    {
        $article->delete();
        BlogComment::query()->where('article_id', $article->id)->delete();
        BlogArticleTag::query()->where('article_id', $article->id)->delete();
        return success('删除成功', 'refresh');
    }

    /**
    * 验证提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function validateArticle($data)
    {
        $rule = [
            'title' => 'required',
            'category_id' => 'required',
            'tag' => 'required',
            'cover' => 'required',
            'markdown' => 'required',
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
        $data['cover'] = upload_base64_img($data['cover'], 'blog/cover', false);

        $data['html'] = markdown_to_html($data['markdown']);

        if($data['description'] == null) {
            $data['description'] = strip_tags(mb_substr($data['html'], 0, 100));
        }

        if(!array_key_exists('istop', $data)) {
            $data['istop'] = 0;
        }

        $tagIds = $data['tag'];
        unset($data['tag']);

        return [$data, $tagIds];
    }

    /**
    * 图片文件上传
    *
    * @access protected 
    * @param
    * @return 
    */
    public function uploadImg(Request $request)
    {
        $result = upload_file('editormd-image-file', 'blog/article');
        $data = [
            'success' => 1,
            'message' => $result['message'],
            'url'     => $result['data'][0]['path'],
        ];
        return response()->json($data);
    }
}