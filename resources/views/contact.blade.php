@extends('layouts.default')
@section('title', $column->title)
@section('banner')
    @if($column->bigPic)
        <div class="banner"><img src="{{ $column->bigPic }}" alt=""></div>
    @endif
@stop
@section('content')
<div class="page-main z-main">
    <div class="page-content">
        {!! $column->contents !!}
    </div>
</div>
<div class="page-aside z-aside-l">
    <div class="aside-hd">{{ $column->title }} </div>
</div>
@stop
