<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogLink extends Model
{
    use SoftDeletes;
    
	protected $table = 'blog_links';

    protected $fillable = [
        'url',
        'title',
        'ico',
        'description',
    ];
}
