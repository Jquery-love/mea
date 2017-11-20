@extends('layouts.admin')
@section('title', '栏目管理')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>修改用户</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">首页</a></li>
                <li class="active">用户管理</li>
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
        <form class="col-lg-12" action="{{ route('users.update',$user->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-groups">
                <div class="form-group col-sm-12">
                    <label for="name">用户名</label>
                    <input type="text" class="form-control" name="name" placeholder="用户名" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-groups">
                <div class="form-group col-sm-12">
                    <label for="email">邮箱</label>
                    <input type="text" class="form-control" name="email" placeholder="邮箱" value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-groups">
                <div class="form-group col-sm-12">
                    <label for="password">请重设密码</label>
                    <input type="password" class="form-control" name="password" placeholder="密码" value="{{ $user->password }}">
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </form>
    </div>
@stop
