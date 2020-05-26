<?php

namespace Modules\Mall\Http\Controllers\Products;

use Modules\Mall\Http\Controllers\MallController;
use Modules\Mall\Exceptions\InvalidRequestException;

use Illuminate\Http\Request;

use Modules\Mall\Models\Product;
use Modules\Mall\Models\ProductSku;
use Modules\Mall\Models\ProductSkuKey;
use Modules\Mall\Models\ProductSkuValue;
use Modules\Mall\Models\Category;
use Modules\Mall\Models\OrderItem;

class ProductsController extends MallController
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
        $builder = Product::query()->where('on_sale', true);

        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('sub_title', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        if ($order = $request->input('order', '')) {
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        // 如果有传入 category_id 字段，并且在数据库中有对应的类目
        if ($request->input('category_id') && $category = Category::find($request->input('category_id'))) {
            // 如果这是一个父类目
            if ($category->is_directory) {
                // 则筛选出该父类目下所有子类目的商品
                $builder->whereHas('category', function ($query) use ($category) {
                    // 这里的逻辑参考本章第一节
                    $query->where('path', 'like', $category->path.$category->id.'-%');
                });
            } else {
                // 如果这不是一个父类目，则直接筛选此类目下的商品
                $builder->where('category_id', $category->id);
            }
        }

        $products = $builder->paginate(16);

    	return view('mall::products.index',  [
    		'products' => $products,
            'filters'  => [
                'search' => $search,
                'order'  => $order,
            ],
            'category' => $category ?? null,
        ]);
    }


    public function show(Product $product, Request $request)
    {
        // 判断商品是否已经上架，如果没有上架则抛出异常。
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }
        
        $favored = false;
        // 用户未登录时返回的是 null，已登录时返回的是对应的用户对象
        if($user = $request->user()) {
            // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品,boolval() 函数用于把值转为布尔值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        $skuDetail = $product->getSkuDetail();

        $skuKeys = $product->skuKeys()->with('skuValues')->get();

        $reviews = OrderItem::query()
            ->with(['order.user', 'productSku']) // 预先加载关联关系
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at') // 筛选出已评价的
            ->orderBy('reviewed_at', 'desc') // 按评价时间倒序
            ->limit(10) // 取出 10 条
            ->get();

        $similarProducts = Product::where('on_sale', true)->where('category_id', $product->category->id)->where('id', '!=', $product->id)->orderBy('rating', 'desc')->take(5)->get();

        return view('mall::products.show', [
            'product' => $product, 
            'favored' => $favored,
            'keys' => json_encode($skuDetail['keys']),
            'data' => json_encode($skuDetail['data']),
            'properties' => $skuDetail['property'],
            'skuKeys' => $skuKeys,
            'reviews' => $reviews,
            'similarProducts' => $similarProducts
        ]);
    }
}
