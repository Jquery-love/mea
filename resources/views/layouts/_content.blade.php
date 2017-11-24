<!-- 样式文件 -->
<!-- <link rel="stylesheet" href="/js/ueditor/themes/default/css/umeditor.css"> -->
<!-- 引入 etpl -->
<!-- <script type="text/javascript" src="/js/ueditor/third-party/template.min.js"></script> -->
<!-- 配置文件 -->
<script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/js/ueditor/ueditor.all.js"></script>
<!-- 语言包文件 -->
<script type="text/javascript" src="/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<!-- 实例化编辑器代码 -->
<script type="text/javascript">
    $(function(){
        window.ue = UE.getEditor('container');
        window.formSubmit = function(){
            $("input.inputContent").val(ue.getContent());
            document.forms[0].submit();
        }
    });
</script>
<!-- 加载编辑器的容器 -->
<input type="hidden" name="{{ isset($name) ? $name : 'contents' }}" class="inputContent" value="">
<script id="container" type="text/plain" style="width:880px;height:300px;">
    @if(isset($content) or !empty($content))
    {!! $content !!}
    @endif
</script>
