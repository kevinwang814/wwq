<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">

            <div style="display: block;width: 100%;margin-bottom: 20px">
                <button type="button" class="btn btn-primary" id="update">编辑<btton>
            </div>

            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻标题：</label>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" id="title" class="form-control only_read"  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻描述：</label>
                    <div class="col-md-6 col-xs-6">
                        <textarea class="form-control only_read" id="description" style="height: auto;" readonly>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">新闻内容：</label>
                    <div class="col-md-6 col-xs-6">
                        <textarea class="form-control only_read" id="content" style="height: auto;" readonly>
                        </textarea>
                    </div>
                </div>
                <div class="form-group" id="hide_content">
                     <label class="col-md-2 col-xs-2  control-label">修改新闻图片：</label>
                     <div class="col-md-10 col-xs-10 img_add text-left">
                          <!-- 上传图片【start】-->
                          <div class="rewri_file">
                               <input id="newsImage" name="newsImage" type="file" />
                               <span></span>
                          </div>
                     </div>
                </div>

                <div class="form-group text-left" id="imgs">
                    <label class="col-md-2 col-xs-2  control-label" >新闻图片：</label>

                </div>

                <div class="form-group" >
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
<!-- 右边内容【end】-->
<script>
    $(function () {
        $('.menu:eq(1) .second-nav').show();
        $('.menu:eq(1) .menu-content').addClass('active');
        $('.menu:eq(1) .menu-content span').addClass('cur');
        $('.menu:eq(1) .second-nav li:eq(0)').addClass('active');
    });

    //点击编辑事件
    $(function () {
       $('#hide_content,#submit').hide();
       $('#update').on('click', function () {
           var $text = $(this).text().trim();
           if($text == '编辑') {
              $('.form-control').removeAttr('readonly').removeClass('only_read');
              $('#hide_content,#submit').show();

              /*$('#imgs').find('label').text(" ");
              $('#imgs .img_dat,#imgs .img_dat img').css({
                 width: '150px',
                 height: '80px'
              });
              $('#imgs .img_dat:hover span,#imgs span').css({
                  display: 'inline-block'
              });*/

              $('#imgs .img_dat').clone().appendTo('.img_add');
              $('#imgs').hide();

              $(this).text('取消编辑');
           }
           else{
              $('.form-control').attr('readonly','readonly').addClass('only_read');
              $('#hide_content,#submit').hide();

               /*
              $('#imgs').find('label').text("新闻图片：");
              $('#imgs .img_dat,#imgs .img_dat img').css({
                   width: '260px',
                   height: '150px'
              });
              $('#imgs .img_dat:hover span,#imgs span').css({
                   display: 'none'
              });
              */

              $('#imgs').show();

              $(this).text('编辑');

           }
       });
     })
     
     
    //详情页面新增图片(这部分布局有问题，你处理一下)
    var fileType = new Array('image/png','image/jpeg','image/gif','image/bmp');
    $(document).on("change",'#newsImage',function(){
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
        $(document).on('click','.img_dat',function() {
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
           requestType:'detailNews',
       },
       success:function(data){
           //console.log(JSON.stringify(data));
           //alert(data.newsInfo.src.length);
           //存储newsid到确认修改按钮里面
           $('#submit').attr('news-id',data.newsInfo.id);
           $('#title').val(data.newsInfo.title);
           $('#description').val(data.newsInfo.description);
           $('#content').val(data.newsInfo.content);
           files = data.newsInfo.src;
           for(var i = 0;i < files.length;i ++) {
               $('#imgs').append('<div class="img_dat"><span></span><img src="' + files[i] + '" alt=" "></div>');
           }


       },
       error:function(data){
           alert("错误：   " + JSON.stringify(data));
       }
    });
    
    
    
    //saveUpdate
    $(document).on('click','#submit',function(){
        var title = $.trim($('#title').val());
        var description = $.trim($('#description').val());
        var content = $.trim($('#content').val());
        var img = $('.img_add .img_dat img');
        var imgStr = '';
        for(var i=0; i< img.length;i++){
            imgStr += img.eq(i).attr('src')+",";
        }
        //alert(imgStr);
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
                    requestType:'updateNews'
                },
                success:function(data){
                    if(data.message == 'success'){
                        alert("操作成功!");
                        window.location.href = '/news/list.html';
                    }
                },
                error:function(data){
                    alert(JSON.stringify(data));
                    alert("网络连接错误!");
                }
            });
        }else {
            alert("输入信息有误，请重新填写");
        }
    });
    
</script>

<?php $this->_endblock();