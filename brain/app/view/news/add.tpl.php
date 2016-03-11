<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <form class="form-horizontal" action="#" method="post">
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻标题：</label>
                    <div class="col-md-4 col-xs-4">
                        <input type="text" class="form-control" placeholder="新闻标题" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻描述：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">新闻内容：</label>
                    <div class="col-md-4 col-xs-4">
                        <textarea class="form-control" style="height: 200px;overflow-y: scroll" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-xs-2  control-label">新闻图片：</label>
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
        $('.menu:eq(1) .second-nav').show();
        $('.menu:eq(1) .menu-content').addClass('active');
        $('.menu:eq(1) .menu-content span').addClass('cur');
        $('.menu:eq(1) .second-nav li:eq(1)').addClass('active');
    });
</script>
<script src="/js/file/fileinput.js"></script>
<script src="/js/file/fileinput_locale_zh.js"></script>
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