@extends('layouts.admin')
@section('title', '文件管理')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">首页</a></li>
                <li class="active">编辑文件</li>
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
        <form class="col-lg-12" action="{{ route('files.update',$file->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group col-sm-12">
                <label for="title">文件名称</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $file->title }}" placeholder="名称">
            </div>
            <div class="form-groups">
                <div class="form-group col-sm-6">
                    <label for="columnId">所属栏目</label>
                    <select name="columnId" id="columnId" class="form-control">
                        <option value="0" {{ $file->column_id == 0 ? 'selected' : '' }}>请选择</option>
                        @foreach($columns as $col)
                            <option value="{{ $col->id }}"  {{ $file->column_id == $col->id ? 'selected' : '' }}>{{ $col->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="sort">排序</label>
                    <input type="text" class="form-control" value="{{ $file->sort }}" name="sort" id="sort">
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label for="application">文件用途</label>
                <div class="btn-group db" data-toggle="buttons">
                    <label class="btn btn-primary {{ $file->application == 2 ? "active" : "" }}">
                        <input type="radio" name="application" {{ $file->application == 2 ? "checked" : "" }} id="option1" value="2" autocomplete="off">banner
                    </label>
                    <label class="btn btn-primary {{ $file->application == 1 ? "active" : "" }}">
                        <input type="radio" name="application" {{ $file->application == 1 ? "checked" : "" }} id="option2" value="1" autocomplete="off">下载文件
                    </label>
                    <label class="btn btn-primary {{ $file->application == 0 ? "active" : "" }}">
                        <input type="radio" name="application" {{ $file->application == 0 ? "checked" : "" }} id="option3" value="0" autocomplete="off">其他
                    </label>
                </div>
            </div>
            <div class="form-groups">
                <div class="form-group col-sm-6">
                    <script type="text/javascript" src="/js/fileinput.js"></script>
                    <label for="title">文件</label>
                    @include('layouts._fileup',[ 'id' => 'url','src' => $file->url])
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </form>
    </div>
@stop
