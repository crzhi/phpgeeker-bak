<?php

namespace Modules\Mall\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Passport\Models\User;

class UserAddress extends Model
{
    use SoftDeletes;

	protected $table = 'mall_user_addresses';//表名

    protected $primaryKey = 'id'; //主键

    protected $fillable = [
        'user_id',
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'is_default',
        'last_used_at',
    ];

    protected $dates = ['last_used_at, deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}