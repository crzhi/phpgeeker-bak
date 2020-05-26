<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Passport\Models\User;

class BlogMessage extends Model
{
    use SoftDeletes;
    
	protected $table = 'blog_messages';

    protected $fillable = [
        'user_id',
        'content',
        'pid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
