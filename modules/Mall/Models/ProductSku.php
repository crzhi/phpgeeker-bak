<?php

namespace Modules\Mall\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Mall\Models\ProductSkuKey;
use Modules\Mall\Models\ProductSkuValue;
use Modules\Mall\Exceptions\InternalException;

class ProductSku extends Model
{
    protected $table = 'mall_product_skus';

    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('减库存不可小于0');
        }

        return $this->newQuery()->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }

    public function attrValue()
    {
        $skus = "";
        $productSkus = json_decode($this->product_skus, true);
        foreach($productSkus as $skuKey=>$skuValue) {
            $key = ProductSkuKey::find($skuKey)->title;
            $value = ProductSkuValue::find($skuValue)->title;
            $skus = $skus . $key . ":" . $value. "<br>";
        }
        return $skus;

    }
}
