<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Files;
use Storage;

class FilesController extends Controller
{
    //
    public function store(Request $request){
    	if($request->isMethod('post')){

    		$files = $request->file();
            $file = false;
            if(count($files) > 0){
                $file = current($files);
            }
    		if( $file && $file->isValid() ){
    			//文件原名
    			$originalName = $file->getClientOriginalName();
    			//扩展名
    			$ext 	= $file->getClientOriginalExtension();
    			//临时文件的绝对路径
    			$realPath = $file->getRealPath();
    			//文件类型
    			$type = $file->getClientMimeType();
                if(strtok($type,'/') == 'image'){
                    $dir = 'pic';
                }else if($type=='application/pdf'){
                    $dir = 'file';
                }
    			$filename = $dir . '/' . time() . '-' . uniqid() . '.' . $ext;
    			// 使用我们新建的uploads本地存储空间（目录）
                $bool = Storage::disk('public')->put($filename, file_get_contents($realPath));
//                $bool = false;
                if($bool && !$request->notstore){ //nstore  不存储
                    $file = new Files;
                    $file->operator = $request->user()->id;
                    $file->column_id = $request->columnId ? $request->columnId : NAN;
                    $file->sort = $request->sort ? $request->sort : 0;
                    $file->application = $request->application ? $request->application : 0;
                    $file->title = $request->title ? $request->title : $originalName;
                    $file->url = Storage::url($filename);
                    $sbool = $file->save(); //保存
                    return ['msg'=> '上传成功', 'url' => $file->url,'code'=> 200];
                }else if($bool){
                    return ['msg'=> '上传成功', 'url' => Storage::url($filename),'code'=> 200];
                }else{
                    return ['error'=> '文件存储失败', 'url' => '','code'=> 400];
                }
    		}else{
                return ['error'=> '上传失败', 'url' => '','code'=> 400];
            }
    	}
    }
}
