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
                    <label class="col-md-2 col-xs-2  control-label">种子名称：</label>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" id="name" class="form-control only_read" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">种子描述：</label>
                    <div class="col-md-6 col-xs-6">
                        <textarea id="description" class="form-control only_read" style="height: auto;" readonly>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-md-2 col-xs-2  control-label">种子类别：</label>
                      <div class="col-md-6 col-xs-6" id="type">
                          蔬菜种子
                      </div>
                </div>
                <div class="form-group hide_type">
                    <label  class="col-sm-2 control-label">种子类别：</label>
                    <div class="col-md-4 col-xs-4">
                        <select class="form-control" id="select_type">
                            <option value="0">请选择种子类别</option>
                            <option value="1" selected>蔬菜种子</option>
                            <option value="2">水果种子</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="hide_content">
                    <label class="col-md-2 col-xs-2  control-label">修改种子图片：</label>
                    <div class="col-md-10 col-xs-10 img_add text-left">
                        <!-- 上传图片【start】-->
                        <div class="rewri_file">
                            <input id="seedImage" name="seedImage" type="file" />
                            <span></span>
                        </div>
                    </div>
                </div>

                div class="form-group text-left" id="imgs">
                    <label class="col-md-2 col-xs-2  control-label" >种子图片：</label>
                       <div id="imgs_show" class="col-md-10 col-xs-10 text-left" >
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
        $('.menu:eq(4) .second-nav').show();
        $('.menu:eq(4) .menu-content').addClass('active');
        $('.menu:eq(4) .menu-content span').addClass('cur');
        $('.menu:eq(4) .second-nav li:eq(0)').addClass('active');
    });
    //点击编辑事件
        $(function () {
           $('#hide_content,#submit,.hide_type').hide();
           $('#update').on('click', function () {
               var $text = $(this).text().trim();
               if($text == '编辑') {
                  $('.form-control').removeAttr('readonly').removeClass('only_read');
                  $('#hide_content,#submit,.hide_type').show();

                  $('#imgs .img_dat').clone().appendTo('.img_add');
                  $('#imgs').hide();

                  $(this).text('取消编辑');
               }
               else{
                  $('.form-control').attr('readonly','readonly').addClass('only_read');
                  $('#hide_content,#submit,.hide_type').hide();
                  $('#imgs').show();
                  $(this).text('编辑');

               }
           });
         })


        //详情页面新增图片
        var fileType = new Array('image/png','image/jpeg','image/gif','image/bmp');
        $(document).on("change",'#seedImage',function(){
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
               requestType:'detailSeed',
           },
           success:function(data){
               //console.log(JSON.stringify(data));
               //alert(data.seedInfo.src.length);
               //存储newsid到确认修改按钮里面
               $('#submit').attr('seed-id',data.seedInfo.id);
               $('#name').val(data.seedInfo.name);
               $('#description').val(data.seedInfo.description);
               $('#type').val(data.seedInfo.type);
               files = data.seedInfo.src;
               for(var i = 0;i < files.length;i ++) {
                   $('#imgs #imgs_show').append('<div class="img_dat"><span></span><img src="' + files[i] + '" alt=" "></div>');
               }


           },
           error:function(data){
               alert("错误：   " + JSON.stringify(data));
           }
        });
</script>

<?php $this->_endblock();