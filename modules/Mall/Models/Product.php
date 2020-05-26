<?php

namespace Modules\Mall\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'mall_products';

    protected $fillable = [
        'category_id',
        'title', 
        'sub_title',
        'description', 
        'image', 
        'on_sale',
        'rating', 
        'sold_count', 
        'review_count', 
        'price'
    ];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    //分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 与商品SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
    
    // 与商品sku_attribute关联
    public function skuKeys()
    {
        return $this->hasMany(ProductSkuKey::class);
    }
    
    // 与商品sku_attribute关联
    public function skuValues()
    {
        return $this->hasMany(ProductSkuValue::class);
    }

    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }

    //获取商品详情页面的SKU
    public function getSkuDetail()
    {
        //商品sku组合属性
        $skuArray = [[]];
        $skus = $this->skus()->get();
        foreach($skus as $sku) {
            $skuArrKey = implode(';', json_decode($sku->product_skus, true));
            $skuArr = [$skuArrKey => [
                'price' => $sku->price,
                'picture' => $sku->picture,
                'stock' => $sku->stock,
            ]];
            $skuArray += $skuArr;
        }
        unset($skuArray[0]);

        //商品skuvalue的 id
        $valueArray = [];
        $skuValueArr =  $this->skuValues()->select('id', 'product_sku_key_id')->get()->groupBy('product_sku_key_id')->toArray();
        foreach($skuValueArr as $skuValues) {
            $valueIds = [];
            foreach($skuValues as $skuValue) {
                array_push($valueIds,$skuValue['id']);
            }
            array_push($valueArray, $valueIds);
        }

        //商品详情的产品属性
        $propertyArray = [[]];
        $skuKeys = $this->skuKeys()->with('skuValues')->get();
        foreach($skuKeys as $skuKey) {
            $skuValueName = [];
            foreach($skuKey->skuValues as $skuValue) {
                array_push($skuValueName, $skuValue->title);
            }
            $skuKey = $skuKey->title;
            $skus = [$skuKey => $skuValueName];
            $propertyArray += $skus;
        }
        unset($propertyArray[0]);

        return [
            'data'=>$skuArray,
            'keys' => $valueArray,
            'property' =>$propertyArray
        ];
    }

}
