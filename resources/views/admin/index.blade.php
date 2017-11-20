@extends('layouts.admin')
@section('title', '后台管理')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1>后台管理</h1>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <h4>栏目列表</h4>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>栏目名称</th>
                <th class="ta-c">排序</th>
                <th class="ta-c">路径</th>
            </tr>
            </thead>
            <tbody>
                @foreach($column as $col)
                    <tr>
                        <td><a href="{{ route('contents.index',['colId' => $col->id])}}">{{ $col->title }}</a></td>
                        <td class="ta-c">{{ $col->sort }}</td>
                        <td class="ta-c"> {{ $col->path }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <h4>用户列表</h4>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>用户名称</th>
                <th class="ta-c">身份</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td class="ta-c">{{ $u->identity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <h4>内容列表</h4>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>名称</th>
                <th class="ta-c">排序</th>
                <th class="ta-c">路径</th>
                <th class="ta-c">推荐</th>
            </tr>
            </thead>
            <tbody>
            @foreach($content as $c)
                <tr>
                    <td>{{ $c->title }}</td>
                    <td class="ta-c">{{ $c->sort }}</td>
                    <td class="ta-c"> {{ $c->path }} </td>
                    <td class="ta-c"> {{ $c->recommend }} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
