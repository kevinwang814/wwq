<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
    <!-- 新闻动态管理内容【开始】-->
    <section id="movie-content" style="margin-top: 50px">
        <form class="form-horizontal" action="#" method="post">
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">农场名称：</label>
                <div class="col-md-4 col-xs-4">
                    <input type="text" class="form-control" value="阳光农场">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">农场主：</label>
                <div class="col-md-4 col-xs-4">
                    <select class="form-control" required>
                        <option value="0">请选择农场主姓名</option>
                        <option value="1" selected>王文倩</option>
                        <option value="2">范翠霞</option>
                        <option value="3">李凯</option>
                        <option value="4">王鹏宇</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">原始新闻图片：</label>
                <img src="img/fram_img.jpg" class="col-md-4 col-xs-4" alt="img">
            </div>
            <div class="form-group">
                <label class="col-md-2 col-xs-2  control-label">修改新闻图片：</label>
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
            <div class="form-group">
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
        $('.menu:eq(2) .second-nav').show();
        $('.menu:eq(2) .menu-content').addClass('active');
        $('.menu:eq(2) .menu-content span').addClass('cur');
        $('.menu:eq(2) .second-nav li:eq(0)').addClass('active');
    });
</script>
<?php $this->_endblock(); ?>