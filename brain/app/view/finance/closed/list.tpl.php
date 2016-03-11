<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="#">
                    <span class="fa fa-money"></span>
                    <span>财务管理</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="#">
                    <span>已结清</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="/finance/closed/list.html">
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
                    <form role="form" class="form-horizontal" method="POST" action="<?php echo U('finance/closed/list'); ?>">
                        <div class="form-group">
                            <label class="control-label col-sm-2">借款人:</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="loan_name" value="<?php echo requestv('loan_name','');?>" placeholder="借款人" />
                            </div>
                            <label class="control-label col-sm-2">手机号码:</label>
                            <div class="col-sm-2">
                                <input class="form-control" name="mobile_number" value="<?php echo requestv('mobile_number','');?>"  placeholder="手机号码" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">放款时间:</label>
                            <div class="col-sm-3">
                                <input id="audittime-start" name="audittime_start" class="form-control" type="text" readonly value="<?php echo requestv('audittime_start','');?>">
                            </div>
                            <div class="col-sm-3">
                                <input id="audittime-end" name="audittime_end" class="form-control" type="text" readonly value="<?php echo requestv('audittime_end','');?>">
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
                                        <a href="<?php echo U('finance/issued/detail', array('id' => $bill['id']));?>">详情</a>
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
<script type="text/javascript">
    laydate({
        elem: '#audittime-start',
        format: 'YYYY-MM-DD hh:mm:ss',
        istime:true
    });
    laydate({
        elem: '#audittime-end',
        format: 'YYYY-MM-DD hh:mm:ss',
        istime:true
    });
</script>
<?php $this->_endblock();