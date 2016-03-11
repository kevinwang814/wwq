<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a>
                    <span class="fa fa-money"></span>
                    <span>财务管理</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="/finance/issued/list.html">
                    <span>还款中</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="/finance/issued/list.html">
                    <span>列表</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a>
                    <span>详情</span>
                    <input type="hidden" id="valueOrderId" value="<?php echo $orderInfo['id'];?>"/>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">还款操作</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-group">
                        <input type="button" value="新建还款凭证" class="btn btn-success" data-toggle="modal" data-target="#createRepaidModal" />
                        <input type="button" value="新建逾期罚息凭证" class="btn btn-primary" data-toggle="modal" data-target="#createOverdueModal" />
                    </div>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">凭证记录列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-center">
                        <thead class="bg-default">
                          <tr>
                            <th>还款时间</th>
                            <th>还款金额</th>
                            <th>凭证类型</th>
                            <th>操作人</th>
                            <th>流水号</th>
                            <th>状态</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($recordEvidenceList) && is_array($recordEvidenceList)):?>
                                <?php foreach($recordEvidenceList as $recordEvidence):?>
                                    <tr>
                                        <td><?php echo $recordEvidence['repay_time'];?></td>
                                        <td><?php echo $recordEvidence['amount'];?></td> 
                                        <td><?php echo $recordEvidence['type'];?></td> 
                                        <td><?php echo $recordEvidence['operator'];?></td>
                                        <td><?php echo $recordEvidence['trade_no'];?></td>
                                        <td><?php echo $recordEvidence['status'];?></td>
                                        <td>
                                            <?php echo $recordEvidence['action'];?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>                    
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">订单详情</h3>
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">客户综合信息</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-th-center table-th-bg-default">
                                <tbody>                            
                                    <tr>
                                        <th>姓名</th>
                                        <td>
                                            <?php echo $userInfoBase['name'];?>
                                        </td>
                                        <th>身份证</th>
                                        <td>
                                            <?php echo $userInfoBase['identity_card'];?>
                                        </td>
                                        <th>手机号</th>
                                        <td>
                                            <?php echo $userInfo['mobile_num']; ?>
                                        </td>
                                        <th>放款金额</th>
                                        <td>
                                            <?php echo $orderInfo['actual_money'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>银行名称</th>
                                        <td>
                                            <?php echo $userBankInfo['bank_name']; ?>
                                        </td>
                                        <th>开户支行</th>
                                        <td>
                                            <?php echo $userBankInfo['opening_bank_name']; ?>
                                        </td>
                                        <th>银行卡号</th>
                                        <td>
                                            <?php echo $userBankInfo['bank_card_number']; ?> 
                                        </td>
                                        <th>预留手机号</th>
                                        <td>
                                            <?php echo $userBankInfo['holder_mobile_num']; ?> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">账单信息 [借款编号:<?php echo $orderInfo['show_order_id'];?>]</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-center">
                                <thead class="bg-default">
                                  <tr>
                                    <th>还款期数</th>
                                    <th>当前状态</th>
                                    <th>还款日</th>
                                    <th>还款金额</th>
                                    <th>还款本金</th>
                                    <th>还款利息</th>
                                    <th>逾期金额</th>
                                    <th>逾期罚息</th>
                                    <th>已还金额</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($billList) && is_array($billList)):?>
                                        <?php foreach($billList as $bill):?>
                                            <tr>
                                                <td><?php echo $bill['sequence'];?></td>
                                                <td><?php echo $bill['statusCh'];?></td>                                                
                                                <td><?php echo $bill['overdue_date'];?></td>
                                                <td><?php echo $bill['repay_money'];?></td>
                                                <td><?php echo $bill['principal'];?></td>
                                                <td><?php echo $bill['interest'];?></td>
                                                <td><?php echo $bill['overdue_amount'];?></td>
                                                <td><?php echo $bill['overdue_fine'];?></td>
                                                <td><?php echo $bill['repaid_money'];?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<!-- repaidModal -->
<div class="modal fade" id="repaidModal" tabindex="-1" role="dialog" aria-labelledby="repaidModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="repaidModalLabel">确认收款状态</h4>
        </div>
        <div class="modal-body">
            <div class="well well-lg text-center">
                确认是否已经收到款~
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="repaid">确认</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>

