<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻标题：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" value="家庭屋顶菜园-午后的纳凉地">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻描述：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll">
                            炎炎夏日里，最受人们欢迎的当属那些凉快、避暑的地方，什么海滩、水上公园都成了“下饺子”的场所。
                            今天，小编特别推荐一个夏日午后的好去处——屋顶菜园。
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">新闻内容：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll">
                            炎炎夏日里，最受人们欢迎的当属那些凉快、避暑的地方，什么海滩、水上公园都成了“下饺子”的场所。今天，小编特别推荐一个夏日午后的好去处——屋顶菜园。
                            爬上屋顶菜园，虽没有大自然里的碧水青山，但放眼望去，一抹新绿铺满整个屋顶，令人心旷神怡。置身其中，细长的瓜果藤蔓悠悠地爬满菜园栅栏，形成一道植物绿墙。
                            由支杆架起的番茄早已挂满了果实，等待采摘。不远处，挺拔的玉米超过了人高，一阵风过，叶子在风中起舞摇曳。
                        </textarea>
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
<!-- 右边内容【end】-->
<script>
    $(function () {
        $('.menu:eq(1) .second-nav').show();
        $('.menu:eq(1) .menu-content').addClass('active');
        $('.menu:eq(1) .menu-content span').addClass('cur');
        $('.menu:eq(1) .second-nav li:eq(0)').addClass('active');
    });
</script>
<script src="js/file/fileinput.js"></script>
<script src="js/file/fileinput_locale_zh.js"></script>
<script>

    $("#file-1").fileinput({
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
</script>
<?php $this->_endblock();