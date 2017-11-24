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
    <div class="slt-wrap">
        <div class="slt-hd">案列选择</div>
        <div class="slt-list">
            @foreach($parent->childColumns as $col)
                <div class="slt-item {{ $col->id == $column->id ? 'active' : '' }} {{ ($column->parentId && $column->parentId->id == $col->id) ? 'active' : '' }}">
                    <a class="slt-text " href="/{{ $col->path ? $col->path : $col->id }}"><i class="icon"></i> {{ $col->title }}</a>
                    @if($col->childColumns->count() > 0)
                    <div class="slt-list">
                        @foreach($col->childColumns as $cld)
                        <a class="slt-item {{ $column->id == $cld->id ? 'active' : '' }}" href="{{ $cld->path ? $cld->path : $cld->id }}"><i class="icon"></i> {{ $cld->title }}</a>
                        @endforeach
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop
