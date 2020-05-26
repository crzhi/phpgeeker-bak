<?php

namespace Modules\Mall\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Passport\Models\User;

class CartItem extends Model
{
    protected $table = 'mall_cart_items';

    protected $fillable = ['amount'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}