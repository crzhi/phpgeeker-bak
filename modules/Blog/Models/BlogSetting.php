<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogSetting extends Model
{
    use SoftDeletes;
    
	protected $table        = 'blog_setting';

    protected $fillable = [
        'name',
        'title',
        'logo',
        'keywords',
        'description',
        'admin_name',
        'admin_avatar',
        'admin_slogan',
        'email',
        'github_name',
        'github_url',
        'qqgroup',
        'qqgroup_url',
        'wechat',
        'wechat_qrcode',
        'icp',
    ];
}
