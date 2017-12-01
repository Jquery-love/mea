@extends('layouts.default')
@section('title', $key)
@section('content')
<div class="page-main page-search">
    <div class="search-hd">
        @if(is_null($key))
            请输入要搜索内容
        @else
            您当前正在搜索：<span>{{ $key }}</span>
        @endif
    </div>
    <div class="search-bd">1
        @if(strlen($key) > 0)
        @foreach($contents as $con)
            
            <div class="search-item">
                @if( $con->column->parent_id == 3 || ($con->column->parent_id == 0 && $con->column->id == 2 ))
                <a class="search-link" attr="{{ $con->column->id }}" href="/{{ $con->column->path ? $con->column->path : $con->column->id }}#{{ $con->id }}">
                    {{$con->title}}
                </a>
                @else
                <a class="search-link" attr="{{ $con->column->id }}" href="/{{ $con->column->path ? $con->column->path : $con->column->id }}/{{ $con->path ? $con->path : $con->id }}">
                    {{$con->title}}
                </a>
                @endif
            </div>
		@endforeach
        @endif
    </div>
</div>
@stop
