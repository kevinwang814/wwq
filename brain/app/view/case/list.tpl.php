<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <div class="container-fluid">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title col-md-3 col-xs-3 col-sm-3" >案例管理</h3>
                            <div class="col-md-2 col-xs-3 col-sm-3">
                                <button type="button" class="btn btn-default" onclick="window.location.href='添加案例.html'">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    添加案例
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-6 col-sm-6">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="查找案例">
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
                                    <th>案例id</th>
                                    <th>案例名称</th>
                                    <th>案例所属人姓名</th>
                                    <th>培训管理</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        阳光农场
                                    </td>
                                    <td>小刘</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改案例.html'">
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
                                        吃健康
                                    </td>
                                    <td>小杜</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改案例.html'">
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
                                        幸福一家人
                                    </td>
                                    <td>校长</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改案例.html'">
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
                                        生态农场
                                    </td>
                                    <td>小李</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改案例.html'">
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
            $('.menu:eq(6) .second-nav').show();
            $('.menu:eq(6) .menu-content').addClass('active');
            $('.menu:eq(6) .menu-content span').addClass('cur');
            $('.menu:eq(6) .second-nav li:eq(0)').addClass('active');
        });
    </script>

<?php $this->_endblock(); ?>