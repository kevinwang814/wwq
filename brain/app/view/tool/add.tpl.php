<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">工具名称：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" placeholder="工具名称" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">工具描述：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">工具图片：</label>
                    <div class="col-md-4 col-xs-4">
                        <!-- 上传图片【start】-->
                        <input id="toolImage" name="toolImage" type="file" />
                        <!--
                           data-max-file-count="2" 设置最多上传数量
                        -->
                        <!-- 上传图片【end】-->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-xs-offset-2 col-md-4 col-xs-4">
                        <button type="submit" class="btn btn-primary">确 认 添 加</button>
                    </div>
                </div>
            </form>
        </section>
        <!-- 新闻动态管理内容【结束】-->
    </div>
    <!-- ./main-content end.-->

</section>
<!-- 右边内容【end】-->
<script>
    $(function () {
        $('.menu:eq(5) .second-nav').show();
        $('.menu:eq(5) .menu-content').addClass('active');
        $('.menu:eq(5) .menu-content span').addClass('cur');
        $('.menu:eq(5) .second-nav li:eq(1)').addClass('active');
    });
</script>
<script>
    var fileType = new Array('image/png','image/jpeg','image/gif','image/bmp');
    $(document).on("change",'#toolImage',function(){
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
</script>
<?php $this->_endblock();