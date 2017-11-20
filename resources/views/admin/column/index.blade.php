@extends('layouts.admin')
@section('title', '栏目管理')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1>栏目列表</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}">首页</a></li>
            <li class="active">栏目管理</li>
        </ol>
    </div>
</div><!-- /.row -->
<div class="row page-hd">
    <div class="col-md-4 title"></div>
    <div class="col-md-4 col-md-offset-4">
        <a class="btn btn-default" href="{{ route('columns.create') }}" role="button">添加栏目</a>
    </div>
</div>
<div class="row page-bd">
    <div class="col-lg-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>栏目名称</th>
                    <th class="ta-c">排序</th>
                    <th class="ta-c">路径</th>
                    <th class="ta-r">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($columns as $col)
                <tr>
                    <td>
                        @if($col->allChildrenColumns->count() > 0)
                        <i class="glyphicon glyphicon-plus cl-open" data-id="{{ $col->id }}"></i>
                        @endif
                    </td>
                    <td><a href="{{ route('contents.index',['colId' => $col->id])}}">{{ $col->title }}</a></td>
                    <td class="ta-c">{{ $col->sort }}</td>
                    <td class="ta-c"> {{ $col->path }} </td>
                    <td class="ta-r">
                        <input class="btn btn-default btn-delete" data-target=".deleteModal" data-whatever="{{ $col->title }}" data-url="{{ route('columns.destroy',$col->id) }}" data-toggle="modal" type="button" value="删除">
                        <a class="btn btn-default" href="{{ route('columns.edit',$col->id) }}" value="">修改</a>
                        <a class="btn btn-default" href="{{ route('columns.create',['id'=>$col->id]) }}" value="">增加栏目</a>
                    </td>
                </tr>
                    @foreach($col->allChildrenColumns as $cldColumn)
                    <tr class="cld-item cld{{$col->id}}">
                        <td>
                            @if($cldColumn->allChildrenColumns->count() > 0)
                                <i class="glyphicon glyphicon-plus cl-open" data-id="{{ $cldColumn->id }}"></i>
                            @endif
                        </td>
                        <td><a href="{{ route('contents.index',['colId' => $cldColumn->id])}}">{{ $cldColumn->title }}</a></td>
                        <td class="ta-c">{{ $cldColumn->sort }}</td>
                        <td class="ta-c">{{ $cldColumn->path }}</td>
                        <td class="ta-r">
                            <input class="btn btn-default btn-delete" data-target=".deleteModal" data-whatever="{{ $cldColumn->title }}" data-url="{{ route('columns.destroy',$cldColumn->id) }}" data-toggle="modal" type="button" value="删除">
                            <a class="btn btn-default" href="{{ route('columns.edit',$cldColumn->id) }}" value="">修改</a>
                            <a class="btn btn-default" href="{{ route('columns.create',['id'=>$cldColumn->id]) }}" value="">增加栏目</a>
                        </td>
                    </tr>
                        @foreach($cldColumn->allChildrenColumns as $k => $cldClm)
                            <tr class="cld-item cld{{$cldColumn->id}}">
                                @if($k == 0)
                                <td rowspan="{{ $cldColumn->allChildrenColumns->count() }}"></td>
                                @endif
                                <td><a href="{{ route('contents.index',['colId' => $cldClm->id])}}">{{ $cldClm->title }}</a></td>
                                <td class="ta-c">{{ $cldClm->sort }}</td>
                                <td class="ta-c">{{ $cldClm->path }}</td>
                                <td class="ta-r">
                                    <input class="btn btn-default btn-delete" data-target=".deleteModal" data-whatever="{{ $cldClm->title }}" data-url="{{ route('columns.destroy',$cldClm->id) }}" data-toggle="modal" type="button" value="删除">
                                    <a class="btn btn-default" href="{{ route('columns.edit',$cldClm->id) }}" value="">修改</a>
                                    <a class="btn btn-default" href="{{ route('columns.create',['id'=>$cldClm->id]) }}" value="">增加栏目</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade deleteModal" tabindex="-1" aria-labelledby="modalTitle" aria-describedby="描述" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" aria-hidden="true">
        <form class="modal-content" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalTitle">删除 </h4>
            </div>
            <div class="modal-body">
                <p>确定要删除吗？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <input type="submit" class="btn btn-primary" value="删除"/>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $('.deleteModal').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);
        var recipient = button.data('whatever'),url = button.data('url');
        var modal = $(this);
        modal.find('.modal-title').text('删除栏目 '+ recipient);
        modal.find('.modal-content').attr('action',url);
    });
    $('.cl-open').on('click',function(){
        var $this = $(this),id=$this.data('id');
        $this.parents('tr').siblings('.cld'+id).toggle();
        if($this.hasClass('glyphicon-minus')){
            $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
        }else{
            $this.addClass('glyphicon-minus').removeClass('glyphicon-plus');
        }
    });

</script>
@stop
