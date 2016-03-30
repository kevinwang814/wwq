<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="#">
                    <span class="glyphicon glyphicon-book"></span>
                    <span>用户管理</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a href="/user/list.html">
                    <span>客户列表</span>
                    <span class="glyphicon glyphicon-menu-right font-size-10"></span>
                </a>
                <a>
                    <span>详情</span>
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
                                <th>逾期次数</th>
                                <td></td>
                                <th>申请次数</th>
                                <td><?php echo $userInfo['apply_count'];?></td>
                                <th>注册时间</th>
                                <td><?php echo $userInfo['create_time'];?></td>
                                <th>邀请码</th>
                                <td><?php echo $userInfo['invite_code']?></td>
                            </tr>
                            <tr>
                                <th>订单来源城市</th>
                                <td><?php echo $geographyInfo['city']?></td>
                                <th>订单来源区域</th>
                                <td><?php echo $geographyInfo['district']?></td>                              
                                <th>借款详情</th>
                                <td colspan="5"></td>
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
                    <table class="table table-bordered table-hover table-td-center">
                        <thead class="bg-default table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息详情</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>姓名</th>
                            <td>
                                <?php 
                                    echo $userInfoBase['name']
                                ?>
                            </td>                            
                            <td></td>
                          </tr>
                          <tr>
                            <th>身份证号</th>
                            <td>
                                <?php 
                                    echo $userInfoBase['identity_card']
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>性别</th>
                            <td>
                                <?php
                                    echo $userInfoBase['gender']
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>邮箱地址</th>
                            <td>
                                <?php
                                    echo $userInfoBase['email'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>家庭住址</th>
                            <td>
                                <?php
                                    echo $userInfoBase['home_address'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-td-center">
                        <thead class="bg-default table-th-center">
                          <tr>
                            <th>信息</th>
                            <th>信息详情</th>
                            <th>状态详情</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>学校名称</th>
                            <td>
                                <?php 
                                    echo $userInfoEdu['college'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>入学时间</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['enroll_time'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>学制</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['edu_length'];
                                ?>    
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>学历</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['edu_background'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>专业</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['major'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>楼栋号</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['dorm_num'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>宿舍号</th>
                            <td>
                                <?php
                                    echo $userInfoEdu['room_num'];
                                ?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>学信网账号密码</th>
                            <td>
                                账号:<?php echo $userInfoEdu['chis_name'];?><br />
                                密码:<?php echo $userInfoEdu['chis_psd'];?>
                            </td>
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
                                        <td></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-td-center">
                        <thead class="bg-default table-th-center">
                          <tr>
                            <th>身份证</th>
                            <th>银行名称</th>
                            <th>开户支行</th>
                            <th>银行卡号</th>
                            <th>预留手机号</th>
                            <th>是否可验证</th>
                            <th>三方验证状态</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($userBankInfoList) && is_array($userBankInfoList)):?>
                                <?php foreach($userBankInfoList as $userBankInfo):?>
                                    <tr>
                                        <td><?php echo $userBankInfo['holder_id_card'] ?></td>
                                        <td><?php echo $userBankInfo['bank_name'] ?></td>
                                        <td><?php echo $userBankInfo['opening_bank_name'] ?></td>
                                        <td><?php echo $userBankInfo['holder_mobile_num'] ?></td>
                                        <td><?php echo $userBankInfo['bank_card_number'] ?></td>
                                        <td><?php echo $userBankInfo['verifiable'] == 0 ? "否" : "是" ?></td>                                        
                                        <td><?php echo $userBankInfo['bind_status_ch'] ?></td>
                                    </tr>
                                <?php endforeach;?>
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
          <button type="button" class="btn btn-primary btn-xs" id="changImgDirection">旋转</button>
        </div>
        <div class="modal-body" id="showBigImage">           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
        </div>
      </div>
    </div>
</div>
<link href="/vendor/video-js-5.8.0/video-js.min.css" rel="stylesheet" type="text/css"/>
<script src="/vendor/video-js-5.8.0/video.min.js" type="text/javascript"></script>
<script src="/vendor/video-js-5.8.0/videojs-contrib-hls.min.js" type="text/javascript"></script>
<script src="/dist/js/view-image.js" type="text/javascript"></script>
<?php $this->_endblock();