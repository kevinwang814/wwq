<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <div class="container-fluid">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title col-md-3 col-xs-3 col-sm-3" >工具管理</h3>
                            <div class="col-md-2 col-xs-3 col-sm-3">
                                <button type="button" class="btn btn-default" onclick="window.location.href='添加工具.html'">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    添加新工具
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-6 col-sm-6">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="查找相关工具">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                              </span>
                                    </div><!-- /input-group -->
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <tr class="active">
                                    <th>工具id</th>
                                    <th>工具名称</th>
                                    <th>培训管理</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        水桶
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改工具.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            详情
                                        </button>
                                        <button type="button" class="btn btn-danger delete" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        铁锹
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改工具.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            详情
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        铲子
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改工具.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            详情
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        水盆
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改工具.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            详情
                                        </button>
                                        <button type="button" class="btn btn-danger delete" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

<?php $this->_endblock(); ?>