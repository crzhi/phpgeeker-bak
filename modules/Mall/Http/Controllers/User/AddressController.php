<?php

namespace Modules\Mall\Http\Controllers\User;

use Modules\Mall\Http\Controllers\MallController;

use Modules\Mall\Models\Region;
use Modules\Mall\Models\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Passport\Models\User;
use Auth;

class AddressController extends MallController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 首页
    *
    * @access public 
    * @param
    * @return view
    */
    public function index(Request $request)
    {
    	return view('mall::user.address.index',  [
    		'addresses' => $request->user()->addresses,
        ]);
    }


    /**
    * 新建地址
    *
    * @access public 
    * @param
    * @return 
    */
    public function create()
    {
        return view('mall::user.address.create_and_edit', [
            'address' => new UserAddress(),
        ]);
    }


    /**
    * 新建地址
    *
    * @access public 
    * @param
    * @return 
    */
    public function region($id = 0)
    {
        return json_encode(Region::query()->where('pid', $id)->get()->toArray());
    }


    /**
    * 编辑地址
    *
    * @access public 
    * @param
    * @return 
    */
    public function edit(UserAddress $address)
    {
        return view('mall::user.address.create_and_edit', [
            'address' => $address
        ]);
    }

    /**
    * 新建地址
    *
    * @access public 
    * @param
    * @return 
    */
    public function store(Request $request)
    {
        if($request['is_default'] == '1') {
            UserAddress::where('user_id', $request->user()->id)->update(['is_default'=>'0']);
        } else {
            $request['is_default'] = '0';
        }
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'contact_name',
            'contact_phone',
            'is_default'
        ]));
        return success('新建地址成功', '/user/address');
    }

    /**
    * 编辑地址
    *
    * @access public 
    * @param
    * @return 
    */
    public function update(UserAddress $address, Request $request)
    {
        if($request['is_default'] == '1') {
            UserAddress::where('user_id', $request->user()->id)->update(['is_default'=>'0']);
        } else {
            $request['is_default'] = '0';
        }
        $address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'contact_name',
            'contact_phone',
            'is_default',
        ]));
        return success('编辑地址成功', '/user/address');
    }

    /**
    * 删除用户地址
    *
    * @access public 
    * @param
    * @return 
    */
    public function delete(UserAddress $address)
    {
        $address->delete();
        return success('删除成功', '/user/address');
    }
}