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
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="#">
                    <span>待放款</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="/finance/pend/list.html">
                    <span>列表</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a>
                    <span>详情</span>
                    <input type="hidden" id="valueOrderId" value="<?php echo $order['id'];?>"/>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">放款操作</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-group">
                        <input type="button" value="确认已放款" data-toggle="modal" data-target="#issuedModal" class="btn btn-success" />
<!--                        <input type="button" value="退回初审" class="btn btn-danger" id="returned"/>-->
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">订单详情</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-th-center table-th-bg-default">
                        <tbody>
                            <tr>
                                <th>姓名</th>
                                <td><?php echo $order['name']?></td>
                                <th>身份证</th>
                                <td><?php echo $order['holder_id_card']?>
                                </td>
                                <th>手机号</th>
                                <td><?php echo $order['mobile_num']?>
                                </td>
                                <th></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>银行名称</th>
                                <td><?php echo $order['bank_name']?></td>
                                <th>开户支行</th>
                                <td><?php echo $order['opening_bank_name']?></td>
                                <th>银行卡号</th>
                                <td><?php echo $order['bank_card_number']?></td>
                                <th></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>申请金额</th>
                                <td><?php echo $order['apply_money']?></td>
                                <th>核准金额</th>
                                <td><?php echo $order['audit_money']?></td>
                                <th>借款方式</th>
                                <td><?php echo $order['duration']?></td>
                                <th>借款期限</th>
                                <td><?php echo $order['period_num']?></td>
                            </tr>
                            <tr>
                                <th>放款金额</th>
                                <td><?php echo $order['actual_money']?></td>
                                <th>充值费</th>
                                <td><?php echo $order['poundage']?></td>
                                <th>利率</th>
                                <td>
                                    <?php echo $order['interest_rate']?>
                                </td>
                                <th></th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">放款金额及费用说明</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-th-center table-th-bg-default">
                        <tbody>
                            <tr>
                                <th>核准金额</th>
                                <td><?php echo $order['audit_money']?>
                                </td>
                            </tr>
                            <tr>
                                <th>借款期限</th>
                                <td>
                                    <?php echo $order['period_num']?>
                                </td>
                            </tr>
                            <tr>
                                <th>利息费用</th>
                                <td>
                                    <?php echo round($order['interest_rate']*$order['apply_money'],2) ?>
                                </td>
                            </tr>
                            <tr>
                                <th>充值费</th>
                                <td><?php echo $order['poundage']?></td>
                            </tr>
                            <tr>
                                <th>放款金额</th>
                                <td><?php echo $order['actual_money']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<!-- issuedModal -->
<div class="modal fade" id="issuedModal" tabindex="-1" role="dialog" aria-labelledby="issuedModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="issuedModalLabel">确认已放款</h4>
        </div>
        <div class="modal-body">
            <div class="well well-lg text-center">
                确认放款
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="issued">确认</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#issued").click(function(){
            $.ajax({
                url: "handler.html",  
                type: "POST",
                data:{
                        orderId:$("#valueOrderId").val()
                     },
                error: function(){  
                    alert('Error loading XML document');  
                },  
                success: function(data){
                    //如果调用php成功
                    if(data.status){
                        alert('操作成功~');
                        $('#issuedModal').modal('hide');
                    }
                }
            });
        });
        
        $('#returned').click(function(){
            
        });
    });
</script>
<?php $this->_endblock();