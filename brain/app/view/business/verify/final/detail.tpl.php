<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<?php 
    $user_id = getv_t('user_id');
    $userInfo = importModel('User')->getBy(array('id' => $user_id));
    $userInfoBase = importModel('User_Info_Base')->getBy(array('user_id' => $user_id));
    $userInfoEdu = importModel('User_Info_Edu')->getBy(array('user_id' => $user_id));
    $contactsList = importModel('User_Info_Contacts')->getList(array('condition' => array('user_id' => $user_id)));
    $userBankList = importModel('User_Info_Bank')->getList(array('condition' => array('user_id' => $user_id)));
    $photoList = importModel('User_Info_Photo')->getList(array('condition' => array('user_id' => $user_id)));    
?>
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
                <a href="">
                    <span>终审列表</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="">
                    <span>详情</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">审核操作</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-group">
                        <input type="button" value="加入黑名单" class="btn" />
                        <input type="button" value="审核通过" data-toggle="modal" data-target="#passModal" class="btn btn-success" />
                        <input type="button" value="驳回" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal" />
                    </div>
                    <form role="form">
                        <table class="table table-bordered table-th-center table-th-bg-default">
                            <tbody>
                                <tr>
                                    <th>金额</th>
                                    <td>
                                        <input type="text" class="btn btn-default" placeholder="终审金额"/>
                                        <span>元</span>
                                    </td>
                                    <td>
                                        <span>初审金额:</span>
                                        <span>4000元</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>意见</th>
                                    <td colspan="2">
                                        <textarea class="form-control" rows="3" placeholder="意见"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>                                   
                    </form>
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
                            <th>事件</th>
                            <th>操作人</th>
                            <th>备注</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>2015-09－22 23:17</td>
                            <td>申请</td>
                            <td>张XX</td>
                            <td>备注</td>
                          </tr>
                          <tr>
                            <td>2015-09－21 23:17</td>
                            <td>初审</td>
                            <td>赵XX</td>
                            <td>备注</td>
                          </tr>
                          <tr>
                            <td>2015-09－12 23:17</td>
                            <td>补件</td>
                            <td>李XX</td>
                            <td>备注</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">客户综合信息</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-th-center table-th-bg-default">
                        <tbody>
                            <tr>
                                <th>借款编号</th>
                                <td>23434654756</td>
                                <th>借款金额</th>
                                <td>5000</td>
                                <th>利率</th>
                                <td>0.0002/天</td>
                                <th>信用等级</th>
                                <td>C</td>
                            </tr>
                            <tr>
                                <th>借款方式</th>
                                <td>一次还款</td>
                                <th>借款时间</th>
                                <td>20天</td>
                                <th>申请次数</th>
                                <td>2</td>
                                <th>借款次数</th>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th>逾期次数</th>
                                <td>3</td>
                                <th>申请时间</th>
                                <td>2014-12-20</td>
                                <th>注册时间</th>
                                <td>2014-12-11</td>
                                <th>推荐码</th>
                                <td>华东小组</td>
                            </tr>
                            <tr>
                                <th>借款详情</th>
                                <td colspan="7">最近借款金额：3000，状态：借款中。目前欠款：1000元</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">基本信息/学校信息/联系人信息/银行信息</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
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
                            <td><input type="checkbox" /></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>手机号</th>
                            <td>
                                <?php 
                                    echo $userInfo["mobile_num"]
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>性别</th>
                            <td>
                                <?php
                                    echo $userInfoBase['gender']
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>籍贯</th>
                            <td>
                                <?php
                                    echo $userInfoBase['native_place'];
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>邮箱地址</th>
                            <td>
                                <?php
                                    echo $userInfoBase['email'];
                                ?>
                            </td>
                            <td><input type="checkbox" /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>家庭住址</th>
                            <td>
                                <?php
                                    echo $userInfoBase['home_address'];
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover">
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
                            <td><input type="checkbox" /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>入学时间</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['enroll_time'];
                                ?>
                            </td>
                            <td><input type="checkbox" /></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>学制</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['edu_length'];
                                ?>    
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>学历</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['edu_background'];
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>专业</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['major'];
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>楼栋宿舍号</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['dorm_num'] . "栋" . $userInfoEdu['room_num'] . "号";
                                ?>
                            </td>
                            <td><input type="checkbox"/></td>
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
                            <?php
                                $contactsHtml = "";
                                $familyRelation = "";
                                foreach ($contactsList as $contacts){
                                    if($contacts['type'] == 'family'){
                                        $familyRelation = $contacts["family_relation"];
                                    }else if($contacts['type'] == 'schoolmate'){
                                        $familyRelation = '同学';
                                    }else if($contacts['type'] == 'friend'){
                                        $familyRelation = '朋友';
                                    }else {
                                        $familyRelation = '室友';
                                    }
                                    $contactsHtml .= "<tr><th>" . $familyRelation . "</th>";
                                    $contactsHtml .= "<td>" . $contacts['name'] . "</td>";
                                    $contactsHtml .= "<td>" . $contacts['mobile_num'] . "</td>";
                                    $contactsHtml .= "<td><input type='checkbox'/></td><td></td></tr>";                                    
                                }
                                echo $contactsHtml;
                            ?>
                          </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-center">
                        <thead class="bg-default">
                          <tr>
                            <th>身份证</th>
                            <th>银行名称</th>
                            <th>开户所在省市</th>
                            <th>银行卡号</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                $userBankHtml = "";
                                foreach ($userBankList as $bankInfo){
                                    $userBankHtml .= "<tr><td>" . $bankInfo['holder_id_card'] . "</td>"
                                                  . "<td>".$bankInfo['bank_name']."</td>"
                                                  . "<td>".$bankInfo['opening_bank_name']."</td>"
                                                  . "<td>".$bankInfo['bank_card_number']."</td>"
                                                  . "<td><input type='checkbox'/></td>"
                                                  . "<td></td></tr>";
                                }
                                echo $userBankHtml;
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">认证信息</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-info table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息详情</th>
                            <th>状态</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th><span class="show-required">*</span>学信网</th>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-sm-3">
                                        <img data-src="" class="img-thumbnail" alt="130x80" 
                                         src="" 
                                         data-holder-rendered="true" style="width:130px;height:80px;" />
                                    </div>
                                    <div class="col-sm-3">
                                        <img data-src="" class="img-thumbnail" alt="130x80" 
                                         src="http://image.tianjimedia.com/uploadImages/2014/016/0EK18083OW6A.jpg" 
                                         data-holder-rendered="true" style="width:130px;height:80px;" />
                                    </div>
                                    <div class="col-sm-3">
                                        <img data-src="" class="img-thumbnail" alt="130x80" 
                                         src="" 
                                         data-holder-rendered="true" style="width:130px;height:80px;" />
                                    </div>
                                </div>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>学生证</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>身份证</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>户口簿</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>本人行驶证</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th>银行卡流水</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>支付宝流水</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>家长身份证认证</th>
                            <td>
                                <div class="container-fluid">
                                    <div class="col-sm-3">
                                        <img data-src="" class="img-thumbnail" alt="130x80" 
                                         src="" data-holder-rendered="true" />
                                    </div>
                                    <div class="col-sm-3">
                                        <img data-src="" class="img-thumbnail" alt="130x80" 
                                         src="http://h.hiphotos.baidu.com/image/pic/item/4ec2d5628535e5dd2820232370c6a7efce1b623a.jpg" 
                                         data-holder-rendered="true" style="width:130px;height:80px;" />
                                    </div>
                                    <div class="col-sm-3">
                                        <img data-src="" class="img-thumbnail" alt="130x80" 
                                         src="http://image.tianjimedia.com/uploadImages/2014/084/26/2C0SQOI0H8CM_1000x500.jpg" 
                                         data-holder-rendered="true" style="width:130px;height:80px;" />
                                    </div>
                                </div>
                            </td>
                            <td><input type="checkbox"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>室友身份证认证</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>室友学生证认证</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th><span class="show-required">*</span>获奖证明</th>
                            <td></td>
                            <td><input type="checkbox"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th>社保卡</th>
                            <td></td>
                            <td><input type="checkbox" value="2"/></td>
                            <td>信息有误</td>
                          </tr>
                          <tr>
                            <th>信用卡</th>
                            <td></td>
                            <td><input type="checkbox" value="1"/></td>
                            <td>信息有误</td>
                          </tr>
                          <?php
                            $imgHost = C('img_host');
                            $infoDetail = "";
                            $AuthenticationHtml = "";
                            foreach ($photoList as $photo){
                                $imgUrl = "http://{$imgHost}/image/user_info/width_480/".intval($user_id/5000).'/'.$photo['hash'].".jpg";
                                if($photo['type'] == "personal"){
                                    $infoDetail = "个人审核照";
                                }else if($photo['type'] == "id_card_a"){
                                    $infoDetail = "身份证正面";
                                }else if($photo['type'] == "id_card_b"){
                                    $infoDetail = "身份证反面";
                                }else if($photo['type'] == "student_id_card"){
                                    $infoDetail = "学生证";
                                }else if($photo['type'] == "campus_one_card"){
                                    $infoDetail = "校园一卡通";
                                }else if($photo['type'] == "residence_booklet"){
                                    $infoDetail = "户口簿";
                                }else if($photo['type'] == "driver_license"){
                                    $infoDetail = "驾照";
                                }else if($photo['type'] == "bank_statement"){
                                    $infoDetail = "银行流水";
                                }else if($photo['type'] == "alipay_statement"){
                                    $infoDetail = "支付宝流水";
                                }else if($photo['type'] == "parent_id_card"){
                                    $infoDetail = "家长身份证";
                                }else if($photo['type'] == "roommate_id_card"){
                                    $infoDetail = "室友身份证";
                                }else if($photo['type'] == "award_cert"){
                                    $infoDetail = "获奖证明";
                                }else if($photo['type'] == "ss_card"){
                                    $infoDetail = "社保卡";
                                }else if($photo['type'] == "credit_card"){
                                    $infoDetail = "信用卡";
                                }
                                $AuthenticationHtml .= "<tr><th>".$infoDetail."</th>"
                                             . "<td><div class='container-fluid'><div class='col-sm-3'>"
                                             . "<img class='img-thumbnail img-thumbnail-size' src='".$imgUrl."' data-holder-rendered='true' />"
                                             . "</div></div></td>"
                                             . "<td><input type='checkbox'/></td>"
                                             . "<td></td></tr>";
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
<!-- rejectModal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="rejectModalLabel">驳回</h4>
        </div>
        <div class="modal-body">
            <textarea rows="6" class="form-control" placeholder="驳回理由..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">驳回</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>

<!-- passModal -->
<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="passModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="passModalLabel">审核通过</h4>
        </div>
        <div class="modal-body">
            <div class="well well-lg text-center">
                此条审核通过
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">确认</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>
        
<!-- rfeModal -->
<div class="modal fade" id="rfeModal" tabindex="-1" role="dialog" aria-labelledby="rfeModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="rfeModalLabel">补件</h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        订单处于补件中状态，补件项目如下：
                    </h3>
                </div>
                <div class="panel-body" id="rfeProjectNames">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">补件</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
</div>

<!-- imageModal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="imageModalLabel">大图</h4>
          <button type="button" class="btn btn-primary btn-xs" id="changImgDirection">旋转</button>
        </div>
        <div class="modal-body">
            <img src="" alt="" class="img-responsive" id="showBigImage" style="width:100%;height:260px;"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
        </div>
      </div>
    </div>
</div>        
<script type="text/javascript">
    $(document).ready(function(){
        var img = $('#showBigImage');
        var time = 1;   //记录旋转的次数
        $("input[type=checkbox]").click(function(){
            var thisCheckBox = $(this);
            if(thisCheckBox.is(':checked')){
                thisCheckBox.parent().parent().addClass("bg-warning");
            }else{
                thisCheckBox.parent().parent().removeClass("bg-warning");
            }
        });
        $("img.img-thumbnail").each(function(){
            $(this).css('cursor','pointer').attr('data-toggle',"modal");
        });
        $("img.img-thumbnail").click(function(){
            time = 1;
            img.css('transform','rotate(0deg)');
            var imgSrc = $(this).attr("src");
            if(imgSrc.length > 0){
                $("#showBigImage").attr('src',imgSrc);
                $("#imageModal").modal('toggle');
            }
        });
        
        $("#changImgDirection").on('click',function(){
                time = time%4;
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
        
        
        
        
        
        
        
        
        
    });
</script>
<?php $this->_endblock(); ?>