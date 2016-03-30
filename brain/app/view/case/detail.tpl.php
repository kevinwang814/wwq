<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">案例名称：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" value="阳光农场">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">案例描述：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll">
                            炎炎夏日，寻一处庇荫纳凉地。举目望去，满园绿色。一把竹藤椅，再来根嫩黄瓜，解渴消暑，真是极好的！
                            武汉凯德民众乐园的屋顶菜园，正符合各种吃货、玩家，体验种植乐园，感受悠闲田园风光的好去处！
                        </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">原始种子图片：</label>
                    <img src="img/farm_img5.jpg" class="col-md-4 col-xs-4" alt="img">
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">修改种子图片：</label>
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
                    <label  class="col-sm-2 control-label">案例所属人姓名：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" value="小王">
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
            $('.menu:eq(6) .second-nav').show();
            $('.menu:eq(6) .menu-content').addClass('active');
            $('.menu:eq(6) .menu-content span').addClass('cur');
            $('.menu:eq(6) .second-nav li:eq(0)').addClass('active');
        });
    </script>
<?php $this->_endblock();

