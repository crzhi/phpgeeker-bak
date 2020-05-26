<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Models\BlogArticle;

class ArchivesController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 总标签页
    *
    * @access public 
    * @param BlogTag $tag
    * @return view
    */
    public function index()
    {
        return view('blog::archives.index',  [
            'datas' => $this->articles()
        ]);
    }

    protected function articles($startYear = 2018)
    {        
        $datas = array();
        for($currentYear = date('Y'); $currentYear >= $startYear; $currentYear--) {
            $data['year'] = $currentYear;
            $data['articles'] = BlogArticle::query()->where('created_at', '<=', $currentYear."-12-31 23:59:59")->where('created_at', '>=', $currentYear."-01-01 00:00:00")->orderBy('created_at','desc')->with('topic')->get();
            array_push($datas, $data);
        }
        return $datas;
    }
}