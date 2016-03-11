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
                <a href="/business/verify/history/list.html">
                    <span>历史审核列表</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    历史审核列表
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal" method="POST" action="<?php echo U('business/verify/history/list'); ?>">
                        <div class="form-group">
                            <label class="control-label col-sm-2">借款人:</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="loan_name" value="<?php echo requestv('loan_name','');?>" placeholder="借款人" />
                            </div>
                            <label class="control-label col-sm-2">借款编号:</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="loan_number" value="<?php echo requestv('loan_number','');?>"  placeholder="借款编号" />
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">审核状态:</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="audit_status" id="audit_status">
                                    <option value="">所有</option>
                                    <option value="finished">订单完成</option>
                                    <option value="rejected">审核拒绝</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2">借款方式:</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="loan_way" id="loan_way">
                                    <option value="">所有</option>
                                    <option value="15d_free">一次还款</option>
                                    <option value="monthly">分期还款</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">申请时间:</label>
                            <div class="col-sm-3">
                                <input id="applytime-start" name="applytime_start" class="form-control" type="text" readonly value="<?php echo requestv('applytime_start','');?>">
                            </div>
                            <div class="col-sm-3">
                                <input id="applytime-end" name="applytime_end" class="form-control" type="text" readonly value="<?php echo requestv('applytime_end','');?>">
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
                                    <th>审批金额</th>
                                    <th>利率</th>
                                    <th>借款方式</th>
                                    <th>借款时长</th>
                                    <th>信用等级</th>
                                    <th>申请时间</th>
                                    <th>借款次数</th>
                                    <th>审核状态</th>
                                    <th>审核时间</th>
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
                                    <td><?php echo $order['interest_rate'];?></td>
                                    <td><?php echo $order['loan_way'];?></td>
                                    <td><?php echo $order['duration'];?></td>
                                    <td><?php echo $order['credit_level'];?></td>
                                    <td><?php echo $order['apply_time'];?></td>
                                    <td><?php echo $order['apply_count'];?></td>
                                    <td><?php echo $order['status'];?></td>
                                    <td><?php echo $order['update_time'];?></td>
                                    <td>
                                        <a href="<?php echo U('business/verify/history/detail', array('id' => $order['id']));?>">
                                        <?php echo $order['operator'];?>
                                        </a>
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
<script src="/vendor/js/laydate.js"></script>
<script type="text/javascript">
    laydate({
        elem: '#applytime-start',
        format: 'YYYY-MM-DD',
        istime:true
    });
    laydate({
        elem: '#applytime-end',
        format: 'YYYY-MM-DD',
        istime:true
    });
    $(document).ready(function () {
        var auditStatus = '<?php echo requestv('audit_status','')?>';
        var loanWay = '<?php echo requestv('loan_way','')?>';
        if(auditStatus.length > 0){
            $('#audit_status').val(auditStatus);
        }
        if(loanWay.length > 0){
            $('#loan_way').val(loanWay);
        }
    });
</script>
<?php $this->_endblock();