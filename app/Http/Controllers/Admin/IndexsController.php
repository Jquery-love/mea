<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Column;
use App\Models\Content;


class IndexsController extends Controller
{
    //
    public function index(User $user,Column $column,Content $content){
        $column = $column->where('parent_id',0)->orderBy('sort','desc')->take(10)->get();
        $content = $content->orderBy('sort','desc')->orderBy('created_at','desc')->take(10)->get();
        $user = $user->all();
    	return view('admin.index',compact('user','content','column'));
    }
}
