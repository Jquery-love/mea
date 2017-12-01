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
    <div class="search-bd">
        
    </div>
</div>
@stop
