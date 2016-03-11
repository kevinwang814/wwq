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
                    <span>待放款</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="/finance/pend/list.html">
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
                    <form role="form" class="form-horizontal" method="POST" action="<?php echo U('finance/pend/list'); ?>">
                        <div class="form-group">
                            <label class="control-label col-sm-2">借款人:</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="loan_name" value="<?php echo requestv('loan_name','');?>" placeholder="借款人" />
                            </div>
                            <label class="control-label col-sm-2">手机号码:</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="mobile_number" value="<?php echo requestv('mobile_number','');?>"  placeholder="手机号码" />
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">通过时间:</label>
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
                                    <th>审批金额</th>
                                    <th>放款金额</th>
                                    <th>充值费</th>
                                    <th>利率</th>
                                    <th>借款方式</th>
                                    <th>借款时长</th>
                                    <th>信用等级</th>
                                    <th>终审人</th>
                                    <th>终审通过时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(isset($orderList) && is_array($orderList)):?>
                                <?php foreach($orderList as $order):?>
                                <tr class="odd gradeX">
                                    <td><?php echo $order['show_order_id'];?></td>
                                    <td><?php echo $order['name'];?></td>
                                    <td><?php echo $order['apply_money'];?></td>
                                    <td><?php echo $order['audit_money'];?></td>
                                    <td><?php echo $order['actual_money'];?></td>
                                    <td><?php echo $order['poundage'];?></td>
                                    <td><?php echo $order['interest_rate'];?></td>
                                    <td>分期借款</td>
                                    <td><?php echo $order['duration'];?></td>
                                    <td><?php echo $order['credit_level'];?></td>
                                    <td></td>
                                    <td><?php echo $order['audit_time'];?></td>
                                    <td>
                                        <a href="<?php echo U('finance/pend/detail', array('id' => $order['id']));?>">详情</a>
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