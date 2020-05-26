<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Passport\Models\User;

class BlogComment extends Model
{
    use SoftDeletes;

	protected $table = 'blog_comments';

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
        'pid',
    ];

    public function article()
    {
    	return $this->belongsTo(BlogArticle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
