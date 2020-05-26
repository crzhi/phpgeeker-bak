<?php

namespace Modules\Passport\Http\Controllers;

use Modules\Passport\Http\Controllers\PassportController;

use Uuid;
use \Cache;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Modules\Passport\Models\User;
use Modules\Passport\Models\OAuthUser;

class OAuthController extends PassportController
{
    public $app;

    public function __construct()
    {
        // parent::__construct();
        $this->app = app('wechat.official_account');

    }
	/**
	 * github
	 *
	 * @return
	 */
	public function githubLogin()
	{
		return Socialite::driver('github')->redirect();
	}

	public function githubCallback()
    {
        $auth = Socialite::driver('github')->user();

        return $this->verifyUserStatus($auth);
    }

	/**
	 * qq
	 *
	 * @return
	 */
	public function qqLogin()
	{
		return Socialite::driver('qq')->redirect();
	}

	public function qqCallback()
    {
        $auth = Socialite::driver('qq')->user();

        return $this->verifyUserStatus($auth);
    }

    /**
     * qq
     *
     * @return
     */
    public function weiboLogin()
    {
        return Socialite::driver('weibo')->redirect();
    }

    public function weiboCallback()
    {
        $auth = Socialite::driver('weibo')->user();

        return $this->verifyUserStatus($auth);
    }

    public function weiboCancle()
    {
        return redirect(route('login'));
    }

    /**
     * qq
     *
     * @return
     */
    public function wechatQrcode(Request $request)
    {
        if (!$qrcodeFlag = $request->cookie('qrcodeFlag')) {
            $qrcodeFlag = Uuid::generate()->string;
        }

        if (!$url = Cache::get('qrcodeUrl' . $qrcodeFlag)) {
            // 有效期 1 天的二维码
            $qrcode = $this->app->qrcode;
            $result = $qrcode->temporary($qrcodeFlag, 3600 * 24);
            $url    = $qrcode->url($result['ticket']);

            Cache::put('qrcodeUrl' . $qrcodeFlag, $url, now()->addDay());
        }

        // 自定义参数返回给前端，前端轮询
        return response(compact('url', 'qrcodeFlag'))
            ->cookie('qrcodeFlag', $qrcodeFlag, 24 * 60);
    }

    /**
     * 微信用户登录检查
     *
     * @param Request $request
     *
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function wechatCheck(Request $request)
    {
        // 判断请求是否有微信登录标识
        if (!$flag = $request->wechat_flag) {
            return response()->json(['status'=>false, 'step' => 1]);
        }

        // 根据微信标识在缓存中获取需要登录用户的 UID
        $userId  = Cache::get('login_wechat' . $flag);

        if (empty($userId)) {
            return response()->json(['status'=>false, 'step' => 2]);
        }

        // 登录用户、并清空缓存
        Auth::guard()->loginUsingId($userId, true);
        Cache::forget('login_wechat' . $flag);
        Cache::forget('qrcodeUrl' . $flag);

        return response()->json(['status'=>true]);
    }

    protected function verifyUserStatus($auth)
    {
    	$map = ['openid' => $auth->id,
    			'provider' => $auth->provider
    		];

    	$oAuthUser = OAuthUser::query()->where($map)->first();

    	if($oAuthUser) {
    		$userId = $this->OauthUseUpdate($auth, $oAuthUser);
    	} else {
    		$userId = $this->OauthUserRegister($auth);
    	}

    	Auth::guard()->loginUsingId($userId, true);

        return redirect(route('www'));
    }



    protected function OauthUseUpdate($auth, $oAuthUser)
    {
    	User::find($oAuthUser->user_id)->update([
    		'nickname' => $auth->nickname,
    		'avatar' => $auth->avatar,
    	]);

    	$oAuthUser->update([
    		'token' => $auth->token
    	]);

    	return $oAuthUser->user_id;
    }

    protected function OauthUserRegister($auth)
    {
    	$userId = User::create([
    		'nickname' => $auth->nickname,
    		'avatar' => $auth->avatar,
    	])->id;

    	OAuthUser::create([
    		'user_id' => $userId,
    		'provider' => $auth->provider,
    		'openid' => $auth->id,
    		'token' => $auth->token
    	]);

    	return $userId;
    }
}
