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
                    <label class="col-md-2 col-xs-2  control-label">用户名称：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" id="userName" class="form-control only_read"  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户密码：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="password" id="password" class="only_read" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户电话：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="number" id="mobileNum" class="form-control only_read" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户邮箱：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="email" id="email" class="form-control only_read" readonly>
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
        $('.menu:eq(0) .second-nav').show();
        $('.menu:eq(0) .menu-content').addClass('active');
        $('.menu:eq(0) .menu-content span').addClass('cur');
        $('.menu:eq(0) .second-nav li:eq(0)').addClass('active');
    });


    //点击编辑事件
        $(function () {
           $('#submit').hide();
           $('#update').on('click', function () {
               var $text = $(this).text().trim();
               if($text == '编辑') {
                  $('.form-control,#password').removeAttr('readonly').removeClass('only_read');
                  $('#submit').show();
                  $(this).text('取消编辑');
               }
               else{
                  $('.form-control,#password').attr('readonly','readonly').addClass('only_read');
                  $('#submit').hide();
                  $(this).text('编辑');
               }
           });
         })
    
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
            $('#name').val(data.userInfo.userName);
            $('#password').val(data.userInfo.password);
            $('#phone').val(data.userInfo.mobileNum);
            $('#email').val(data.userInfo.email);
       },
       error:function(data){
           //alert("错误：   " + JSON.stringify(data));
       }
    });
</script>

<?php $this->_endblock();