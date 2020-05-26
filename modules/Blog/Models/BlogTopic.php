<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTopic extends Model
{
    use SoftDeletes;
    
	protected $table        = 'blog_topics';

    protected $fillable = [
        'title',
        'image',
        'description'
    ];

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'topic_id', 'id');
    }
}
