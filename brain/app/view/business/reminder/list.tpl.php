<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="#">
                    <span class="fa fa-money"></span>
                    <span>业务管理</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="#">
                    <span>催收列表</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="/business/reminder/list.html">
                    <span>列表</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    放款操作
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal">
                        <div>
                            <div class="form-group col-sm-4">
                                <label class="control-label col-sm-6">手机号码:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" placeholder="手机号码" />
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
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="借款编号" />
                                </div>
                                <label class="control-label col-sm-1">身份证:</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="身份证" />
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
                    <div>
                        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>借款编号</th>
                                    <th>借款人</th>
                                    <th>借款金额</th>
                                    <th>终审金额</th>
                                    <th>放款金额</th>
                                    <th>借款总期数</th>
                                    <th>应还金额</th>
                                    <th>应还本金</th>
                                    <th>应还利息</th>
                                    <th>还款日</th>
                                    <th>已还金额</th>
                                    <th>当前还款期数</th>
                                    <th>逾期金额</th>
                                    <th>逾期罚息</th>
                                    <th>有新还款凭证</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(isset($billList) && is_array($billList)):?>
                                <?php foreach($billList as $bill):?>
                                <tr class="odd gradeX">
                                    <td><?php echo $bill['show_order_id'];?></td>
                                    <td><?php echo $bill['name'];?></td>
                                    <td><?php echo $bill['apply_money'];?></td>
                                    <td><?php echo $bill['audit_money'];?></td>
                                    <td><?php echo $bill['actual_money'];?></td>
                                    <td><?php echo $bill['period_num'];?></td>
                                    <td><?php echo $bill['repay_money'];?></td>
                                    <td><?php echo $bill['principal'];?></td>
                                    <td><?php echo $bill['interest'];?></td>
                                    <td><?php echo $bill['overdue_date'];?></td>
                                    <td><?php echo $bill['repaid_money'];?></td>
                                    <td><?php echo $bill['sequence'];?>/<?php echo $bill['period_num'];?></td>
                                    <td></td>
                                    <td><?php echo $bill['overdue_fine'];?></td>
                                    <td><?php echo $bill['is_repaying'];?></td>
                                    <td><?php echo $bill['statusCh'];?></td>
                                    <td>
                                        <a href="<?php echo U('business/reminder/detail', array('id' => $bill['id']));?>">详情</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="datatable-pagination">
                        <?php echo $pager;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/vendor/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#form-datetime-start").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    $("#form-datetime-end").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>
<?php $this->_endblock();