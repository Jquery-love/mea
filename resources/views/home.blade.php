@extends('layouts.default')
@section('banner')
<div class="banner"><img src="/img/branner.jpg" alt=""></div>
@stop
@section('content')
<div class="wp page-main">
    <div class="welcome-wrap">
        <div class="wc-hd">欢迎来到米亚集团</div>
        <div class="wc-bd"><pre>{{ $about->intro }}</pre></div>
        <div class="wc-ft"><a href="{{ $colhd[0]->path }}" class="link-about">关于公司</a></div>
        <div class="wc-brand"><img src="{{ $about->pic }}" alt=""></div>
    </div>
</div>
<div class="page-attention">
    <h3>{{ $exhibitionContent->title }}</h3>
    <p>{{ $exhibitionContent->intro }}</p>
</div>
@stop