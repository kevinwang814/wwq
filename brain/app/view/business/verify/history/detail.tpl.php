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
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="#">
                    <span>借款审核</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="/business/verify/history/list.html">
                    <span>历史审核列表</span>
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
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">客户综合信息</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-th-center table-th-bg-default">
                        <tbody>
                            <tr>
                                <th>注册手机号</th>
                                <td>
                                    <?php 
                                        echo $userInfo['mobile_num']
                                    ?>
                                </td>
                                <th>注册手机平台</th>
                                <td>
                                    <?php 
                                        echo $userInfo['platform']
                                    ?>
                                </td>
                                <th>注册手机版本</th>
                                <td>
                                    <?php 
                                        echo $userInfo['app_version']
                                    ?>
                                </td>
                                <th>注册手机imei</th>
                                <td>
                                    <?php 
                                        echo $userInfo['imei']
                                    ?>
                                </td>                                
                            </tr>                            
                            <tr>
                                <th>借款编号</th>
                                <td>
                                    <?php
                                        echo $order['show_order_id'];
                                    ?>
                                </td>
                                <th>借款金额</th>
                                <td>
                                    <?php
                                        echo $order['apply_money'];
                                    ?>
                                </td>
                                <th>利率</th>
                                <td>
                                    <?php
                                        echo $order['interest_rate'].'/天';
                                    ?>
                                </td>
                                <th>信用等级</th>
                                <td><?php echo $order['credit_level'];?></td>
                            </tr>
                            <tr>
                                <th>借款方式</th>
                                <td><?php echo $order['loan_way'];?></td>
                                <th>借款时间</th>
                                <td><?php echo $order['duration'];?></td>
                                <th>申请次数</th>
                                <td></td>
                                <th>借款次数</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>逾期次数</th>
                                <td></td>
                                <th>申请时间</th>
                                <td><?php echo $order['apply_time'];?></td>
                                <th>注册时间</th>
                                <td><?php echo $order['register_date'];?></td>
                                <th>优惠码</th>
                                <td><?php echo $order['promotion_code']?></td>
                            </tr>
                            <tr>
                                <th>订单来源城市</th>
                                <td><?php echo $geographyInfo['city']?></td>
                                <th>补件次数</th>
                                <td><?php echo $order['rfe_count'];?></td>                                
                                <th>借款详情</th>
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>            
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">审核状态</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-condensed table-center">
                        <thead>
                          <tr>
                            <th>时间</th>
                            <th>状态</th>
                            <th>操作人</th>
                            <th>备注</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($ticketList) && is_array($ticketList)):?>
                                <?php foreach($ticketList as $ticket):?>
                                    <tr>
                                        <td><?php echo $ticket['create_time'] ?></td>
                                        <td><?php echo $ticket['resultCh'] ?></td>
                                        <td><?php echo $ticket['operator'] ?></td>
                                        <td><?php echo $ticket['remark'] ?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">基本信息/学校信息/联系人信息/银行信息</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-td-center">
                        <thead class="bg-default table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息详情</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th><span class="show-required">*</span>姓名</th>
                            <td>
                                <?php 
                                    echo $userInfoBase['name']
                                ?>
                            </td>
                            <td><input type="checkbox" value="name"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>身份证号</th>
                            <td>
                                <?php 
                                    echo $userInfoBase['identity_card']
                                ?>
                            </td>
                            <td><input type="checkbox" value="identity_card"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>性别</th>
                            <td>
                                <?php
                                    echo $userInfoBase['gender']
                                ?>
                            </td>
                            <td><input type="checkbox" value="gender"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>邮箱地址</th>
                            <td>
                                <?php
                                    echo $userInfoBase['email'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="email"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>家庭住址</th>
                            <td>
                                <?php
                                    echo $userInfoBase['home_address'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="home_address"/></td>
                            <td></td>
                          </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-td-center">
                        <thead class="bg-default table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息详情</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th><span class="show-required">*</span>学校名称</th>
                            <td>
                                <?php 
                                    echo $userInfoEdu['college'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="college"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>入学时间</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['enroll_time'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="enroll_time"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>学制</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['edu_length'];
                                ?>    
                            </td>
                            <td><input type="checkbox" value="edu_length"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>学历</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['edu_background'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="edu_background"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>专业</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['major'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="major"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>楼栋号</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['dorm_num'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="dorm_num"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>宿舍号</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['room_num'];
                                ?>
                            </td>
                            <td><input type="checkbox" value="room_num"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>学信网账号密码</th>
                            <td>
                                账号:<?php echo $userInfoEdu['chis_name'];?><br />
                                密码:<?php echo $userInfoEdu['chis_psd'];?>
                            </td>
                            <td><input type="checkbox" value="chis_name_psd"/></td>
                            <td></td>
                          </tr>                        
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-center">
                        <thead class="bg-default">
                          <tr>
                            <th>关系情况</th>
                            <th>联系人姓名</th>
                            <th>联系人电话</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($contactsList) && is_array($contactsList)):?>
                                <?php foreach($contactsList as $contacts):?>
                                    <tr>
                                        <th><?php echo $contacts['family_relation'] ?></th>
                                        <td><?php echo $contacts['name'] ?></td>
                                        <td>
                                            <?php echo $contacts['mobile_num'] ?>
                                        </td>
                                        <td>
                                            <input type='checkbox' value="<?php echo $contacts['type'] ?>"/>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-td-center">
                        <thead class="bg-default table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息内容</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th><span class="show-required">*</span>身份证</th>
                            <td><?php echo $userBankInfo['holder_id_card']?></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>银行名称</th>
                            <td><?php echo $userBankInfo['bank_name']?></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>开户支行</th>
                            <td><?php echo $userBankInfo['opening_bank_name']?></td>
                            <td><input type="checkbox" value="opening_bank_name"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>银行卡号</th>
                            <td><?php echo $userBankInfo['bank_card_number']?></td>
                            <td><input type="checkbox" value="bank_card_number"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>预留手机号</th>
                            <td><?php echo $userBankInfo['holder_mobile_num']?></td>
                            <td><input type="checkbox" value="holder_mobile_num"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>三方验证状态</th>
                            <td><?php echo $userBankInfo['bind_status_ch']?></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <?php if($userBankInfo['bank_card_a']):?>
                            <tr>
                              <th>银行卡正面图</th>
                              <td>
                                <div class='container-fluid'>
                                    <div class='col-sm-3'>
                                        <img class='img-thumbnail' src='<?php echo $userBankInfo['bank_card_a']?>' data-holder-rendered='true' />
                                    </div>
                                </div>
                              </td>
                              <td><input type="checkbox" value="bank_card_a"/></td>
                              <td></td>
                            </tr>
                          <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">认证信息</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-center">
                        <thead class="bg-info table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息详情</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $imgHost = C('img_host');
                                $AuthenticationHtml = "";
                                if(isset($photoList) && is_array($photoList)){
                                    foreach ($photoList as $photo){
                                        if($photo['type'] == 'video'){
                                            $AuthenticationHtml .= "<tr><th>".$photo['infoDetail']."</th>"
                                                         . "<td><div class='container-fluid'><div class='col-sm-3'>"
                                                         . "<img class='img-thumbnail' src='".$photo['imgUrl']."' data-holder-rendered='true' video-url='" . $photo['videoUrl'] ."'/>"
                                                         . "</div></div></td>"
                                                         . "<td><input type='checkbox' value='" . $photo['type'] . "' /></td>"
                                                         . "<td></td></tr>";
                                        }else{
                                            $imgUrl = "http://{$imgHost}/image/user_info/width_480/".intval($userInfo['id']/5000).'/'.$photo['hash'].".jpg";
                                            $AuthenticationHtml .= "<tr><th>".$photo['infoDetail']."</th>"
                                                         . "<td><div class='container-fluid'><div class='col-sm-3'>"
                                                         . "<img class='img-thumbnail' src='".$imgUrl."' data-holder-rendered='true' />"
                                                         . "</div></div></td>"
                                                         . "<td><input type='checkbox' value='" . $photo['type'] . "' /></td>"
                                                         . "<td></td></tr>";   
                                        }
                                    }
                                }
                                echo $AuthenticationHtml;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<!-- imageModal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="imageModalLabel">查看大图</h4>
          <button type='button' class='btn btn-primary btn-xs' id='changImgDirection'>旋转</button>          
        </div>
        <div class="modal-body" id="showBigImage" >
            <img src="" alt="" class="img-responsive element-center"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
        </div>
      </div>
    </div>
</div>        
<script type="text/javascript">
    $(document).ready(function(){
        $("img.img-thumbnail").each(function(){
            $(this).css('cursor','pointer').attr('data-toggle',"modal");
        });
        $("img.img-thumbnail").click(function(){
            var hasVideoSrc = $(this).attr("video-url");
            if(hasVideoSrc){
                var videoHtml = "<video src='"+hasVideoSrc+"' controls='controls' class='img-responsive element-center'>"
                              + "your browser does not support the video</video>";
                $('#showBigImage').html(videoHtml);
                $("#changImgDirection").css('display','none');
            }else{
                var imageHtml = "<img src='' alt='' class='img-responsive element-center'/>";
                $('#showBigImage').html(imageHtml);
                var img = $('#showBigImage img');
                var imgSrc = $(this).attr("src");
                if(imgSrc.length > 0){
                    img.attr('src',imgSrc);
                }
                $("#changImgDirection").css('display','');
                var time = 1;
                $("#changImgDirection").on('click',function(){           
                    time = time%4;
                    var img = $('#showBigImage img');
                    switch(time){
                        case 0:
                            img.css('transform','rotate(0deg)');
                            break;
                        case 1:
                            img.css('transform','rotate(90deg)');
                            break;
                        case 2:
                            img.css('transform','rotate(180deg)');
                            break;
                        case 3:
                            img.css('transform','rotate(270deg)');
                            break;
                    }
                    time ++;
                });
            }
            $("#imageModal").modal('toggle');
        });
    });
</script>
<?php $this->_endblock();