<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticle extends Model
{
    use SoftDeletes;

	protected $table = 'blog_articles';//表名

    // protected $primaryKey = 'id'; //主键

    protected $fillable = [
        'topic_id',
        'category_id',
        'title',
        'cover',
        'description',
        'html',
        'markdown',
        'view',
        'comment',
        'istop'
    ];//可以被批量赋值的属性.

    // protected $guarded = [];//所有属性都是可批量赋值的

    protected $dates = ['deleted_at'];

    public function category()
    {
    	return $this->belongsTo(BlogCategory::class);
    }

    public function topic()
    {
        return $this->belongsTo(BlogTopic::class)->withDefault(['title'=>'']);
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_article_tags', 'article_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'article_id', 'id');
    }
}
