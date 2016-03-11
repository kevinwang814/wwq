<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
    <div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <div class="container-fluid">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title col-md-1 col-xs-3 col-sm-3" >新闻动态管理</h3>
                            <div class="col-md-2 col-xs-3 col-sm-3">
                                <button type="button" class="btn btn-default" onclick="window.location.href='/news/add.html'">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    添加新闻动态
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-6 col-sm-6">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="查找新闻">
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
                                    <th>新闻动态id</th>
                                    <th>新闻标题</th>
                                    <!--<th>新闻图片地址</th>-->
                                    <th>新闻上传时间</th>
                                    <th>新闻管理</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        家庭屋顶菜园-午后的纳凉地
                                    </td>
                                    <!--<td>F://back_stage/img/1.jpg</td>-->
                                    <td>2016/1/18</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        谈谈屋顶种植项目加盟条件有哪些？
                                    </td>
                                    <!--<td>F://back_stage/img/2.jpg</td>-->
                                    <td>2016/1/5</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        这么好的屋顶绿化政策，你家屋顶还空着吗？
                                    </td>
                                    <!--<td>F://back_stage/img/3.jpg</td>-->
                                    <td>2016/1/1</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        智能时代，屋顶种菜其实很简单！
                                    </td>
                                    <!--<td>F://back_stage/img/4.jpg</td>-->
                                    <td>2016/1/18</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        如果我有个屋顶，我也这么搭建裁员！
                                    </td>
                                    <!--<td>F://back_stage/img/5.jpg</td>-->
                                    <td>2016/1/5</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        爱种菜的中国人，无处不在
                                    </td>
                                    <!--<td>F://back_stage/img/6.jpg</td>-->
                                    <td>2016/1/1</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        盘点美国的那些“著名菜地”，涨涨见识
                                    </td>
                                    <!--<td>F://back_stage/img/7.jpg</td>-->
                                    <td>2016/1/18</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
                                        你在屋顶种菜，政府给你福利"
                                    </td>
                                    <!--<td>F://back_stage/img/8.jpg</td>-->
                                    <td>2016/1/5</td>
                                    <td>
                                        <button type="button" class="btn btn-primary update" onclick="window.location.href='修改新闻.html'">
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
        $('.menu:eq(1) .second-nav').show();
        $('.menu:eq(1) .menu-content').addClass('active');
        $('.menu:eq(1) .menu-content span').addClass('cur');
        $('.menu:eq(1) .second-nav li:eq(0)').addClass('active');
    });
</script>
<?php $this->_endblock();