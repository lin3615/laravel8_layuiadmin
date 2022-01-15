<style>
    #layui-upload-box li{
        width: 120px;
        height: 100px;
        float: left;
        position: relative;
        overflow: hidden;
        margin-right: 10px;
        border:1px solid #ddd;
    }
    #layui-upload-box li img{
        width: 100%;
    }
    #layui-upload-box li p{
        width: 100%;
        height: 22px;
        font-size: 12px;
        position: absolute;
        left: 0;
        bottom: 0;
        line-height: 22px;
        text-align: center;
        color: #fff;
        background-color: #333;
        opacity: 0.6;
    }
    #layui-upload-box li i{
        display: block;
        width: 20px;
        height:20px;
        position: absolute;
        text-align: center;
        top: 2px;
        right:2px;
        z-index:999;
        cursor: pointer;
    }
</style>

<script>
    layui.use('upload', function(){
        var upload = layui.upload;

        //执行实例
        var uploadInst = upload.render({
            elem: '#uploadPic' //绑定元素
            ,url: '{{ route("uploadImg") }}' //上传接口
            ,multiple: false
            ,data: {"_token":"{{ csrf_token() }}"}
            ,field: 'upfile'
            ,size: 1000
            ,before: function(obj) {
                obj.preview(function (index,file,result) {
                    $('#layui-upload-box').html('<li><img src="'+result+'" /><p>上传中</p></li>')
                })
            }
            ,done: function(res){
                //上传完毕回调
                if(res.state == "SUCCESS") {
                    $("#thumb").val(res.sing_url);
                    $('#layui-upload-box li p').text('上传成功');
                    return layer.msg(res.msg);
                }else{
                    return layer.msg(res.msg);
                }
            }
            ,error: function(res){
                //请求异常回调
                $('#layui-upload-box li p').text('上传失败');
                return layer.msg(res.msg);
            }
        });
    });
</script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>
