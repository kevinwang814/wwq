<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 培训管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">培训标题：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" id="title" placeholder="培训标题" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">培训描述：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" id="description" style="height: 200px;overflow-y: scroll" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">培训内容：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" id="content" style="height: 200px;overflow-y: scroll" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">培训图片：</label>
                        <div class="col-md-10 col-xs-10 img_add text-left">
                            <!-- 上传图片【start】-->
                            <div class="rewri_file">
                                <input id="trainingImage" name="trainingImage" type="file" />
                                <span></span>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-xs-offset-2 col-md-4 col-xs-4">
                        <button id="submit" class="btn btn-primary">确 认 添 加</button>
                    </div>
                </div>
            </form>
        </section>
        <!-- 培训管理内容【结束】-->
    </div>
    <!-- ./main-content end.-->

</section>
<!-- 右边内容【end】-->
<script>
    $(function () {
        $('.menu:eq(3) .second-nav').show();
        $('.menu:eq(3) .menu-content').addClass('active');
        $('.menu:eq(3) .menu-content span').addClass('cur');
        $('.menu:eq(3) .second-nav li:eq(1)').addClass('active');
    });
</script>
<script>
    var fileType = new Array('image/png','image/jpeg','image/gif','image/bmp');
    $(document).on("change",'#trainingImage',function(){
        var file = $(this).get(0).files[0];
        var type = file['type'];
        var fileElementId = $(this).attr('id');
        if($.inArray(type,fileType) != -1){
            $.ajaxFileUpload({
                url:'handler.html',
                secureuri:false,
                fileElementId:fileElementId,
                dataType:'json',
                success:function(data,status){
//                    alert(JSON.stringify(data));
//                        alert(JSON.stringify(data.src));
                    $('.img_add').append('<div class="img_dat"><span></span><img src="' + data.src + '" alt=" "></div>');
                }
            });
        }
    
    });
     //点击图片删除事件
        $(document).on('click','.img_dat',function() {
            if(confirm('是否要删除吗？')) {
                 $(this).remove();
            }
        });

    $(document).on('click','#submit',function(){
            var title = $.trim($('#title').val());
            var description = $.trim($('#description').val());
            var content = $.trim($('#content').val());
            var img = $('.img_add .img_dat img');
            var imgStr = '';
            for(var i=0; i< img.length;i++){
                imgStr += img.eq(i).attr('src')+",";
            }
            if(title != '' && description != '' && content != '' && imgStr != ''){
                $.ajax({
                    url:'handler.html',
                    type:'POST',
                    dataType:'json',
                    data:{
                        title:title,
                        description:description,
                        content:content,
                        imgStr:imgStr,
                        requestType:'createTraining'
                    },
                    success:function(data){
                        if(data.message == 'success'){
                            alert("操作成功!");
                            window.location.href = '/training/list.html';
                        }
                    },
                    error:function(data){
                        alert(JSON.stringify(data));
                    }
                });
            }else {
                alert("输入信息有误，请重新填写");
            }
        });
</script>
<?php $this->_endblock();