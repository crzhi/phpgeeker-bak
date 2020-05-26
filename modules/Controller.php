<?php

namespace Modules;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($message="操作成功", $url = '')
    {
        return response([
            'code'=> 1,
            'message' => $message,
            'url' => $url,
        ]);
    }

    public function error($message="操作失败", $url = '')
    {
        return response([
            'code'=> 2,
            'message' => $message,
            'url' => $url,
        ]);
    }
}
