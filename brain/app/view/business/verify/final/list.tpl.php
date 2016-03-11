<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="#">
                    <span class="glyphicon glyphicon-book"></span>
                    <span>业务管理</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="#">
                    <span>借款审核</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="#">
                    <span>终审</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    审核列表
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal">
                        <div>
                            <div class="form-group col-sm-4">
                                <label class="control-label col-sm-6">审核状态:</label>
                                <div class="col-sm-6">
                                    <select class="form-control">
                                        <option value="0">初审中</option>
                                        <option value="1">初审通过</option>
                                        <option value="2">补件中</option>
                                        <option value="1">初审不通过</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="control-label col-sm-6">借款方式:</label>
                                <div class="col-sm-6">
                                    <select class="form-control">
                                        <option value="0">一次还款</option>
                                        <option value="1">多次还款</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                               <label class="control-label col-sm-6">信用等级:</label>
                               <div class="col-sm-6">
                                   <select class="form-control">
                                       <option value="0">D</option>
                                       <option value="1">C</option>
                                       <option value="2">A</option>
                                   </select>
                               </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">借款编号:</label>
                                <div class="col-sm-5">
                                    <input class="form-control" placeholder="借款编号" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="control-label col-sm-2">申请时间:</label>
                            <div class="col-sm-3">
                                <div class="input-group form-group">
                                    <input id="form-datetime-start" class="form-control" type="text" readonly value="">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group form-group">
                                    <input id="form-datetime-end" class="form-control" type="text" readonly value="">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary btn-block" value="确认筛选"/>
                            </div>
                        </div>
                    </form>
                    <div class="datatable-content">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>借款编号</th>
                                    <th>借款人</th>
                                    <th>审批金额</th>
                                    <th>利率</th>
                                    <th>借款方式</th>
                                    <th>借款时长</th>
                                    <th>信用等级</th>
                                    <th>申请时间</th>
                                    <th>借款次数</th>
                                    <th>审核状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                                <tr class="odd gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                                <tr class="even gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                                <tr class="odd gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td>7</td>
                                    <td>A</td>
                                    <td>Trident</td>
                                    <td>Internet Explorer 7</td>
                                    <td>Win XP SP2+</td>
                                    <td>7</td>
                                    <td>A</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                                <tr class="even gradeA">
                                    <td>Trident</td>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td>6</td>
                                    <td>A</td>
                                    <td>Trident</td>
                                    <td>AOL browser (AOL desktop)</td>
                                    <td>Win XP</td>
                                    <td>6</td>
                                    <td>A</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                    <td>Gecko</td>
                                    <td>Firefox 1.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                    <td>
                                        <a href="detail.html">查看</a>
                                    </td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                    <td>Gecko</td>
                                    <td>Firefox 1.5</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>                                                
                                </tr>
                                <tr class="gradeA">
                                    <td>Gecko</td>
                                    <td>Firefox 2.0</td>
                                    <td>Win 98+ / OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                    <td>Gecko</td>
                                    <td>Firefox 3.0</td>
                                    <td>Win 2k+ / OSX.3+</td>
                                    <td>1.9</td>
                                    <td>A</td>
                                    <td>
                                        <a href="examine_detail.html">查看</a>
                                    </td> 
                                </tr>
                                <tr class="gradeA">
                                    <td>Gecko</td>
                                    <td>Camino 1.0</td>
                                    <td>OSX.2+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                    <td>Gecko</td>
                                    <td>Camino 1.5</td>
                                    <td>OSX.3+</td>
                                    <td>1.8</td>
                                    <td>A</td>
                                    <td>
                                        <a href="detail.html">查看</a>
                                    </td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Gecko</td>
                                    <td>Netscape 7.2</td>
                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                    <td>Gecko</td>
                                    <td>Netscape Browser 8</td>
                                    <td>Win 98SE+</td>
                                    <td>1.7</td>
                                    <td>A</td>
                                    <td>
                                        <a href="detail.html">审核</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="datatable-pagination">
                        <ul class="pagination pull-right" style="margin:0px;">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class="disabled"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<script src="/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/vendor/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#form-datetime-start").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    $("#form-datetime-end").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>
<?php $this->_endblock(); ?>