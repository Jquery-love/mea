@extends('layouts.admin')
@section('title', '栏目管理')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1>添加栏目</h1>
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
	<form class="col-lg-12" action="{{ route('columns.store') }}" method="post">
		{{ csrf_field() }}
		<div class="form-groups">
			<div class="form-group col-sm-6">
				<label for="title">栏目名称</label>
				<input type="text" class="form-control" name="title" placeholder="名称">
			</div>
			<div class="form-group col-sm-6">
				<label for="path">路径</label>
				<input type="text" class="form-control" name="path" placeholder="路径">
			</div>
		</div>
		<div class="form-groups">
			<div class="form-group col-sm-6">
				<label for="title">父栏目</label>
				<select name="parentId" class="form-control">
					<option value="0">请选择</option>
                    @foreach($columns as $col)
                    <option value="{{ $col->id }}" {{ ($column && $col->id == $column->id) ? 'selected' : '' }}>{{ $col->title }}</option>
                    @endforeach
				</select>
			</div>
			<div class="form-group col-sm-6">
				<label for="sort">排序</label>
				<input type="text" class="form-control" name="sort" placeholder="排序">
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label for="template">选择模板</label>
			<select name="template" id="template" class="form-control">
				<option value="">请选择</option>
				@foreach($tpls as $tpl)
				<option value="{{ $tpl }}">{{ $tpl }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-groups">
			<script type="text/javascript" src="/js/fileinput.js"></script>
			<div class="form-group col-sm-6">
				<label for="title">小图</label>
				@include('layouts._fileup',[ 'id' => 'pic', 'config' => 1 ])
			</div>
			<div class="form-group col-sm-6">
				<label for="path">大图</label>
				@include('layouts._fileup',[ 'id' => 'bigpic', 'config' => 1 ])
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label for="contents">介绍</label>
			<textarea class="form-control" style="min-height:250px;" name="intro" id="intro"></textarea>
		</div>
		<div class="form-group col-sm-12">
			<label for="contents">内容</label>
			@include('layouts._content')
		</div>
        <div class="col-sm-12">
            <button type="button" onClick="formSubmit()" class="btn btn-default">提交</button>
        </div>
	</form>
</div>
@stop
