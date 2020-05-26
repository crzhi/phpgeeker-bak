<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends Model
{
    use SoftDeletes;
    
	protected $table = 'blog_tags';

    protected $fillable = [
        'title',
        'description',
    ];

    public function articles()
    {
        return $this->belongsToMany(BlogArticle::class, 'blog_article_tags', 'tag_id', 'article_id');
    }
}
