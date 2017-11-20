@extends('layouts.admin')
@section('title', '用户管理')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1>用户管理</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}">首页</a></li>
            <li class="active">用户管理</li>
        </ol>
    </div>
</div><!-- /.row -->
<div class="row page-hd">
    <div class="col-md-4 title"></div>
    <div class="col-md-4 col-md-offset-4">
        <a class="btn btn-default" href="{{ route('users.create') }}" role="button">添加用户</a>
    </div>
</div>
<div class="row page-bd">
    <div class="col-lg-12">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>用户名称</th>
                <th class="ta-c">身份</th>
                <th class="ta-r">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="ta-c">{{ $user->name }}</td>
                    <td class="ta-c"> {{ $user->identity }} </td>
                    <td class="ta-r">
                        <input class="btn btn-default btn-delete" data-target=".deleteModal" data-whatever="{{ $user->name }}" data-url="{{ route('users.destroy',$user->id) }}" data-toggle="modal" type="button" value="删除">
                        <a class="btn btn-default" href="{{ route('users.edit',$user->id) }}" value="">修改</a>
                    </td>
                </tr>
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
        modal.find('.modal-title').text('删除用户 '+ recipient);
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
