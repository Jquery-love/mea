<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginsController extends Controller
{
    //
    public function create(){
    	return view('admin.login');
    }
    public function store(Request $request){
    	$this->validate($request,[
    		'username' => 'required|max:24',
    		'password' => 'required'
    	]);
    	$credentials = [
    		'name' => $request->{'username'},
    		'password' => $request->{'password'}
    	];

    	if(Auth::attempt($credentials)){
    		// 登录成功后的相关操作
    		session()->flash('success', '欢迎回来！');
           return redirect()->route('admin', [Auth::user()]);
    	}else{
    		// 登录失败后的相关操作
    		// session()->flash('danger', '很抱歉，您的名称和密码不匹配');
    		return redirect()->back()->with([
    			'danger' => '很抱歉，您的名称和密码不匹配'
    		]);
    	}
    	return;
    }
    public function destroy(){
    	Auth::logout();
    	session()->flash('success','您已成功退出！');
    	return redirect()->route('login');
    }
}