<!-- createRepaidModal -->
<div class="modal fade" id="createRepaidModal" tabindex="-1" role="dialog" aria-labelledby="createRepaidModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="createRepaidModalLabel">创建还款凭证信息</h4>
        </div>
        <div class="modal-body">
            <div class="form-horizontal">
                <div class="form-group">
                  <label for="repaidAmount" class="col-sm-2 control-label">金额</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="repaidAmount" placeholder="金额" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="type" class="col-sm-2 control-label">还款类型</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="repaidSource">
                        <option value="">选择还款类型</option>
                        <option value="weixin">微信</option>
                        <option value="zhifubao">支付宝</option>
                        <option value="banktransfer">银行转账</option>
                        <option value="cash">现金</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="repaidRemark" class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="4" placeholder="备注" id="repaidRemark"></textarea>
                    </div>
                </div>               
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="createRepaid">确认</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>

<!-- createOverdueModal -->
<div class="modal fade" id="createOverdueModal" tabindex="-1" role="dialog" aria-labelledby="createOverdueModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="createOverdueModalLabel">创建逾期罚息凭证</h4>
        </div>
        <div class="modal-body">
            <div class="form-horizontal">
                <div class="form-group">
                  <label for="overdueAmount" class="col-sm-2 control-label">金额</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="overdueAmount" placeholder="金额(逾期罚息的金额)" />
                  </div>
                </div>
                <div class="form-group">
                    <label for="overdueRemark" class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="4" placeholder="备注" id="overdueRemark"></textarea>
                    </div>
                </div>               
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="createOverdue">确认</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#createRepaid").click(function(){
            var repaidAmount = $("#repaidAmount").val();
            var repaidSource = $("#repaidSource").val();
            var repaidRemark = $("#repaidRemark").val();
            var orderId = '<?php echo $orderInfo['id'] ?>';
            if(repaidSource.length < 1 ){
                alert('请选择还款类型');
                return false;
            }
            $.ajax({
                url: "handler.html",  
                type: "POST",
                data:{
                        action:"createRepaid",
                        repaidAmount:repaidAmount,
                        repaidSource:repaidSource,
                        orderId:orderId,
                        repaidRemark:repaidRemark
                     },
                beforeSend: function(){
                    // 禁用按钮防止重复提交
                    $("#createRepaid").attr("disabled","disabled");
                },
                error: function(){  
                    alert('Error loading XML document');  
                },
                complete: function () {
                    $("#createRepaid").removeAttr("disabled");
                },  
                success: function(data){
                    //如果调用php成功
                    if(data.status == 'success'){
                        alert('操作成功~');
                        location.reload();
                    }
                    if(data.status == 'failure'){
                        alert(data.message);
                    }
                    $('#createRepaidModal').modal('hide');                    
                }
            });
        });
        $("#createOverdue").click(function(){
            var overdueAmount = $("#overdueAmount").val();
            if(overdueAmount.length < 1){
                alert('金额不能为空');
                return false;
            }
            var overdueRemark = $("#overdueRemark").val();
            var orderId = '<?php echo $billInfo['order_id'] ?>';
            var billId = '<?php echo $billInfo['id'] ?>';
            $.ajax({
                url: "handler.html",  
                type: "POST",
                data:{
                        action:"createOverdue",
                        overdueAmount:overdueAmount,
                        orderId:orderId,
                        billId:billId,
                        overdueRemark:overdueRemark
                     },
                beforeSend: function(){
                    // 禁用按钮防止重复提交
                    $("#createOverdue").attr("disabled","disabled");
                },
                error: function(){  
                    alert('Error loading XML document');  
                },
                complete: function () {
                    $("#createOverdue").removeAttr("disabled");
                },  
                success: function(data){
                    //如果调用php成功
                    if(data.status == 'success'){
                        alert('操作成功~');
                        $('#createOverdueModal').modal('hide');
                        location.reload();
                    }
                    if(data.status == 'failure'){
                        alert(data.message);
                    }                    
                }
            });
        });        
    });
    function changeRepayStatus(recordEvidenceId){
        $("#repaidModal").modal('toggle');
        $("#repaid").click(function(){
            $.ajax({
                url: "handler.html",  
                type: "POST",
                data:{
                        action:"repaid",
                        id:recordEvidenceId
                     },
                beforeSend: function(){
                    // 禁用按钮防止重复提交
                    $("#repaid").attr("disabled","disabled");
                },
                error: function(){  
                    alert('Error loading XML document');  
                },
                complete: function () {
                    $("#repaid").removeAttr("disabled");
                },  
                success: function(data){
                    //如果调用php成功
                    if(data.status == 'success'){
                        alert('操作成功~');
                        location.reload();
                    }
                    if(data.status == 'failure'){
                        alert(data.message);
                    }
                    $('#repaidModal').modal('hide');
                }
            });            
        });
    }    
</script>
<?php $this->_endblock();