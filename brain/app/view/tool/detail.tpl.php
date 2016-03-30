<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">工具名称：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" value="水桶">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">工具描述：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll">
                            适合花卉蔬菜小苗移栽种植、松土、除草之用。
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">原始工具图片：</label>
                    <img src="img/farm_img4.jpg" class="col-md-4 col-xs-4" alt="img">
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">修改工具图片：</label>
                    <div class="col-md-4 col-xs-4">
                        <!-- 上传图片【start】-->
                        <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-max-file-count="1">
                        <!--
                           data-max-file-count="2" 设置最多上传数量
                        -->
                        <!-- 上传图片【end】-->
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
            $('.menu:eq(5) .second-nav').show();
            $('.menu:eq(5) .menu-content').addClass('active');
            $('.menu:eq(5) .menu-content span').addClass('cur');
            $('.menu:eq(5) .second-nav li:eq(0)').addClass('active');
        });
    </script>
<?php $this->_endblock();