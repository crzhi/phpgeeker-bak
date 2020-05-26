<?php

namespace Modules\Mall\Models;

use Illuminate\Database\Eloquent\Model;

class UserCollectProduct extends Model
{
	protected $table = 'mall_user_collect_products';//表名

    protected $primaryKey = 'id'; //主键

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function products()
    {
    	return $this->hasOne(Product::class, 'id', 'product_id');
    }
}