<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
    <!-- 新闻动态管理内容【开始】-->
    <section id="movie-content" style="margin-top: 50px">
        <form class="form-horizontal" action="#" method="post">
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">农场名称：</label>
                <div class="col-md-6 col-xs-6">
                    <input type="text" class="form-control" id="name" placeholder="农场名称" required>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">农场主：</label>
                <div class="col-md-6 col-xs-6">
                    <select class="form-control" required id="farmer">
                        <option value="0" selected>请选择农场主姓名</option>
                        <option value="1">王文倩</option>
                        <option value="2">范翠霞</option>
                        <option value="3">李凯</option>
                        <option value="4">王鹏宇</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                 <label class="col-md-2 col-xs-2  control-label">培训图片：</label>
                 <div class="col-md-10 col-xs-10 img_add text-left">
                     <!-- 上传图片【start】-->
                     <div class="rewri_file">
                         <input id="farmImage" name="farmImage" type="file" />
                         <span></span>
                     </div>
                 </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">农场种子：</label>
                <div class="col-md-6 col-xs-6 text-left">
                    <div class="checkbox">
                        蔬菜种子：
                        <label>
                            <input type="checkbox" value="">
                            西红柿
                        </label>
                        <label>
                            <input type="checkbox" value="">
                            黄瓜
                        </label>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="checkbox col-md-6 col-xs-6 col-md-offset-2 col-xs-offset-2 text-left" >
                    瓜果种子：
                    <label>
                        <input type="checkbox" value="" >
                        苹果
                    </label>
                    <label>
                        <input type="checkbox" value="" disabled>
                        香蕉
                    </label>
                    <label>
                        <input type="checkbox" value="" >
                        荔枝
                    </label>
                    <label>
                        <input type="checkbox" value="" >
                        甘蔗
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">农场工具：</label>
                <div class="col-md-6 col-xs-6 text-left">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            水桶
                        </label>
                        <label>
                            <input type="checkbox" value="">
                            铁锹
                        </label>
                        <label>
                            <input type="checkbox" value="">
                            铲子
                        </label>
                        <label>
                            <input type="checkbox" value="" disabled>
                            水盆
                        </label>
                    </div>
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
        $('.menu:eq(2) .second-nav').show();
        $('.menu:eq(2) .menu-content').addClass('active');
        $('.menu:eq(2) .menu-content span').addClass('cur');
        $('.menu:eq(2) .second-nav li:eq(1)').addClass('active');
    });
</script>


<script>
    var fileType = new Array('image/png','image/jpeg','image/gif','image/bmp');
    $(document).on("change",'#farmImage',function(){
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
                    //alert(JSON.stringify(data));
//                        alert(JSON.stringify(data.src));
                    $('.img_add').append('<div class="img_dat"><span></span><img src="' + data.src + '" alt=" "></div>');
                }
            });
        }
    
    });
     //点击图片删除事件
        $(document).on('click','.img_add .img_dat',function() {
            if(confirm('是否要删除吗？')) {
                 $(this).remove();
            }
        });
</script>
<?php $this->_endblock(); ?>