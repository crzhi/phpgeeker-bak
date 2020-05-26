<?php

namespace Modules\Passport\Http\Controllers;

use Modules\Passport\Http\Controllers\PassportController;

use Modules\Passport\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends PassportController
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('passport::register.index');
    }

    /**
    * 注册
    *
    * @access protected 
    * @param
    * @return 
    */
    protected function register(Request $request)
    {
        $data = $request->except('_token');
        $this->validateRegister($data);

        $data = $this->handle($data);
        User::create($data);

        return success('注册成功,前往登录', route('login'));
    }

    protected function validateRegister($data)
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6|max:16',
            'captcha' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return error($validator->errors()->first());
        }
    }

    protected function handle($data)
    {
        $data['nickname'] = $data['email'];
        $data['password'] = Hash::make($data['password']);
        $data['avatar'] = '/modules/passport/images/user.jpg';

        return $data;
    }
}
