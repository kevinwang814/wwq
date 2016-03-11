<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="/user/handler.html" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户名称：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" name="userName" placeholder="用户名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户密码：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="password" class="form-control" name="password" placeholder="用户密码" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户电话：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="number" class="form-control" name="mobileNum" placeholder="用户电话" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">用户邮箱：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="email" class="form-control" name="email" placeholder="123@qq.com" required>
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
        $('.menu:eq(0) .second-nav').show();
        $('.menu:eq(0) .menu-content').addClass('active');
        $('.menu:eq(0) .menu-content span').addClass('cur');
        $('.menu:eq(0) .second-nav li:eq(0)').addClass('active');
    });
</script>
<script>
</script>
<?php $this->_endblock();