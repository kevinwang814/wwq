<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
    <!-- 新闻动态管理内容【开始】-->
    <section id="movie-content" style="margin-top: 50px">
        <div class="container-fluid">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="panel-title col-md-1 col-xs-3 col-sm-3" >培训管理</h3>
                        <div class="col-md-2 col-xs-3 col-sm-3">
                            <button type="button" class="btn btn-default" onclick="window.location.href='添加培训内容.html'">
                                <span class="glyphicon glyphicon-plus"></span>
                                添加培训内容
                            </button>
                        </div>
                        <div class="col-md-2 col-xs-6 col-sm-6">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="查找培训内容">
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
                                <th>培训id</th>
                                <th>培训标题</th>
                                <!--<th>新闻图片地址</th>-->
                                <th>培训上传时间</th>
                                <th>培训管理</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    这个夏天，阳台种菜浇水问题要注意这些
                                </td>
                                <!--<td>F://back_stage/img/1.jpg</td>-->
                                <td>2016/1/18</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    家庭阳台菜园设计：不同阳台面积大小，可种植哪些蔬菜？
                                </td>
                                <!--<td>F://back_stage/img/2.jpg</td>-->
                                <td>2016/1/5</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    史上最全的阳台种菜好处大集合，值得收藏！
                                </td>
                                <!--<td>F://back_stage/img/3.jpg</td>-->
                                <td>2016/1/1</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    八、九月份阳台适合种植的蔬菜品种已整理好了，以供参考！
                                </td>
                                <!--<td>F://back_stage/img/4.jpg</td>-->
                                <td>2016/1/18</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    屋顶种菜到底会不会影响风水，真相来了
                                </td>
                                <!--<td>F://back_stage/img/5.jpg</td>-->
                                <td>2016/1/5</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    屋顶菜园设计施工前要三思，这些细节需注意
                                </td>
                                <!--<td>F://back_stage/img/6.jpg</td>-->
                                <td>2016/1/1</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    阳台菜园用土不注意，健康安全出问题
                                </td>
                                <!--<td>F://back_stage/img/7.jpg</td>-->
                                <td>2016/1/18</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
                                    一分钟掌握阳台种菜施肥五个关键点
                                </td>
                                <!--<td>F://back_stage/img/8.jpg</td>-->
                                <td>2016/1/5</td>
                                <td>
                                    <button type="button" class="btn btn-primary update" onclick="window.location.href='修改培训内容.html'">
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
        $('.menu:eq(3) .second-nav').show();
        $('.menu:eq(3) .menu-content').addClass('active');
        $('.menu:eq(3) .menu-content span').addClass('cur');
        $('.menu:eq(3) .second-nav li:eq(0)').addClass('active');
    });
</script>
<?php $this->_endblock();