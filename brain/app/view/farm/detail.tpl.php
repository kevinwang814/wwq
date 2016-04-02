<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
    <!-- 新闻动态管理内容【开始】-->
    <section id="movie-content" style="margin-top: 50px">

        <div style="display: block;width: 100%;margin-bottom: 20px">
            <button type="button" class="btn btn-primary" id="update">编辑<btton>
        </div>

        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">农场名称：</label>
                <div class="col-md-6 col-xs-6">
                    <input type="text" id="" class="form-control only_read" readonly>
                </div>
            </div>

            <div class="form-group">
                 <label class="col-md-2 col-xs-2  control-label">农场主姓名：</label>
                 <div class="col-md-6 col-xs-6">
                      王文倩
                 </div>
            </div>

            <div class="form-group" class="hide_name">
                <label class="col-md-2 col-xs-2  control-label">农场主：</label>
                <div class="col-md-6 col-xs-6">
                    <select class="form-control" required>
                        <option value="0">请选择农场主姓名</option>
                        <option value="1" selected>王文倩</option>
                        <option value="2">范翠霞</option>
                        <option value="3">李凯</option>
                        <option value="4">王鹏宇</option>
                    </select>
                </div>
            </div>

            <div class="form-group" id="hide_content">
                 <label class="col-md-2 col-xs-2  control-label">修改农场图片：</label>
                 <div class="col-md-10 col-xs-10 img_add text-left">
                     <!-- 上传图片【start】-->
                     <div class="rewri_file">
                          <input id="farmImage" name="farmImage" type="file" />
                          <span></span>
                     </div>
                 </div>
            </div>

            <div class="form-group text-left" id="imgs">
                 <label class="col-md-2 col-xs-2  control-label" >农场图片：</label>
                 <div id="imgs_show" class="col-md-10 col-xs-10 text-left" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">农场种子：</label>
                <div class="col-md-6 col-xs-6">
                   王文倩
                </div>
            </div>

            <div class="form-group" class="hide_name">
                <label class="col-md-2 col-xs-2  control-label">农场种子：</label>
                <div class="col-md-4 col-xs-4 text-left">
                    <div class="checkbox">
                        蔬菜种子：
                        <label>
                            <input type="checkbox" value="" checked>
                            西红柿
                        </label>
                        <label>
                            <input type="checkbox" value="" checked>
                            黄瓜
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group" class="hide_name">
                <div class="checkbox col-md-4 col-xs-4 col-md-offset-2 col-xs-offset-2 text-left" >
                    瓜果种子：
                    <label>
                        <input type="checkbox" value="" checked>
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
                        <input type="checkbox" value="" checked>
                        甘蔗
                    </label>
                </div>
            </div>

            <div class="form-group">
                 <label class="col-md-2 col-xs-2  control-label">农场工具：</label>
                 <div class="col-md-6 col-xs-6">
                    水桶、铁锹
                 </div>
            </div>

            <div class="form-group" class="hide_name">
                <label  class="col-sm-2 control-label">农场工具：</label>
                <div class="col-md-4 col-xs-4 text-left">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            水桶
                        </label>
                        <label>
                            <input type="checkbox" value="" checked>
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
                    <button id="submit" class="btn btn-primary">确 认 修 改</button>
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
        $('.menu:eq(2) .second-nav li:eq(0)').addClass('active');
    });

    //点击编辑事件
        $(function () {
           $('#hide_content,#submit,.hide_name').hide();
           $('#update').on('click', function () {
               var $text = $(this).text().trim();
               if($text == '编辑') {
                  $('.form-control').removeAttr('readonly').removeClass('only_read');
                  $('#hide_content,#submit,.hide_name').show();
                  $('#imgs .img_dat').clone().appendTo('.img_add');
                  $('#imgs').hide();
                  $(this).text('取消编辑');
               }
               else{
                  $('.form-control').attr('readonly','readonly').addClass('only_read');
                  $('#hide_content,#submit,.hide_name').hide();
                  $('#imgs').show();
                  $(this).text('编辑');

               }
           });
         })


        //详情页面新增图片(这部分布局有问题，你处理一下)
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

        //页面初始化ajax数据请求
        var id = "<?php echo $id?>";


        var files;


        $.ajax({
           url:'handler.html',
           type:'POST',
           dataType:'json',
           data:{
               id:id,
               requestType:'detailFarm',
           },
           success:function(data){
               //console.log(JSON.stringify(data));
               //存储newsid到确认修改按钮里面
               $('#submit').attr('farm-id',data.farmInfo.id);
               $('#title').val(data.farmInfo.title);
               $('#description').val(data.farmInfo.description);
               $('#content').val(data.farmInfo.content);
               files = data.farmInfo.src;
               for(var i = 0;i < files.length;i ++) {
                   $('#imgs #imgs_show').append('<div class="img_dat"><span></span><img src="' + files[i] + '" alt=" "></div>');
               }
           },
           error:function(data){
               alert("错误：   " + JSON.stringify(data));
           }
        });


</script>
<?php $this->_endblock(); ?>