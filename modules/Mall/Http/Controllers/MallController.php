<?php

namespace Modules\Mall\Http\Controllers;

use Modules\Controller;
use Modules\Mall\Models\CartItem;

class MallController extends Controller
{
    /**
    * 程序初始化参数
    *
    * @access public 
    * @param
    * @return
    */
    public function __construct()
    {
        $this->cartBadge();
    }

    public function cartBadge()
    {
        $this->middleware(function ($request, $next) {
            view()->share('cartBadge', '0');
            if($user = $request->user()) {
                view()->share('cartBadge', CartItem::where('user_id', $user->id)->sum('amount'));
            }
            return $next($request);
        });
    }
}
