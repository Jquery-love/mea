@extends('layouts.default')
@section('title', $key)
@section('content')
<div class="page-main page-search">
    <div class="search-hd">
        您当前正在搜索：<span>{{ $key }}</span>
    </div>
    <div class="search-bd">
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
    </div>
</div>
@stop
