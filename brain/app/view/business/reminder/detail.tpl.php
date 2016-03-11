<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a>
                    <span class="fa fa-money"></span>
                    <span>业务管理</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="/business/reminder/list.html">
                    <span>催收列表</span>
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
                                                <td></td>
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
<?php $this->_endblock();