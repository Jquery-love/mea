@extends('layouts.default')
@section('intro')
<div class="case-intro wp">
    <div class="case-hd">MEA的客户组成</div>
    <div class="case-bd">
        {!! $parent->contents !!}
    </div>
</div>
@stop
@section('content')
<div class="page-main z-main">
    <div class="case-list">
        @foreach($contents as $con)
        <a class="case-item" href="/{{ $column->path ? $column->path : $column->id }}/{{ $con->path ? $con->path : $con->id }}">
            <div class="item-hd"><img src="{{ $con->pic }}" alt=""></div>
            <div class="item-bd">{{ $con->title }}</div>
            <div class="item-desc">{!! $con->desc !!}</div>
        </a>
        @endforeach
    </div>
</div>
<div class="page-aside z-aside-l">
    <div class="slt-wrap">
        <div class="slt-hd">案列选择</div>
        <div class="slt-list">
            @foreach($parent->childColumns()->orderBy('sort','asc')->get() as $col)
                <div class="slt-item {{ $col->id == $column->id ? 'active' : '' }} {{ ($column->parentId && $column->parentId->id == $col->id) ? 'active' : '' }}">
                    <a class="slt-text " href="{{ $col->path ? $col->path : $col->id }}"><i class="icon"></i> {{ $col->title }}</a>
                    @if($col->childColumns->count() > 0)
                    <div class="slt-list">
                        @foreach($col->childColumns()->orderBy('sort','asc')->get() as $cld)
                        <a class="slt-item {{ $column->id == $cld->id ? 'active' : '' }}" href="{{ $cld->path ? $cld->path : $cld->id }}"><i class="icon"></i> {{ $cld->title }}</a>
                        @endforeach
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">

</script>
@stop
