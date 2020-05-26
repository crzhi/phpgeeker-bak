<?php

namespace Modules\Mall\Http\Controllers\User;

use Modules\Mall\Http\Controllers\MallController;
use Modules\Mall\Models\Product;
use Illuminate\Http\Request;
use Modules\Passport\Models\User;

class FavoriteController extends MallController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);
    	return view('mall::user.favorite',  [
    		'products' => $products,
        ]);
    }


    public function favor(Product $product, Request $request)
    {
        $user = $request->user();
        if(!$user) {
            return error('请先登录');
        }
        if ($user->favoriteProducts()->find($product->id)) {
            return;
        }

        $user->favoriteProducts()->attach($product);

        return success('收藏成功');
    }

    public function disfavor(Product $product, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);

        return success('取消收藏成功');
    }
}