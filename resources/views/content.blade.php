@extends('layouts.default')
@section('banner')
    @if($column->bigPic)
        <div class="banner"><img src="{{ $column->bigPic }}" alt=""></div>
    @endif
@stop
@section('intro')
<ol class="breadcrumb wp">
    <li><a href="/">首页</a></li> /
    <li><a href="/{{ $column->path ? $column->path : $column->id }}">{{ $column->title }}</a></li>
</ol>
@stop
@section('content')
<div class="page-main z-main">
    <div class="title">
        <h1>{{ $content->title }}</h1>
        <div class="extra"><span class="time">{{ $content->created_at }}</span></div>
    </div>
    <div class="content">{!! $content->desc !!}</div>
</div>
<div class="page-aside z-aside-l">
    <div class="aside-hd">{{ $column->title }} </div>
</div>
@stop
