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
                <a>
                    <span>财务总览</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">财务总览</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-1">到账金额:</label>
                        <label class="control-label col-sm-3"><?php echo $summaryInfo['arrival_amount'];?></label>
                        <label class="control-label col-sm-1">挂账金额:</label>
                        <label class="control-label col-sm-3"><?php echo $summaryInfo['overdue_amount'];?></label>
                        <label class="control-label col-sm-1">逾期金额:</label>
                        <label class="control-label col-sm-3"><?php echo $summaryInfo['bill_amount'];?></label>
                    </div>
                </div>
            </div>            
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">提现操作</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-group">
                        <input type="button" value="我要提现" class="btn btn-success" id="withdrawals"/>
                    </div>
                    <form role="form">
                        <table class="table table-bordered table-th-center table-th-bg-default">
                            <tbody>
                                <tr>
                                    <th>金额</th>
                                    <td>
                                        <input type="text" class="form-control" id="withdrawalsAmount" placeholder="金额(保留两位小数)" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>                                   
                    </form>
                </div>
            </div>         
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){        
        $('#withdrawals').click(function(){
            var amount = $("#withdrawalsAmount").val();
            if(amount.length < 1){
                alert('提现金额不能为空!');
                return false;
            }
            if(!confirm('您将进行' + amount + "元的提现操作,是否继续?")){
                return false;
            }
            $.ajax({
                url: "handler.html",  
                type: "POST",
                data:{
                    amount:amount
                },
                beforeSend: function(){
                    // 禁用按钮防止重复提交
                    $("#withdrawals").attr("disabled","disabled");
                },
                error: function(){  
                    alert('Error loading XML document');  
                },
                complete: function () {
                    $("#withdrawals").removeAttr("disabled");
                },
                success: function(data){
                    //如果调用php成功
                    var message = "";
                    if(data.status == "success"){
                        message = "提现操作成功"
                    }
                    if(data.status == "failure"){
                        message = data.message;
                    }
                    alert(message);
                }
            });
        });
    });
</script>
<?php $this->_endblock();