<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
    
	protected $table = 'blog_categories';

    protected $fillable = [
        'title',
        'image',
        'description',
    ];

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'category_id', 'id');
    }
}
