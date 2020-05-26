<?php

namespace Modules\Mall\Http\Controllers\Index;

use Modules\Mall\Http\Controllers\MallController;

use Modules\Mall\Services\CategoryService;

use Illuminate\Http\Request;

use Modules\Mall\Models\Banner;
use Modules\Mall\Models\Category;
use Modules\Mall\Models\Product;

class IndexController extends MallController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index(Request $request, CategoryService $categoryService)
    {
        $banners = Banner::orderBy('rank', 'asc')->get();
    	return view('mall::index.index',  [
    		'categoryTree' => $categoryService->getCategoryTree(),
            'banners' => $banners,
            'hotCategories' => Category::whereIn('id', ['83','111','159'])->get(),
            'hotProducts' => Product::whereIn('id', ['1','2','3', '4'])->get(),
        ]);
    }
}