<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Content;

class HomeController extends Controller
{
    //
    public function index(Column $column,Content $content){
        $colhd = $column->where('parent_id',0)->orderBy('sort','asc')->find([1, 2, 3,4,5,6]);
        $colft = $column->where('parent_id',0)->orderBy('sort','asc')->find([6,7,8,9]);

        $about = $column->find(1);
        $exhibitionContent = $content->where('column_id',7)->where('recommend',1)->orderBy('updated_at','desc')->first();
        return view('home',compact('colhd','colft','about','exhibitionContent'));
    }
}
