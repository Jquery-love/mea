<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;


class ColumnsController extends Controller
{
    //
    public function index($query){
        //var_dump($query);
        $cols = new Column;
        $colhd = $cols->where('parent_id',0)->orderBy('sort','asc')->find([1, 2, 3,4,5,6]);
        $colft = $cols->where('parent_id',0)->orderBy('sort','asc')->find([6,33,5,9]);
        //判断是否纯数字: 是 则是id
        if(stripos($query,'.')>0){
            $query = substr($query,0,stripos($query,'.'));
        }
        $key = preg_match('/^\d+$/',$query) ? 'id' : 'path';
        $column = $cols->where($key,$query)->with('parentId')->first();
        //顶级栏目
        $parent = $column->parentTopId($column->id);
        if(sizeOf($column->allContents) == 0 && $parent->id == 4){
            $contents = $column->childContents()->orderBy('sort','asc')->orderBy('updated_at','desc')->get();
        }else{
            $contents = $column->allContents()->orderBy('sort','asc')->orderBy('updated_at','desc')->get();
        }
        return view($column->template,compact('colhd','colft','column','contents','parent'));
    }

}
