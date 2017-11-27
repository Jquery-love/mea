<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Content;
use App\Models\Files;

class HomeController extends Controller
{
    //
    public function index(Column $column,Content $content,Files $files){
        $colhd = $column->where('parent_id',0)->orderBy('sort','asc')->find([1, 2, 3,4,5,6,10]);
        $colft = $column->where('parent_id',0)->orderBy('sort','asc')->find([6,7,8,9]);
        $banners = $files->where([['application','=',2],['column_id','=',0]])->orderBy('sort','asc')->get();
        $company = $column->find(10);
        $cases = $content->whereIn('column_id',[4,9])->where('recommend',1)->orderBy('updated_at','desc')->get();
        return view('home',compact('colhd','colft','company','banners','newests','cases'));
    }
}
