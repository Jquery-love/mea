@extends('layouts.admin')
@section('title', '栏目管理')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">首页</a></li>
                <li class="active">编辑内容</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('danger'))
                <div class="alert alert-danger">
                    {{ Session::get('danger') }}
                </div>
            @elseif(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <form class="col-lg-12" action="{{ route('contents.update',$content->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-groups">
                <div class="form-group col-sm-4">
                    <label for="title">标题</label>
                    <input type="text" class="form-control" value="{{ $content->title }}" name="title" id="title" placeholder="名称">
                </div>
                <div class="form-group col-sm-4">
                    <label for="path">路径</label>
                    <input type="text" class="form-control" value="{{ $content->path }}" name="path" id="path" placeholder="路径">
                </div>
                <div class="form-group col-sm-4">
                    <label for="template">选择模板</label>
                    <select name="template" id="template" class="form-control">
                        <option value="">请选择</option>
                        @foreach($tpls as $tpl)
                            <option value="{{ $tpl }}" {{ $tpl == $content->template ? 'selected' : '' }}>{{ $tpl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-groups">
                <div class="form-group col-sm-3">
                    <label for="columnId">父栏目</label>
                    <select name="columnId" id="columnId" class="form-control">
                        <option value="0">请选择</option>
                        @foreach($column as $col)
                            <option value="{{ $col->id }}" {{ $col->id == $pcol->id ? 'selected' : '' }}>{{ $col->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="sort">排序</label>
                    <input type="text" class="form-control" name="sort" id="sort" value="{{ $content->sort }}">
                </div>
                <div class="form-group col-sm-3">
                    <label for="recommend">推荐</label>
                    <input type="checkbox" {{ $content->recommend ? 'checked' : '' }} class="form-control" name="recommend" id="recommend" placeholder="排序">
                </div>
                <div class="form-group col-sm-3">
                    <label for="columnId">日期</label>
                    <input size="16" type="text" name="created_at" value="" readonly class="layui-input form-control">
                </div>
            </div>
            <div class="form-groups">
                <div class="form-group col-sm-6">
                    <script type="text/javascript" src="/js/fileinput.js"></script>
                    <label for="title">小图</label>
                    @include('layouts._fileup',[ 'id' => 'pic', 'src' => $content->pic ])
                </div>
                <div class="form-group col-sm-6">
                    <label for="intro">简介</label>
                    <textarea class="form-control" style="min-height:250px;" name="intro" id="intro">{{ $content->intro }}</textarea>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label for="contents">内容</label>
                @include('layouts._content',['name'=>'desc','content'=>$content->desc])
            </div>
            <div class="col-sm-12">
                <button type="button" onClick="formSubmit()" class="btn btn-default">提交</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/layer/layui.js"></script>
    <script type="text/javascript">
        layui.use('laydate', function(){
            layui.laydate.render({
                elem: '.layui-input'
                //,format: 'yyyy年MM月dd日'
                //,value: new Date(1989,9,14)
                ,format: 'yyyy-MM-dd HH:mm:ss'
                ,value: '{{ $content->created_at }}'
                //,max: 0
                //,min: '2016-10-14'
                //,max: -1
                //,value: '1989年10月14日'
                ,ready: function(date){
                  console.log(date);
                }
                ,done: function(value, date, endDate){
                  console.log(value, date, endDate);
                }
            });
        });
    </script>
@stop
