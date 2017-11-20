<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Models\Column;
use Storage;

class FilesController extends Controller
{
    //
    public function index(Files $files){
        $page = 'files';
        $files = $files->orderBy('created_at','desc')->get();
    	return view('admin.file.index',compact('page','files'));
    }
    public function show($file){
        $contents = Storage::disk('public')->get($file);
        $ext = substr(strrchr($file, '.'), 1);
        if($ext == 'png' || $ext == 'jpg' || $ext == 'gif'){
            return response($contents, 200, [
                'Content-Type' => 'image/'.$ext,
            ]);
        }else if($ext == 'pdf'){
            return response($contents, 200, [
                'Content-Type' => 'application/'.$ext,
            ]);
        }
//        return response($contents, 200, [
//            'Content-Type' => 'image/png',
//        ]);
    }
    public function create(Column $column){
        $page = 'files';
        $columns = $column->select(['id','title'])->orderBy('sort','desc')->get();
        return view('admin.file.create',compact('columns','page'));
    }
    public function destroy(Files $file){
        $path = str_replace('/storage/','',$file->url);
        $exist = Storage::disk('public')->exists($path);

        if($file->id){
            $file->delete();
        }
        if($exist){
            Storage::delete($path);
        }
        return redirect()->route('files.index');
    }
    public function store(Request $request,Files $file){
        $this->validate($request,[
            'title' => 'required|max:300',
            'columnId' => 'required',
            'file' => 'required'
        ]);

        $file->operator = $request->user()->id;
        $file->column_id = $request->columnId ? $request->columnId : NAN;
        $file->sort = $request->sort ? $request->sort : 0;
        $file->title = $request->title;
        $file->url = $request->file;
        $bool = $file->save(); //保存

        if($bool){
            return redirect()->route('files.index');
        }else{
            return redirect()->back()->with([
                'danger' => '很抱歉，添加文件失败'
            ]);
        }

    }
}
