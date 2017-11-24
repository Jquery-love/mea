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
            var height = '530px';
            if(winData.innerWidth < 640){
                height = '150px';
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
<div class="page-attention">
    <h3>{{ $exhibitionContent->title }}</h3>
    <p>{{ $exhibitionContent->intro }}</p>
</div>
@stop
