<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <div class="container-fluid">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title col-md-1 col-xs-3 col-sm-3" >个人农场管理</h3>
                            <div class="col-md-2 col-xs-3 col-sm-3">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    添加农场
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-6 col-sm-6">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="查找农场">
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
                                    <th>农场id</th>
                                    <th>农场名称</th>
                                    <th>农场主姓名</th>
                                    <!--<th>农场图片</th>-->
                                    <!--<th>农场种子</th>-->
                                    <!--<th>农场工具</th>-->
                                    <th>农场管理</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        小王农场
                                    </td>
                                    <td>小王</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
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
                                        小范农场
                                    </td>
                                    <td>小范</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
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
                                        小李农场
                                    </td>
                                    <td>小李</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
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
                                        小张农场
                                    </td>
                                    <td>小张</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
                                        </button>
                                        <button type="button" class="btn btn-danger delete" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        小杨农场
                                    </td>
                                    <td>小杨</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>
                                        小周农场
                                    </td>
                                    <td>小周</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>
                                        阳光农场
                                    </td>
                                    <td>阳光</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
                                        </button>
                                        <button type="button" class="btn btn-danger delete" onclick="window.location.href='#'">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>
                                        雨露农场
                                    </td>
                                    <td>雨露</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改个人农场.html'">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            修改
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href='#'">
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