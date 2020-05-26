<?php

namespace Modules\Www\Http\Controllers;

use Modules\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WwwController extends Controller
{
    public function index()
    {
        return view('www::index', [
            'image' => $this->getImageByBingJson()
        ]);
    }

    public function image(Request $request)
    {
        $idx = $request->get('idx');
        return $this->getImageByBingJson($idx);
    }

    public function getImageByBingJson($idx = 0, $n = 1)
    {
        $url = "https://cn.bing.com/HPImageArchive.aspx?format=js&idx=$idx&n=$n&mkt=zh-CN";
        $data = json_decode(file_get_contents($url), true);
        $res = $data['images'][0];
        $image = [
            'url' => 'https://cn.bing.com' . $res['url'],
            'disc' => $res['copyright'],
            'date' => substr($res['enddate'], 0, 4) . '-' . substr($res['enddate'], 4, 2) . '-' . substr($res['enddate'], 6, 2),
        ];
        return $image;
    }
}