<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Content;

class ContentsController extends Controller
{
    //
    public function index($colId,$conId){
        $cols = new Column;
        $cons = new Content;
        //dd($colId);
        $colhd = $cols->where('parent_id',0)->orderBy('sort','asc')->find([1, 2, 3,4,5,6]);
        $colft = $cols->where('parent_id',0)->orderBy('sort','asc')->find([6,7,8,9]);

        $colKey = preg_match('/^\d+$/',$colId) ? 'id' : 'path';

        if(stripos($conId,'.')>0){
            $conId = substr($conId,0,stripos($conId,'.'));
        }
        $conKey = preg_match('/^\d+$/',$conId) ? 'id' : 'path';

        $column = $cols->where($colKey,$colId)->with('parentId')->first();
        $content = $cons->where($conKey,$conId)->first();


        return view($content->template,compact('colhd','colft','column','content'));

    }
}
