<?php

namespace Modules\Admin\Http\Controllers\Blog;

use Modules\Admin\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Modules\Blog\Models\BlogSetting;

class SettingController extends AdminController
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index()
    {
    	$set = BlogSetting::query()->find(1);

    	return view('admin::blog.setting.index',  [
            'set' => $set,
        ]);
    }

    /**
    * 保存
    *
    * @access public 
    * @param
    * @return status
    */
    public function update(BlogSetting $set, Request $request)
    {
        $data = $request->except('_token', '_method');

        $this->validateSetting($data);

        $data = $this->handle($data);

        $set->where('id', $data['id'])->update($data);

        return success('修改成功', 'refresh');
    }

    /**
    * 验证提交信息
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function validateSetting($data)
    {
        $rule = [
            'name' => 'required',
            'title' => 'required',
            'logo' => 'required',
            'keywords' => 'required',
            'description' => 'required',
            'admin_name' => 'required',
            'admin_avatar' => 'required',
            'admin_slogan' => 'required',
            'email' => 'required|email',
            'github_name' => 'required',
            'github_url' => 'required|url',
            'qqgroup' => 'required',
            'qqgroup_url' => 'required',
            'wechat' => 'required',
            'wechat_qrcode' => 'required',
            'icp' => 'required',
        ];
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return error($validator->errors()->first());
        }
    }

    /**
    * 保存
    *
    * @access public 
    * @param
    * @return status
    */
    public function handle($data)
    {
        $data['logo'] = upload_base64_img($data['logo'], 'blog/set', false);
        $data['admin_avatar'] = upload_base64_img($data['admin_avatar'], 'blog/set', false);
        $data['wechat_qrcode'] = upload_base64_img($data['wechat_qrcode'], 'blog/set', false);
        return $data;
    }
}