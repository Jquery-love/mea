@extends('layouts.default')
@section('title', '列表')
@section('banner')
    @if($column->bigPic)
        <div class="wp banner"><img src="{{ $column->bigPic }}" alt=""></div>
    @endif
@stop
@section('content')
<div class="page-main z-main">
    @foreach($contents as $con)
    <div class="content" id="{{ $con->id }}" style="display:none;">
        {!! $con->desc !!}
    </div>
    @endforeach
</div>
<div class="page-aside z-aside-l">
    <div class="aside-hd">{{ $column->title }} </div>
    <div class="slt-wrap">
        <div class="slt-hd">型号选择</div>
        <div class="slt-list">
            @foreach($contents as $con)
            <a class="slt-item" href="#{{ $con->id }}"><i class="icon"></i>  {{ $con->title }}</a>
            @endforeach
        </div>
    </div>
</div>
<script type="text/javascript">
    var $sltList = $('.slt-list'),$sltItem = $sltList.find('.slt-item'),$contents = $('.content');
    var id = location.hash.substr(1) || ($sltItem.first().attr('href') && $sltItem.first().attr('href').substr(1));
    $contents.hide().filter("div[id="+ id +"]").show();
    $sltItem.filter("a[href='#"+ id +"']").addClass('active');

    $sltItem.on('click touchstart',function(){
        var $this = $(this),id = $this.attr('href').substr(1);
        $sltItem.removeClass('active');
        $this.addClass('active');
        $contents.hide().filter("div[id="+ id +"]").show();
        miya.fn.scrollToElement(".page-main",30,-70);
    })
</script>

@stop
