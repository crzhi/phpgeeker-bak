<?php

namespace Modules\Admin\Http\Controllers\Wechat;

use Modules\Admin\Http\Controllers\AdminController;

use Log;
use \Cache;
use Illuminate\Support\Facades\Auth;

use Modules\Passport\Models\User;
use Modules\Passport\Models\OAuthUser;

class WechatController extends AdminController
{	
	public $app;

    public function __construct()
    {
        // parent::__construct();
    	$this->app = app('wechat.official_account');

    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index()
    {
        
        return view('admin::wechat.index');
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');

        $this->app->server->push(function($message){
            if ($message) {
                $method = camel_case('handle_' . $message['MsgType']);

                if (method_exists($this, $method)) {
                    $this->openid = $message['FromUserName'];

                    return call_user_func_array([$this, $method], [$message]);
                }

                Log::info('无此处理方法:' . $method);
            }
            return "您好！欢迎关注 PHP极客";
        });

        return $this->app->server->serve();
    }

    /**
     * 事件引导处理方法（事件有许多，拆分处理）
     *
     * @param $event
     *
     * @return mixed
     */
    protected function handleEvent($event)
    {
        Log::info('事件参数：', [$event]);

        $method = camel_case('event_' . $event['Event']);
        Log::info('处理方法:' . $method);

        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], [$event]);
        }

        Log::info('无此事件处理方法:' . $method);
    }

    /**
     * 扫描带参二维码事件
     *
     * @param $event
     */
    public function eventSCAN($event)
    {
        if ($wechatUser = OAuthUser::query()->where(['provider' => 'WeChat', 'openid' => $this->openid])->first()) {
            // 微信用户信息
            $wechatUserInfo = $this->app->user->get($this->openid);
            $wechatUser->update([
                'nickname' => $wechatUserInfo['nickname'],
                'avatar' => $wechatUserInfo['headimgurl'],
            ]);
            // 标记前端可登陆
            $this->markTheLogin($event, $wechatUser->user_id);

            return;
        }
    }

    /**
     * 取消订阅
     *
     * @param $event
     */
    protected function eventUnsubscribe($event)
    {
        OAuthUser::query()->where(['provider' => 'WeChat', 'openid' => $this->openid])->first()->update(['subscribe'=>0]);
        return;
    }

    /**
     * 订阅
     *
     * @param $event
     *
     * @throws \Throwable
     */
    protected function eventSubscribe($event)
    {
        $openId = $this->openid;

        if ($wechatUser = OAuthUser::query()->where(['provider' => 'WeChat', 'openid' => $openId])->first()) {
            $wechatUser->update(['subscribe'=>1]);
            // 标记前端可登陆
            $this->markTheLogin($event, $wechatUser->user_id);

            return;
        }

        // 微信用户信息
        $wechatUserInfo = $this->app->user->get($openId);

        // 注册
        $userId = User::create([
            'nickname' => $wechatUserInfo['nickname'],
            'avatar' => $wechatUserInfo['headimgurl'],
        ])->id;

        OAuthUser::create([
            'user_id' => $userId,
            'provider' => 'WeChat',
            'openid' => $openId,
            'token' => '',
            'subscribe' => 1,
        ]);

        $this->markTheLogin($event, $userId);
        
    }

    /**
     * 标记可登录
     *
     * @param $event
     * @param $uid
     */
    public function markTheLogin($event, $userId)
    {
        if (empty($event['EventKey'])) {
            return;
        }

        $eventKey = $event['EventKey'];

        // 关注事件的场景值会带一个前缀需要去掉
        if ($event['Event'] == 'subscribe') {
            $eventKey = str_after($event['EventKey'], 'qrscene_');
        }

        Log::info('EventKey:' . $eventKey, [$event['EventKey']]);

        // 标记前端可登陆
        Cache::put('login_wechat' . $eventKey, $userId, now()->addMinute(30));
    }
}