<?php

namespace App\Http\Controllers\Admin;

use App\Models\Column;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;

class ContentsController extends Controller
{
    //
    public function index(Request $request,Column $column,Content $content){
        if($request->colId){
            $content = Column::find($request->colId)->allContents;
            $column = $column->find($request->colId);
        }else{
            $content = $content->orderBy('sort','desc')->get();
        }
        $page = 'contents';
    	return view('admin.content.index',compact('column','content','page'));
    }
    public function create(Request $request,Column $column){
        $file = new Filesystem;
        $colId = $request->colId;
        $page = 'contents';

        $dirFiles = $file->files(base_path().'/resources/views');
        $tpls = array();
        foreach ($dirFiles as $fl){
            $match = array();
            preg_match('/([\w\-]+)\./',$fl,$match);
            $tpls[] = $match[1];
        }
        if($colId){
            $column = Column::select(['id','title'])->where('id',$colId)->first();
        }else{
            $column = $column->select(['id','title'])->orderBy('sort','desc')->get();
        }
        return view('admin.content.create',compact('column','colId','page','tpls'));
    }
    public function store(Request $request,Content $contents){
        $this->validate($request,[
            'title' => 'required|max:300',
            'path' => array('max:200','unique:contents'),
            'sort' => 'max:255',
            'columnId' => 'required',
            'template' => 'required'
        ]);
        $contents->title = $request->title;
        $contents->column_id = $request->columnId;
        $contents->sort = $request->sort ? $request->sort : 0;
        $contents->path = $request->path ? $request->path : '';
        $contents->pic = $request->pic ? $request->pic : '';
        $contents->recommend = $request->recommend ? 1 : 0;
        $contents->intro = $request->intro ? $request->intro : '';
        $contents->template = $request->template;

        $contents->desc = $request->desc ? $request->desc : '';
        $bool = $contents->save();

        if($bool){
            return redirect()->route('contents.index',['colId'=>$request->columnId]);
        }else{
            return redirect()->back()->with([
                'danger' => '很抱歉，添加文章失败'
            ]);
        }
    }
    public function edit(Content $content,Column $column){
        //文章所属类目
        $file = new Filesystem;
        $pcol = $content->column;
        $page = 'contents';
        $column = $column->all();
        $dirFiles = $file->files(base_path().'/resources/views');

        foreach ($dirFiles as $fl){
            $match = array();
            preg_match('/([\w\-]+)\./',$fl,$match);
            $tpls[] = $match[1];
        }
        return view('admin.content.edit',compact('content','pcol','column','page','tpls'));
    }
    public function update(Content $content,Request $request){
        $this->validate($request,[
            'title' => 'required|max:300',
            'path' => array('max:200','unique:contents'),
            'sort' => 'max:255',
            'columnId' => 'required',
            'template' => 'required'
        ]);
        //dd($request->desc);
        $content->update([
            'title' => $request->title,
            'column_id' => $request->columnId,
            'sort'  => $request->sort ? $request->sort : 0,
            'path'  => $request->path ? $request->path : '',
            'pic'   => $request->pic ? $request->pic : '',
            'recommend' => $request->recommend ? 1 : 0,
            'intro'=> $request->intro ? $request->intro : '',
            'template' => $request->template,
            'desc'=> $request->desc ? $request->desc : ''
        ]);
        session()->flash('success','更新成功');
        return redirect()->route('contents.index');
    }
    public function destroy(Request $request,Content $content){
        if($content->id){
            $content->delete();
        }
        return redirect()->route('contents.index');
    }
}
