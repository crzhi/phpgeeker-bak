<?php

namespace Modules\Mall\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
	use SoftDeletes;

	protected $table = 'mall_banners';

    protected $fillable = [
        'image_url',
        'image_src',
        'rank'
    ];

    protected $datas = ['deleted_at'];
}