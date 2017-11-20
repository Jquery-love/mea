@extends('layouts.default')
@section('title', $column->title)
@section('banner')
    @if($column->bigPic)
        <div class="banner"><img src="{{ $column->bigPic }}" alt=""></div>
    @endif
@stop
@section('content')
<div class="page-bd">
    <div class="wp page-main">
        <div class="page-title">{{ $column->title }}</div>
        <div class="page-content">{!! $column->contents !!}</div>
    </div>
</div>
@stop
