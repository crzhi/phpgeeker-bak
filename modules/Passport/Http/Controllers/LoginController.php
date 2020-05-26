<?php

namespace Modules\Passport\Http\Controllers;

use Modules\Passport\Http\Controllers\PassportController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends PassportController
{
	/**
	 * 登录页面
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm()
	{
		return view('passport::login.index');
	}

	/**
	* 登录验证
	*
	* @access public 
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response Array
	*/
   public function login(Request $request)
   {
		$data = $request->except('_token');
		$this->validateLogin($data);
		if (Auth::guard()->attempt($request->only('email', 'password'), true)) {
			$request->session()->regenerate();
			$data = [
				'code' => 1,
				'message' => '登录成功',
				'url' => modules_domain(),
			];
			return response()->json($data);
		}
		return error('登录失败,请验证账号密码');
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
		   'email' => 'required|email',
		   'password' => 'required',
		   'captcha' => 'required|captcha'
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
		Auth::guard()->logout();
		$request->session()->invalidate();
		
		// return redirect(route('login'));
		// return redirect(url()->previous());
		return redirect()->back();
	}
}
