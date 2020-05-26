<?php

namespace Modules\Mall\Models;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Model;

class ProductSkuKey extends Model
{
    protected $table = 'mall_product_sku_keys';

    protected $fillable = ['product_id', 'title'];


    // 与商品skus关联
    public function skuValues()
    {
        return $this->hasMany(ProductSkuValue::class);
    }
}
