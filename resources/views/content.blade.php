@extends('layouts.default')
@section('content')
    <ol class="breadcrumb wp">
        <li><a href="/">首页</a></li> /
        <li><a href="/{{ $column->path ? $column->path : $column->id }}">{{ $column->title }}</a></li>
    </ol>
    <div class="page-main wp">
        <div class="title">
            <h1>{{ $content->title }}</h1>
            <div class="extra"><span class="time">{{ $content->created_at }}</span></div>
        </div>
        <div class="content">{!! $content->desc !!}</div>
    </div>
    <script type="text/javascript">

    </script>
@stop
