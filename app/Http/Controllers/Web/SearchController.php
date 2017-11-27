<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Content;

class SearchController extends Controller
{
    //
    public function index(Request $request){
        $cols = new Column;
        $cons = new Content;
        $key = $request->s;
        //dd($colId);
        $colhd = $cols->where('parent_id',0)->orderBy('sort','asc')->find([1, 2, 3,4,5,6]);
        $colft = $cols->where('parent_id',0)->orderBy('sort','asc')->find([6,33,5,9]);

        //$colKey = preg_match('/^\d+$/',$colId) ? 'id' : 'path';

        $contents = $cons->where('title','like','%'.$key.'%')->get();

        //$column = $cols->where($colKey,$colId)->with('parentId')->first();

        //$parent = $column->parentTopId($column->id);

        return view('search',compact('colhd','colft','key','contents'));

    }
}
