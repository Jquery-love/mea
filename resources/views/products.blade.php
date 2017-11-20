@extends('layouts.default')
@section('title', '列表')
@section('banner')
    @if($column->bigPic)
        <div class="wp banner"><img src="{{ $column->bigPic }}" alt=""></div>
    @endif
@stop
@section('content')
<div class="page-bd">
    <div class="wp page-main cf">
        <div class="l slt-wrap">
            <div class="slt-hd">型号选择</div>
            <div class="slt-list">
                @foreach($contents as $con)
                <a class="slt-item" href="#{{ $con->id }}">{{ $con->title }}</a>
                @endforeach
            </div>
        </div>
        @foreach($contents as $con)
        <div class="r content" id="{{ $con->id }}" style="display:none;">
            {!! $con->desc !!}
        </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">
    var $sltList = $('.slt-list'),$sltItem = $sltList.find('.slt-item'),$contents = $('.content');
    var id = location.hash.substr(1) || ($sltItem.first().attr('href') && $sltItem.first().attr('href').substr(1));
    $contents.hide().filter("div[id="+ id +"]").show();
    $sltItem.filter("a[href='#"+ id +"']").addClass('now');

    $sltItem.on('click',function(){
        var $this = $(this),id = $this.attr('href').substr(1);
        $sltItem.removeClass('now');
        $this.addClass('now');
        $contents.hide().filter("div[id="+ id +"]").show();
    })

</script>

@stop