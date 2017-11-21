@extends('layouts.default')
@section('content')
<div class="page-bd">
    <div class="wp case-intro">
        <div class="case-hd">MEA的客户组成</div>
        <div class="case-bd">
            {!! $parent->contents !!}
        </div>
    </div>
    <div class="wp page-main cf">
        <div class="l slt-wrap">
            <div class="slt-hd">案列选择</div>
            <div class="slt-list">
                @foreach($parent->childColumns as $col)
                    @if($col->childColumns->count() > 0)
                    <div class="slt-item {{ ($column->parentId && $column->parentId->id == $col->id) ? 'active' : '' }}">{{ $col->title }}
                        <div class="slt-list">
                            @foreach($col->childColumns as $cld)
                            <a class="slt-item {{ $column->id == $cld->id ? 'active' : '' }}" href="{{ $cld->path ? $cld->path : $cld->id }}"><i class="icon"></i> {{ $cld->title }}</a>
                            @endforeach
                        </div>
                    </div>
                    @else
                        <a class="slt-item {{ $col->id == $column->id ? 'active' : '' }}" href="{{ $col->path ? $col->path : $col->id }}"><i class="icon"></i> {{ $col->title }}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="r case-list">
            @foreach($contents as $con)
            <div class="case-item">
                <div class="item-hd"><img src="{{ $con->pic }}" alt=""></div>
                <div class="item-bd">{{ $con->title }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
@stop
