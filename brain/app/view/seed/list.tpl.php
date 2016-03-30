<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>

    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <div class="container-fluid">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title col-md-1 col-xs-3 col-sm-3" >种子管理</h3>
                            <div class="col-md-2 col-xs-3 col-sm-3">
                                <button type="button" class="btn btn-default" onclick="window.location.href='添加种子.html'">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    添加新品种种子
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-6 col-sm-6">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="查找相关种子">
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
                                    <th>种子id</th>
                                    <th>种子名称</th>
                                    <th>种子分类</th>
                                    <th>培训管理</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        茄子
                                    </td>
                                    <td>蔬菜种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                        丝瓜
                                    </td>
                                    <td>蔬菜种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                        青椒
                                    </td>
                                    <td>蔬菜种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                        苦瓜
                                    </td>
                                    <!--<td>F://back_stage/img/4.jpg</td>-->
                                    <td>蔬菜种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                        苹果
                                    </td>
                                    <td>水果类种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                        香蕉
                                    </td>
                                    <td>水果类种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                        香菜
                                    </td>
                                    <td>蔬菜类种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
                                       橘子
                                    </td>
                                    <td>水果类种子</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改种子.html'">
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
    <!-- ./main-content end.-->

</section>
<!-- 右边内容【end】-->
<script>
    $(function () {
        $('.menu:eq(4) .second-nav').show();
        $('.menu:eq(4) .menu-content').addClass('active');
        $('.menu:eq(4) .menu-content span').addClass('cur');
        $('.menu:eq(4) .second-nav li:eq(0)').addClass('active');
    });
</script>

<?php $this->_endblock(); ?>