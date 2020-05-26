<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticleTag extends Model
{
    use SoftDeletes;
    
    protected $table = 'blog_article_tags';

    protected $fillable = [
        'article_id',
        'tag_id',
    ];

    /**
     * 为文章批量插入标签
     *
     * @param $article_id
     * @param $tag_ids
     */
    public function addArticleTag($article_id, $tag_ids)
    {
    	$this->where('article_id', $article_id)->forceDelete();
        // 组合批量插入的数据
        $data = [];
        foreach ($tag_ids as $k => $v) {
            $data[] = [
                'article_id' => $article_id,
                'tag_id'     => $k,
            ];
        }
        $this->insert($data);
    }
}
