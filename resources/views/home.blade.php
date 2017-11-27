@extends('layouts.default')
@section('banner')
<div class="banner layui-carousel">
    <div carousel-item>
        @foreach($banners as $banner)
        <div class="banner-item">
            <img src="{{ $banner->url }}" alt="{{ $banner->title }}">
        </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        miya.fn.responseWinSize(function(winData){
            var height = '550px';
            if(winData.innerWidth <= 640 && winData.innerWidth > 320){
                height = '207px';
            }else if( winData.innerWidth <= 320){
                height = '160px';
            }
            carousel.render({
                elem: '.banner'
                ,width: '100%' //设置容器宽度
                ,height: height
                ,indicator : 'none'
                ,arrow: 'always' //始终显示箭头
                //,anim: 'updown' //切换动画方式
            });
        });

    });
</script>
@stop
@section('content')
<div class="page-main home">
    <div class="welcome-wrap">
        <div class="wc-hd">欢迎来到米亚集团</div>
        <div class="wc-brand"><img src="{{ $company->pic }}" alt=""></div>
        <div class="wc-bd"><pre>{{ $company->intro }}</pre></div>
        <div class="wc-ft"><a href="{{ $colhd[0]->childColumns[0]->path }}" class="link-about">关于公司</a></div>
    </div>
</div>
<div class="page-news">
    @foreach($newests as $news)
    <a class="news-item" href="/{{ $news->column->path ? $news->column->path : $news->column->id }}/{{ $news->path ? $news->path : $news->id }}">
        @if($news->pic)
        <div class="news-img"><img src="{{ $news->pic }}" alt="{{ $news->title }}"></div>
        @endif
        <div class="news-info">
            <div class="news-title">{{ $news->title }}</div>
            <div class="news-time">{{ $news->updated_at }}</div>
            <div class="news-desc"><pre>{{ $news->intro }}</pre></div>
        </div>
    </a>
    @endforeach
</div>

@stop
