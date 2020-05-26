<?php

namespace Modules\Nav\Models;

use Illuminate\Database\Eloquent\Model;

class NavCategory extends Model
{
	protected $table = 'nav_categories';
    protected $fillable = [
        'pid',
        'title',
        'icon',
        'rank',
        'hot'
    ];
    public function link()
    {
        return $this->hasMany(NavLink::class, 'category_id', 'id')->orderby('rank','asc')->orderby('created_at','asc');
    }  
    public function lower()
    {
        return $this->hasMany(NavCategory::class, 'pid', 'id')->orderby('rank','asc')->orderby('created_at','asc');
    }
}