<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Http\Controllers\BlogController;

use Illuminate\Http\Request;

class ErrorController extends BlogController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error404()
    {
    	return view('blog::errors.404');
    }
}