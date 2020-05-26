<?php

namespace Modules\Admin\Http\Controllers\Index;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function index()
    {
    	return view('admin::index.index');
    }

    public function info()
    {
    	return view('admin::layouts.lib.info');
    }
}