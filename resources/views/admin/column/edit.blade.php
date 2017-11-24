@extends('layouts.admin')
@section('title', '栏目修改-栏目管理')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 >修改栏目</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('admin') }}">首页</a></li>
			<li class="active">栏目管理</li>
		</ol>
	</div>
</div>
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
	<form class="col-lg-12" action="{{ route('columns.update',$column->id) }}" method="post">
		{{ csrf_field() }}
        {{ method_field('PATCH') }}
		<div class="form-groups">
			<div class="form-group col-sm-6">
				<label for="title">栏目名称</label>
				<input type="text" class="form-control" name="title" id="title" placeholder="名称" value="{{ $column->title }}">
			</div>
			<div class="form-group col-sm-6">
				<label for="path">路径</label>
				<input type="text" class="form-control" name="path" id="path" placeholder="路径" value="{{ $column->path }}">
			</div>
		</div>
		<div class="form-groups">
			<div class="form-group col-sm-6">
				<label for="title">父栏目</label>
				<select name="parentId" class="form-control" readonly="readonly">
					<option value="0">请选择</option>
                    @foreach($columns as $col)
                    <option value="{{ $col->id }}" {{ $col->id == $column->parent_id ? 'selected' : '' }}>{{ $col->title }}</option>
                    @endforeach
				</select>
			</div>
			<div class="form-group col-sm-6">
				<label for="sort">排序</label>
				<input type="text" class="form-control" name="sort" id="path" placeholder="排序" value="{{ $column->sort }}">
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label for="template">选择模板</label>
			<select name="template" id="template" class="form-control">
				<option value="">请选择</option>
				@foreach($tpls as $tpl)
					<option value="{{ $tpl }}" {{ $column->template == $tpl ? 'selected' : '' }}>{{ $tpl }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-groups">
			<script type="text/javascript" src="/js/fileinput.js"></script>
			<div class="form-group col-sm-6">
				<label for="title">小图</label>
				@include('layouts._fileup',[ 'id' => 'pic','src'=>$column->pic])
			</div>
			<div class="form-group col-sm-6">
				<label for="path">大图</label>
				@include('layouts._fileup',[ 'id' => 'bigPic','src'=>$column->bigPic ])
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label for="contents">介绍</label>
			<textarea class="form-control" style="min-height:250px;" name="intro" id="intro">{{ $column->intro }}</textarea>
		</div>
		<div class="form-group col-sm-12">
			<label for="contents">内容</label>
			@include('layouts._content',['content' => $column->contents])
		</div>
        <div class="col-sm-12">
            <button type="button" onClick="formSubmit()" class="btn btn-default">提交</button>
        </div>
	</form>
</div>
@stop
