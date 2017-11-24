@extends('layouts.default')
@section('title', $column->title)
@section('content')
<div class="page-main z-main">
    <div class="news-list">
		@foreach($contents as $con)
    	<a class="news-item" href="/{{ $column->path ? $column->path : $column->id }}/{{ $con->path ? $con->path : $con->id }}">
			@if($con->pic)
    		<div class="news-img"><img src="{{ $con->pic }}" alt="{{ $con->title }}"></div>
			@endif
    		<div class="news-info">
    			<div class="news-title">{{ $con->title }}</div>
    			<div class="news-time">{{ $con->updated_at }}</div>
    			<div class="news-desc"><pre>{{ $con->intro }}</pre></div>
    		</div>
    	</a>
		@endforeach
    </div>
</div>
<div class="page-aside z-aside-l">
    <div class="aside-hd">{{ $column->title }} </div>
</div>
@stop
