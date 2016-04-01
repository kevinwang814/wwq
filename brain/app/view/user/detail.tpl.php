<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户名称：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" value="王文倩">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户密码：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="password" class="form-control" value="123456">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户电话：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="number" class="form-control" value="15839925037">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户邮箱：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="email" class="form-control" value="wangwenqian0324@163.com">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-xs-offset-2 col-md-4 col-xs-4">
                        <button type="submit" class="btn btn-primary">确 认 修 改</button>
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
        $('.menu:eq(0) .second-nav').show();
        $('.menu:eq(0) .menu-content').addClass('active');
        $('.menu:eq(0) .menu-content span').addClass('cur');
        $('.menu:eq(0) .second-nav li:eq(0)').addClass('active');
    });

    
    //页面初始化ajax数据请求
    var id = "<?php echo $id?>";
    $.ajax({
       url:'handler.html',
       type:'POST',
       dataType:'json',
       data:{
           id:id,
           requestType:'detailUser',
       },
       success:function(data){
           console.log(JSON.stringify(data));
           //alert(data.newsInfo.src.length);

          /* $('#title').val(data.newsInfo.title);
           $('#description').val(data.newsInfo.description);
           $('#content').val(data.newsInfo.content);
           files = data.newsInfo.src;
           console.log(files);
           for(var i = 0;i < files.length;i ++) {
               $('#imgs').append('<div class="img_dat"><span></span><img src="' + files[i] + '" alt=" "></div>');
           }*/


       },
       error:function(data){
           //alert("错误：   " + JSON.stringify(data));
       }
    });
</script>

<?php $this->_endblock();