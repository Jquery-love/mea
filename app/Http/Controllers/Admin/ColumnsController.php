<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Column;
use Illuminate\Filesystem\Filesystem;

class ColumnsController extends Controller
{
    public function index(Column $columns){
        $columns = $columns->where('parent_id',0)->orderBy('sort','desc')->get();

    	return view('admin.column.index',['columns'=>$columns,'page'=>'columns']);
    }
    public function create(Request $request){
        $file = new Filesystem;
        if($request->id){
            $column = Column::where('id',$request->id)->first();
        }else{
            $column = false;
        }
        $page = 'columns';
        $columns = Column::select(['id','title'])->orderBy('sort','desc')->get();
        $dirFiles = $file->files(base_path().'/resources/views');
        $tpls = array();

        foreach ($dirFiles as $fl){
            $match = array();
            preg_match('/([\w\-]+)\./',$fl,$match);
            $tpls[] = $match[1];
        }

    	return view('admin.column.create',compact('columns','column','page','tpls'));
    }
    public function store(Request $request){
        $messages = [
            'title.required' => '栏目名称 不能为空.'
        ];
        var_dump($request->path);
        $this->validate($request,[
    		'title' => 'required|max:300',
            'path' => array('max:200','unique:columns'),
            'sort' => 'max:255',
            'template' => 'required'
    	],$messages);
        $column = new Column;
        $column->title = $request->title;
        $column->parent_id = $request->parentId ? $request->parentId : 0;
        $column->sort = $request->sort ? $request->sort : 0;
        $column->path = $request->path ? $request->path : '';
        $column->pic = $request->pic ? $request->pic : '';
        $column->bigPic = $request->bigPic ? $request->bigPic : '';
        $column->intro = $request->intro ? $request->intro : '';
        $column->template = $request->template;
        $column->contents = $request->contents ? $request->contents : '';

        $bool = $column->save();
        if($bool){
            return redirect()->route('columns.index');
        }else{
            return redirect()->back()->with([
    			'danger' => '很抱歉，添加栏目失败'
    		]);
        }
    }
    public function edit(Column $column){
        $page = 'columns';
        $tpls = array();
        $file = new Filesystem;
        $dirFiles = $file->files(base_path().'/resources/views');

        foreach ($dirFiles as $fl){
            $match = array();
            preg_match('/([\w\-]+)\./',$fl,$match);
            $tpls[] = $match[1];
        }
        $columns = $column->select(['id','title'])->orderBy('sort','desc')->get();
        //var_dump($columns);
        return view('admin.column.edit',compact('column','columns','page','tpls'));
    }
    public function update(Column $column,Request $request){
        $messages = [
            'title.required' => '栏目名称 不能为空.'
        ];
        $this->validate($request,[
    		'title' => 'required|max:300',
            'path' => array('max:200'),
            'sort' => 'max:255',
            'template' => 'required'
    	],$messages);
        $column->update([
            'title' => $request->title,
            'parent_id' => $request->parentId ? $request->parentId : 0,
            'sort'  => $request->sort ? $request->sort : 0,
            'path'  => $request->path ? $request->path : '',
            'pic'   => $request->pic ? $request->pic : '',
            'bigPic'=> $request->bigPic ? $request->bigPic : '',
            'intro'=> $request->intro ? $request->intro : '',
            'template' => $request->template,
            'contents'=> $request->contents ? $request->contents : ''
        ]);
        session()->flash('success','栏目更新成功');
        return redirect()->route('columns.index');
    }
    public function destroy(Column $column){
        if($column->id){
            $column->delete();
        }
        return redirect()->route('columns.index');
    }
}
