<input id="{{ $id }}" notstore="{{ isset($notstore) ? $notstore : '0' }}" value="{{ isset($src) ? $src : '' }}" type="file" class="file">
<input type="hidden" name="{{ $id }}" value="{{ isset($src) ? $src : '' }}">
<script type="text/javascript">
	$('input[type="file"][id="{{ $id }}"]').fileinput({
	    uploadUrl: '/api/files', // you must set a valid URL here else you will get an error
	    allowedFileExtensions : ['jpg', 'png','gif','pdf'],
	    overwriteInitial: false,
        initialPreview : [$('input[type="file"][id="{{ $id }}"]').attr("value") && "<img src='" + $('input[type="file"][id="{{ $id }}"]').attr("value") + "' class='file-preview-image'/>"],
	    maxFileSize: 10000,
	    maxFilesNum: 10,
	    uploadExtraData : {
	    	'_token' : $("input[name='_token']").val(),
            'notstore': Number($('input[type="file"][id="{{ $id }}"]').attr("notstore"))
	    }
	    //allowedFileTypes: ['image', 'video', 'flash'],
	}).on("fileuploaded",function(event,data,previewId,index){
        var $input = $(event.target),id = $input.attr('id');
        if(!data.error && data.response.code == 200){
            $('input[name="'+id+'"]').val(data.response.url);
        }
    });
</script>
