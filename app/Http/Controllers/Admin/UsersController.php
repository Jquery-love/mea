<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index(User $user){
        $users = $user->all();
        $page = 'users';
        return view('admin.user.index',compact('users','page'));
    }
    public function create(User $user){
        $page = 'users';
        return view('admin.user.create',compact('page'));
    }
    public function store(Request $request,User $user){
        $messages = [
            'repassword.required' => '确认密码 不能为空.'
        ];
        $this->validate($request,[
            'name' => 'required|max:300',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:20',
            'repassword' => 'required|same:password|max:20'
        ],$messages);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $bool = $user->save();

        if($bool){
            return redirect()->route('users.index');
        }else{
            return redirect()->back()->with([
                'danger' => '很抱歉，添加用户失败'
            ]);
        }
    }
    public function edit(User $user){
        //文章所属类目
        $page = 'users';
        return view('admin.user.edit',compact('user','page'));
    }
    public function update(User $user,Request $request){
        $messages = [
            'repassword.required' => '确认密码 不能为空.'
        ];
        $this->validate($request,[
            'name' => 'required|max:300',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:20'
        ],$messages);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'  => bcrypt($request->password)
        ]);
        session()->flash('success','更新成功');
        return redirect()->route('users.index');
    }
    public function destroy(Request $request,User $user){
        if($user->id){
            $user->delete();
        }
        return redirect()->route('users.index');
    }
}
