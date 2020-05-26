<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Modules\Admin\Http\Controllers\AdminController;

use Modules\Admin\Models\AdminUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends AdminController
{

    /**
    * 登录
    *
    * @access public 
    * @param
    * @return view
    */
    public function login()
    {
    	return view('admin::auth.login', [
    		'admin' => new AdminUser()
    	]);
    }

    /**
    * 尝试登陆
    *
    * @access protected 
    * @param
    * @return 
    */
    public function doLogin(Request $request)
    {
        $data = $request->except('_token');

        $this->validateLogin($data);

        if (Auth::guard('admin')->attempt($request->only('username', 'password'), true)) {           
            $request->session()->regenerate();
            return response()->json(['code' => 1, 'message' => '登录成功', 'url' => route('admin')]);
        }
        return error('登录失败，账号密码错误');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   protected function validateLogin($data)
   {
       $rules = [
           'username' => 'required',
           'password' => 'required'
       ];
       $validator = Validator::make($data, $rules);
       if ($validator->fails()) {
            return error($validator->errors()->first());
       }
   }

     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect(route('admin.login'));
    }
}