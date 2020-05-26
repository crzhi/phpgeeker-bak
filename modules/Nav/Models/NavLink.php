<?php

namespace Modules\Nav\Models;

use Illuminate\Database\Eloquent\Model;

class NavLink extends Model
{
    protected $table = 'nav_links';
    protected $fillable = [
        'category_id',
        'favicon',
        'title',
        'description',
        'url',
        'rank',
        'hot'
    ];
    public function category()
    {
        return $this->belongsTo(NavCategory::class, 'category_id', 'id');
    }
}