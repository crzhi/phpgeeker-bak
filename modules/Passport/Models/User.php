<?php

namespace Modules\Passport\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Modules\Mall\Models\UserAddress;
use Modules\Mall\Models\Product;
use Modules\Mall\Models\CartItem;

class User extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'passport_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'nickname', 'avatar', 'email', 'phone', 'log_times', 'last_log_ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Mall
        //收货地址
        public function addresses()
        {
            return $this->hasMany(UserAddress::class)->orderBy('is_default', 'desc');
        }
        //购物车商品
        public function cartItems()
        {
            return $this->hasMany(CartItem::class);
        }
        //收藏商品
        public function favoriteProducts()
        {
            return $this->belongsToMany(Product::class, 'mall_user_favorite_products')
                ->withTimestamps()
                ->orderBy('mall_user_favorite_products.created_at', 'desc');
        }
}
