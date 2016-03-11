<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>

<?php $this->_element('header'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div id="slide_nav">
            <ul class="nav list-group bs_list_group">
                <li>
                    <a href="#t_api_zongshu">API 综述</a>
                    <ul class='nav list-group'>
                        <li><a href="#t_api_zongshu_server">接口环境</a></li>
                        <li><a href="#t_api_zongshu_secret_key">获取user_id、secret_key</a></li>
                        <li><a href="#t_api_zongshu_sign">签名过程</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#t_api_doc_user">用户 API</a>
                    <ul class='nav list-group'>
                        <li><a href="#t_api_doc_user_captcha">user.captcha</a></li>
                        <li><a href="#t_api_doc_user_reg">user.reg</a></li>
                        <li><a href="#t_api_doc_user_login">user.login</a></li>
                        <li><a href="#t_api_doc_user_resetpwd">user.resetpwd</a></li>
                        <li><a href="#t_api_doc_user_info_base_save">user.info.base.save</a></li>
                        <li><a href="#t_api_doc_user_info_base_get">user.info.base.get</a></li>
                        <li><a href="#t_api_doc_user_info_edu_save">user.info.edu.save</a></li>
                        <li><a href="#t_api_doc_user_info_edu_get">user.info.edu.get</a></li>
                        <li><a href="#t_api_doc_user_info_contacts_save">user.info.contacts.save</a></li>
                        <li><a href="#t_api_doc_user_info_contacts_get">user.info.contacts.get</a></li>
                        <li><a href="#t_api_doc_user_info_photo_save">user.info.photo.save</a></li>
                        <li><a href="#t_api_doc_user_info_photo_get">user.info.photo.get</a></li>
                        <li><a href="#t_api_doc_user_info_bank_save">user.info.bank.save</a></li>
                        <li><a href="#t_api_doc_user_info_bank_get">user.info.bank.get</a></li>
                        <li><a href="#t_api_doc_user_info_bank_delete">user.info.bank.delete</a></li>
                        <li><a href="#t_api_doc_user_info_bank_update">user.info.bank.update</a></li>
                        <li><a href="#t_api_doc_user_info_bank_verify">user.info.bank.verify</a></li>
                        <li><a href="#t_api_doc_user_info_bank_rebind">user.info.bank.rebind</a></li>                        
                        <li><a href="#t_api_doc_user_info_borrowing_get">user.info.borrowing.get</a></li>
                        <li><a href="#t_api_doc_user_info_get">user.info.get</a></li>
                        <li><a href="#t_api_doc_user_info_shipaddress_get">user.info.shipaddress.get</a></li>
                        <li><a href="#t_api_doc_user_info_shipaddress_save">user.info.shipaddress.save</a></li>
                        <li><a href="#t_api_doc_user_info_coin_get">user.info.coin.get</a></li>                        
                        <li><a href="#t_api_doc_user_info_goods_list">user.info.goods.list</a></li>
                        <li><a href="#t_api_doc_user_info_geography_update">user.info.geography.update</a></li>
                        <li><a href="#t_api_doc_user_info_third_save">user.info.third.save</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#t_api_doc_borrowing">借/还款 API</a>
                    <ul class='nav list-group'>
                        <li><a href="#t_api_doc_borrowing_order_preview">borrowing.order.preview</a></li>
                        <li><a href="#t_api_doc_borrowing_order_submit">borrowing.order.submit</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#t_api_doc_sx">随学 API</a>
                </li>
                <li>
                    <a href="#t_api_doc_misc">杂项 API</a>
                    <ul class='nav list-group'>
                        <li><a href="#t_api_doc_bank_get">bank.get</a></li>
                        <li><a href="#t_api_doc_misc_check">misc.check</a></li>
                        <li><a href="#t_api_doc_banner_get">banner.get</a></li>                        
                    </ul>
                </li>
                <li>
                    <a href="#t_api_doc_bind">联动优势相关 API</a>
                    <ul class='nav list-group'>
                        <li><a href="#t_api_doc_user_info_bank_bind">bank.bind</a></li>
                        <li><a href="#t_api_doc_bill_repay">bill.repay</a></li>
                        <li><a href="#t_api_doc_user_info_balance_get">user.info.balance.get</a></li>
                        <li><a href="#t_api_doc_user_info_balance_repay">user.info.balance.repay</a></li>
                        <li><a href="#t_api_doc_user_info_balance_withdrawals">user.info.balance.withdrawals</a></li>
                        <li><a href="#t_api_doc_user_resetutpwd">user.resetutpwd</a></li>                        
                    </ul>
                </li>
                <li>
                    <a href="#t_api_doc_goods">商品抢购相关 API</a>
                    <ul class='nav list-group'>
                        <li><a href="#t_api_doc_goods_preiod_get">goods.preiod.get</a></li>
                        <li><a href="#t_api_doc_goods_preiod_detail">goods.preiod.detail</a></li>
                        <li><a href="#t_api_doc_goods_preiod_exchange">goods.preiod.exchange</a></li>                        
                    </ul>
                </li>                
            </ul>
            </div>
        </div>
        <div class="col-md-9 docs_main">
            <h1 id='t_api_zongshu'>API综述(更新时间: 2015.12.14)</h1>

            <h2 id='t_api_zongshu_server'>接口环境</h2>
            <p>测试环境：<a href="http://test.api.suifenqi.cn" target="_blank">http://test.api.suifenqi.cn</a></p>
            <p>预发布环境：<a href="http://pre.api.suifenqi.cn" target="_blank">http://pre.api.suifenqi.cn</a> (暂未开通)</p>
            <p>正式环境：<a href="http://api.suifenqi.cn" target="_blank">http://api.suifenqi.cn</a> (暂未开通)</p>
            
            <h2 id='t_api_zongshu_secret_key'>获取user_id、secret_key</h2>
            <p>调用user.login接口获取，获取后保存于客户端本地，需要签名时使用</p>
            
            <h2 id='t_api_zongshu_sign'>签名过程</h2>
            <p>在调用需要签名的接口时，需要同时传入两个参数：user_id、sign (使用 secret_key 签名后获得)</p>
            <p>签名过程如下:</p>
            <ol>
                <li>把所有参数作为一个数组 A，按照数组键值的字母升序排列。获得一个新数组 B。(<font style="color:red">注意：参数mod不参与签名</font>)</li>
                <li>把数组 B 按照'key1value1key2value2...'排列。变成一个字符串 C。</li>
                <li>在字符串 C 结尾加上 secret_key。</li>
                <li>对字符串进行 MD5 计算，结果以小写表示。</li>
            </ol>
            <p>代码示例:</p>
            <div class='highlight'>
                <pre>
                    <code class='php'>
    $secret_key = 'axc234dafd';
    
    $params = array(
        'user_id'    =>  123,
        'mobile_num' =>  '15110000435',
        'borrowing'  =>  5000
    );
    
    ksort($params);  #按键名升序对数组进行排序
    
    $paramString = '';
    foreach($params as $key => $value){
        $paramString .= "{$key}{$value}";
    }

    $sign = md5($paramString . $secret_key);
                    </code>
                </pre>
            </div>
            
            
            <h1 id="t_api_doc_user">用户API</h1>
            
            <h3 id="t_api_doc_user_captcha">user.captcha</h3>
            <p><span class="label label-success">POST</span><span class="label label-success">不需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.captcha</p>
            <p>发送短信验证码。验证码的有效时间为30分钟，并在验证成功后失效</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>接收验证码的手机号</td>
                        <td>11位手机号码</td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }
                    </code>
                </pre>
            </div>
            
            
        <h3 id="t_api_doc_user_reg">user.reg</h3>
            
            <p><span class="label label-success">POST</span><span class="label label-success">不需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.reg</p>
            <p>用户注册</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>注册手机号</td>
                        <td>11位手机号码</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>注册密码</td>
                        <td>密码长度范围：6-16位字符之间</td>
                    </tr>
                    <tr>
                        <td>captcha</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>短信验证码</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>platform</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>平台信息</td>
                        <td>iOS，Android</td>
                    </tr>
                    <tr>
                        <td>app_version</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>客户端版本号</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>invite_code</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>注册邀请码</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>device_token</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>iOS平台的device token信息</td>
                        <td>用于消息推送</td>
                    </tr>
                </tbody>
            </table>
            
            <p>返回结果格式(json)：</p>

            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status    = "success" | "failure"
        message   = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "user_id": "123", 
            "secret_key": "VQeum0GrnFfOUpFk9wMjtVWLHeNvlDN8jSrvRXN6rSIa9dl7AYeTJ1uf68BgAecJ"
        }
    }                 
                    </code>
                </pre>
            </div>
            
            <p>接口数据说明：</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>user_id</td>
                        <td>用户id</td>
                        <td>用户的唯一标识id</td>
                    </tr>
                    <tr>
                        <td>secret_key</td>
                        <td>密钥</td>
                        <td>与用户相关联的密钥，接口签名时使用</td>
                    </tr>
                </tbody>
            </table>
            
            
            <h3 id="t_api_doc_user_login">user.login</h3>
            <p><span class="label label-success">POST</span><span class="label label-success">不需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.login</p>
            <p>用户登录。登录成功返回用户相关信息。<font style="color:red">注意：每次登录成功会更新secret_key，用于帐号登录互斥，新的secret_key随用户信息返回</font></p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>注册手机号</td>
                        <td>11位手机号码</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>登录密码</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "user_id": "123", 
            "secret_key": "VQeum0GrnFfOUpFk9wMjtVWLHeNvlDN8jSrvRXN6rSIa9dl7AYeTJ1uf68BgAecJ",
            "invite_code": "123456"
        }
    }
                    </code>
                </pre>
            </div>
            
            <p>接口数据说明：</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>user_id</td>
                        <td>用户id</td>
                        <td>用户的唯一标识id</td>
                    </tr>
                    <tr>
                        <td>secret_key</td>
                        <td>密钥</td>
                        <td>与用户相关联的密钥，接口签名时使用</td>
                    </tr>
                </tbody>
            </table>
            
            
            
            <h3 id="t_api_doc_user_resetpwd">user.resetpwd</h3>
            <p><span class="label label-success">POST</span><span class="label label-success">不需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.resetpwd</p>
            <p>重置用户密码(<font style="color:red">该用户的secret_key也会一起被重置</font>)</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>注册手机号</td>
                        <td>11位手机号码</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>新密码</td>
                        <td>密码长度范围：6-16位字符之间</td>
                    </tr>
                    <tr>
                        <td>captcha</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>短信验证码</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }
                    </code>
                </pre>
            </div>
         
            <!-- 保存用户基本信息 -->
            <h3 id="t_api_doc_user_info_base_save">user.info.base.save</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.base.save</p>
            <p>保存用户基本信息</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>name</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>姓名</td>
                        <td>用户真实姓名</td>
                    </tr>
                    <tr>
                        <td>gender</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>性别</td>
                        <td>可选范围：男、女</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>邮箱地址</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>native_place</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>籍贯</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>home_address</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>家庭地址</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <p>返回结果格式(json)：</p>

            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status    = "success" | "failure"
        message   = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }                 
                    </code>
                </pre>
            </div>
            
            <!-- 获取用户基本信息 -->
            <h3 id="t_api_doc_user_info_base_get">user.info.base.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.base.get</p>
            <p>获取用户基本信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "name": "周杰伦", 
            "gender": "男",
            "email": "jay@gmail.com", 
            "native_place": "上海",
            "home_address": "上海市浦东新区福州路258弄9号"
        }
    }
                    </code>
                </pre>
            </div>
            
        
            <!-- 保存用户教育信息 -->
            <h3 id="t_api_doc_user_info_edu_save">user.info.edu.save</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.edu.save</p>
            <p>保存用户教育信息</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>college</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>学校</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>edu_background</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>学历</td>
                        <td>可选范围：大专、本科、研究生、博士</td>
                    </tr>
                    <tr>
                        <td>edu_length</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>学制</td>
                        <td>3-10年</td>
                    </tr>
                    <tr>
                        <td>enroll_time</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>入学时间</td>
                        <td>日期格式</td>
                    </tr>
                    <tr>
                        <td>major</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>专业</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>dorm_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>宿舍号</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>room_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>房间号</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <p>返回结果格式(json)：</p>

            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status    = "success" | "failure"
        message   = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }                 
                    </code>
                </pre>
            </div>
            
            <!-- 获取用户教育信息 -->
            <h3 id="t_api_doc_user_info_edu_get">user.info.edu.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.edu.get</p>
            <p>获取用户基本信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "college": "上海戏剧学院", 
            "edu_background": "本科", 
            "edu_length": "4",
            "enroll_time": "2012-09-01",
            "major": "表演艺术",
            "dorm_num": "男生宿舍1栋",
            "room_num": "808"
        }
    }
                    </code>
                </pre>
            </div>
            
            
            <!-- 保存用户联系人信息 -->
            <h3 id="t_api_doc_user_info_contacts_save">user.info.contacts.save</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.contacts.save</p>
            <p>保存用户联系人信息</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>family</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>亲属</td>
                        <td>格式(json): {"name":"周杰伦1","mobile_num":"15118888999","relation":"弟弟"}</td>
                    </tr>
                    <tr>
                        <td>schoolmate</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>同学</td>
                        <td>格式(json): {"name":"周杰伦2","mobile_num":"15118888999"}</td>
                    </tr>
                    <tr>
                        <td>friend</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>朋友</td>
                        <td>格式(json): {"name":"周杰伦3","mobile_num":"15118888999"}</td>
                    </tr>
                    <tr>
                        <td>roommate</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>室友</td>
                        <td>格式(json): {"name":"周杰伦4","mobile_num":"15118888999"}</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <p>返回结果格式(json)：</p>

            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status    = "success" | "failure"
        message   = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }                 
                    </code>
                </pre>
            </div>
            
            <!-- 获取用户联系人信息 -->
            <h3 id="t_api_doc_user_info_contacts_get">user.info.contacts.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.contacts.get</p>
            <p>获取用户联系人信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "family":
            {
                "name": "周杰伦1",
                "mobile_num": "15118888999",
                "relation":  "弟弟"
            },
            "schoolmate":
            {
                "name": "周杰伦2",
                "mobile_num": "15118888999",
            },
            "friend":
            {
                "name": "周杰伦3",
                "mobile_num": "15118888999",
            },
            "roommate":
            {
                "name": "周杰伦4",
                "mobile_num": "15118888999",
            }  
        }
    }
                    </code>
                </pre>
            </div>
            
        
            <!-- 保存用户照片信息 -->
            <h3 id="t_api_doc_user_info_photo_save">user.info.photo.save</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.photo.save</p>
            <p>保存用户照片信息</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th width="60%">备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>photo_type</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>照片类型</td>
                        <td>可选范围：personal (个人审核照)，id_card_a (身份证正面)，id_card_b (身份证反面)，student_id_card (学生证)，
                            campus_one_card (校园一卡通)，residence_booklet(户口簿)，driver_license(驾照)，bank_statement(银行流水)，
                            alipay_statement(支付宝流水)，parent_id_card(家长身份证)，roommate_id_card(室友身份证)，award_cert(获奖证明)，
                            ss_card(社保卡)，credit_card(信用卡)
                        </td>
                    </tr>
                    <tr>
                        <td>user_info_photo</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>照片文件</td>
                        <td><font style="color:red">该参数不参与签名</font></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <p>返回结果格式(json)：</p>

            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status    = "success" | "failure"
        message   = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }                 
                    </code>
                </pre>
            </div>
            
            <!-- 获取用户照片信息 -->
            <h3 id="t_api_doc_user_info_photo_get">user.info.photo.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.photo.get</p>
            <p>获取用户照片信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "personal":
            {
                "img_url": "http://test.common.suifenqi.me:8887/image/user_info/width_480/0/d5c79e7cfd222cf9bd2d705a0b8b33b1.jpg"
            },
            "id_card_a":
            {
                "img_url": "http://test.common.suifenqi.me:8887/image/user_info/width_480/0/d5c79e7cfd222cf9bd2d705a0b8b33b1.jpg"
            },
            "id_card_b":
            {
                "img_url": "http://test.common.suifenqi.me:8887/image/user_info/width_480/0/d5c79e7cfd222cf9bd2d705a0b8b33b1.jpg"
            },
            "student_id_card":
            {
                "img_url": "http://test.common.suifenqi.me:8887/image/user_info/width_480/0/d5c79e7cfd222cf9bd2d705a0b8b33b1.jpg"
            },
            "campus_one_card":
            {
                "img_url": "http://test.common.suifenqi.me:8887/image/user_info/width_480/0/d5c79e7cfd222cf9bd2d705a0b8b33b1.jpg"
            }
        }
    }
                    </code>
                </pre>
            </div>
            
          
            <!-- 保存用户银行信息 -->
            <h3 id="t_api_doc_user_info_bank_save">user.info.bank.save</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.save</p>
            <p>保存用户银行信息，实际上就是绑定用户的银行卡，通过第三方验证后保存</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行id</td>
                        <td>可选的银行id，通过<a href="#t_api_doc_bank_get">bank.get</a>接口获取</td>
                    </tr>
                    <tr>
                        <td>bank_card_number</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行卡号</td>
                        <td>通过第三方接口验证通过，与所属银行id相匹配的银行卡号</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <p>返回结果格式(json)：</p>

            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status    = "success" | "failure"
        message   = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }                 
                    </code>
                </pre>
            </div>
            
            <!-- 获取用户银行信息 -->
            <h3 id="t_api_doc_user_info_bank_get">user.info.bank.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.get</p>
            <p>获取用户银行信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "bank_list":
            [
                {
                    "user_bank_id": "7",
                    "bank_name": "工商银行",
                    "bank_card_number": "41512313531634"
                },
                {
                    "user_bank_id": "8",
                    "bank_name": "招商银行",
                    "bank_card_number": "36712313531987"
                }
            ]
        }
    }
                    </code>
                </pre>
            </div>
            
            <p>接口数据说明：</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>user_bank_id</td>
                        <td>用户银行信息id</td>
                        <td>用户所绑定的某一张银行卡的唯一标识</td>
                    </tr>
                    <tr>
                        <td>bank_name</td>
                        <td>银行名称</td>
                        <td>相应的银行名称</td>
                    </tr>
                    <tr>
                        <td>bank_card_number</td>
                        <td>银行卡号</td>
                        <td>相应的银行卡号</td>
                    </tr>
                </tbody>
            </table>
            
                  
            <!-- 删除用户银行信息 -->
            <h3 id="t_api_doc_user_info_bank_delete">user.info.bank.delete</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.delete</p>
            <p>删除用户银行信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>user_bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户银行信息id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success" 
    }
                    </code>
                </pre>
            </div>
            
            <!-- 修改用户银行信息 -->
            <h3 id="t_api_doc_user_info_bank_update">user.info.bank.update</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.update</p>
            <p>修改用户银行信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>user_bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户银行信息id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>bank_card_number</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行卡号</td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>opening_bank_name</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>开户分行</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>holder_mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>手机预留号码</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success" 
    }
                    </code>
                </pre>
            </div>            
            <!-- 保存和修改用户银行信息,并且进行验证 -->
            <h3 id="t_api_doc_user_info_bank_verify">user.info.bank.verify</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.verify</p>
            <p>保存和修改用户银行信息,并且进行验证</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行id</td>
                        <td>可选的银行id，通过<a href="#t_api_doc_bank_get">bank.get</a>接口获取</td>
                    </tr>                    
                    <tr>
                        <td>bank_card_number</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行卡号</td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>opening_bank_name</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>开户分行</td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>holder_name</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>开户人</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>holder_mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>手机预留号码</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>holder_id_card</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>身份证号</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>user_bank_id</td>
                        <td><span class="label label-info">非必需</span></td>
                        <td>用户银行信息id,传人时进行修改,不传保存信息</td>
                        <td></td>
                    </tr>                    
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "url":"xxxxxxxxx"
        }
    }
                    </code>
                </pre>
            </div>
            <!-- 保存和修改用户银行信息,并且重新验证绑定银行卡 -->
            <h3 id="t_api_doc_user_info_bank_rebind">user.info.bank.rebind</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.rebind</p>
            <p>保存和修改用户银行信息,并且重新验证绑定银行卡</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行id</td>
                        <td>可选的银行id，通过<a href="#t_api_doc_bank_get">bank.get</a>接口获取</td>
                    </tr>                    
                    <tr>
                        <td>bank_card_number</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>银行卡号</td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>opening_bank_name</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>开户分行</td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>holder_name</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>开户人</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>holder_mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>手机预留号码</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>holder_id_card</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>身份证号</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>user_bank_id</td>
                        <td><span class="label label-info">非必需</span></td>
                        <td>用户银行信息id,传人时进行修改,不传保存信息</td>
                        <td></td>
                    </tr>                    
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "url":"xxxxxxxxx"
        }
    }
                    </code>
                </pre>
            </div>            
            <!-- 获取用户借款相关信息 -->
            <h3 id="t_api_doc_user_info_borrowing_get">user.info.borrowing.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.borrowing.get</p>
            <p>获取用户借款相关信息。目前只会返回借款配额。</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "quota": "2000"
        }
    }
                    </code>
                </pre>
            </div>
            
            
            <!-- 获取用户综合信息 -->
            <h3 id="t_api_doc_user_info_get">user.info.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.get</p>
            <p>获取用户综合信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "base": {基本信息},
            "edu": {教育信息},
            "contacts": {联系人信息},
            "photo": {照片信息},
            "bank": {银行信息},
            "borrowing": {借款信息}
        }
    }
                    </code>
                </pre>
            </div>
            <!-- 保存用户收货地址信息 -->
            <h3 id="t_api_doc_user_info_shipaddress_save">user.info.shipaddress.save</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.shipaddress.save</p>
            <p>保存用户收货地址信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>consignee</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>收货人姓名</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>mobile_num</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>收货人手机号</td>
                        <td></td>
                    </tr>
                     <tr>
                        <td>area_address</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>省市区</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>address</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>街道的详细地址</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success" 
    }
                    </code>
                </pre>
            </div>
            <!-- 获取用户收货地址信息 -->
            <h3 id="t_api_doc_user_info_shipaddress_get">user.info.shipaddress.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.shipaddress.get</p>
            <p>获取用户收货地址信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success",
        "data": {
            "id": "1",
            "consignee": "xx",
            "mobile_num": "xxxxxxxxxxx",
            "area_address": "上海浦东新区",
            "address": "洪嘉大厦"
        }
    }
                    </code>
                </pre>
            </div>            
<h3 id="t_api_doc_user_info_coin_get">user.info.coin.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.coin.get</p>
            <p>用户获取随金币记录</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                   <code class='json'>
    {
        "status": "success",
        "data": {
            "total_coin": "8",
            "record_coin": [
                {
                    "coin": "-4",
                    "type": "expend",
                    "source": "兑换奖品号码",
                    "create_time": "1453461298"
                },
                {
                    "coin": "-2",
                    "type": "expend",
                    "source": "兑换奖品号码",
                    "create_time": "1453461294"
                },
                {
                    "coin": "-1",
                    "type": "expend",
                    "source": "兑换奖品号码",
                    "create_time": "1453441990"
                },
                {
                    "coin": "-1",
                    "type": "expend",
                    "source": "兑换奖品号码",
                    "create_time": "1453440859"
                },
                {
                    "coin": "-2",
                    "type": "expend",
                    "source": "兑换奖品号码",
                    "create_time": "1453440142"
                },
                {
                    "coin": "-2",
                    "type": "expend",
                    "source": "兑换奖品号码",
                    "create_time": "1453436236"
                }
            ]
        }
    }                       
                   </code>
                </pre>
            </div>
            <p>返回字段说明：</p>
            <div class="highlight">
                <pre>
                type有两个状态:expend->'消费',deposit->'收入'
                </pre>
            </div>
<h3 id="t_api_doc_user_info_goods_list">user.info.goods.list</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.goods.list</p>
            <p>用户抢购商品记录</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success",
        "data": [
            {
                "preiod_id": "2",
                "number_list": "90283544,54442838,75381293",
                "user_id": "10011",
                "name": "ios 牛逼的空气净化器",
                "cover_img": "xxxxxxx",
                "lucky_num": "",
                "publish_time": "1454763600",
                "prize_winner": "",
                "lottery_status": "revealing"
            },
            {
                "preiod_id": "1",
                "number_list": "78458870,23456812,33663386,73453982,93422228,77094265,35787247",
                "user_id": "10011",
                "name": "apple iphone6s plus 128G 颜色随机",
                "cover_img": "xxxxxxx",
                "lucky_num": "35787247",
                "publish_time": "1452085200",
                "prize_winner": "137****1421",
                "lottery_status": "win"
            }
        ]
    }
                   </code>
                </pre>
            </div>
            <p>返回字段说明：</p>
            <div class="highlight">
                <pre>
                lottery_status有三个状态:revealing->'进行中',win->'中奖',losed->'未中奖'
                </pre>
            </div>
<h3 id="t_api_doc_user_info_geography_update">user.info.geography.update</h3>
            <p><span class="label label-success">POST</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.geography.update</p>
            <p>用户地理位置更新接口</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>country</td>
                        <td><span class="label label-info">可选</span></td>
                        <td>国家</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>province</td>
                        <td><span class="label label-info">可选</span></td>
                        <td>省份</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>city</td>
                        <td><span class="label label-info">可选</span></td>
                        <td>城市</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>district</td>
                        <td><span class="label label-info">可选</span></td>
                        <td>区域街道</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>address</td>
                        <td><span class="label label-info">可选</span></td>
                        <td>地址</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>longitude</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>经度</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>latitude</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>纬度</td>
                        <td></td>
                    </tr>                    
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success" 
    }                        
                   </code>
                </pre>
            </div>
            <h3 id="t_api_doc_user_info_third_save">user.info.third.save</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.third.save</p>
            <p>第三方用户信息(微信)更新接口</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>nickname</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>昵称</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>avatar</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>头像</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>gender</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>性别</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>unionid</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>unionid</td>
                        <td></td>
                    </tr>                    
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
        "data":
        {
            "share_url":"xxx"
        }
    }                        
                   </code>
                </pre>
            </div>            
        <h1 id="t_api_doc_borrowing">借/还款 API</h1>
            <!-- 借款订单预览(确认) -->
            <h3 id="t_api_doc_borrowing_order_preview">borrowing.order.preview</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=borrowing.order.preview</p>
            <p>借款订单预览(确认)</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>apply_money</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>申请金额</td>
                        <td>可选范围: 1000，2000，3000，4000，5000，6000</td>
                    </tr>
                    <tr>
                        <td>period_type</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>分期类型</td>
                        <td>可选范围: monthly(按月分期)，15d_free(15天免息)</td>
                    </tr>
                    <tr>
                        <td>period_num</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>分期数</td>
                        <td>在period_type为monthly需要提供此参数，可选范围: 1-6</td>
                    </tr>
                    <tr>
                        <td>promotion_code</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>推荐码</td>
                        <td>在period_type为15d_free需要提供此参数，可先用推荐码: comeon 做测试</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "actual_money": "2970.00",
            "poundage": "30.00",
            "bill_list":
            [
                {
                    "repay_money": "1060.09",
                    "overdue_date": "2016-01-16"
                },
                {
                    "repay_money": "1060.09",
                    "overdue_date": "2016-02-16"
                },
                {
                    "repay_money": "1060.09",
                    "overdue_date": "2016-03-16"
                }
            ]
        }
    }
                    </code>
                </pre>
            </div>
            
            <p>接口数据说明：</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>actual_money</td>
                        <td>实际到账金额</td>
                        <td>用户申请借款成功后实际收到的金额</td>
                    </tr>
                    <tr>
                        <td>poundage</td>
                        <td>手续费</td>
                        <td>随分期平台收取的手续费</td>
                    </tr>
                    <tr>
                        <td>bill_list</td>
                        <td>账单列表</td>
                        <td>一个列表项对应一期账单</td>
                    </tr>
                    <tr>
                        <td>repay_money</td>
                        <td>应还金额</td>
                        <td>该期账单应还款的金额</td>
                    </tr>
                    <tr>
                        <td>overdue_date</td>
                        <td>到期还款日期</td>
                        <td>该期账单最晚还款日期</td>
                    </tr>
                </tbody>
            </table>
            
        
            <!-- 借款订单提交(创建) -->
            <h3 id="t_api_doc_borrowing_order_submit">borrowing.order.submit</h3>
            <p><span class="label label-success">POST</span><span class="label label-primary">签名验证</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=borrowing.order.submit</p>
            <p>借款订单提交(创建)</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>apply_money</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>申请金额</td>
                        <td>可选范围: 1000，2000，3000，4000，5000，6000</td>
                    </tr>
                    <tr>
                        <td>period_type</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>分期类型</td>
                        <td>可选范围: monthly(按月分期)，15d_free(15天免息)</td>
                    </tr>
                    <tr>
                        <td>period_num</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>分期数</td>
                        <td>在period_type为monthly需要提供此参数，可选范围: 1-6</td>
                    </tr>
                    <tr>
                        <td>promotion_code</td>
                        <td><span class="label label-warning">可选</span></td>
                        <td>推荐码</td>
                        <td>在period_type为15d_free需要提供此参数，可先用推荐码: comeon 做测试</td>
                    </tr>
                    <tr>
                        <td>user_bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户银行信息id</td>
                        <td>用于指定借款的入账银行信息，通过<a href="#t_api_doc_user_info_bank_get">user.info.bank.get</a>接口获取</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success"
    }
                    </code>
                </pre>
            </div>
            
        <h1 id="t_api_doc_misc">杂项API</h1>
        
            <!-- 获取支持的银行列表 -->
            <h3 id="t_api_doc_bank_get">bank.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">无需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=bank.get</p>
            <p>获取支持的银行列表</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "bank_list":
            [
                {
                    "bank_id": "1",
                    "bank_name": "招商银行"
                },
                {
                    "bank_id": "2",
                    "bank_name": "工商银行"
                },
                {
                    "bank_id": "3",
                    "bank_name": "浦发银行"
                }
            ]
        }
    }
                   </code>
                </pre>
            </div>
        
            
            <!-- 检测版本升级 -->
            <h3 id="t_api_doc_misc_check">misc.check</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">无需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=misc.check</p>
            <p>检测版本升级</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>platform</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>平台</td>
                        <td>可选范围: iOS，Android</td>
                    </tr>
                    <tr>
                        <td>version</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>当前版本号</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "upgrade": "1",
            "upgrade_anyway": "0",
            "latest_version": "1.0",
            "url": "http://dn-clients.oss-cn-hangzhou.aliyuncs.com/teambition-latest.apk",
            "tip": "检测到新版本(v1.0)，立即升级?"
        }
    }
                   </code>
                </pre>
            </div>
            <p>接口数据说明：</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>upgrade</td>
                        <td>是否升级</td>
                        <td>1升级，0不升级</td>
                    </tr>
                    <tr>
                        <td>upgrade_anyway</td>
                        <td>是否强制升级</td>
                        <td>1升级，0不升级</td>
                    </tr>
                    <tr>
                        <td>latest_version</td>
                        <td>最新版本号</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>url</td>
                        <td>最新版本下载链接</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>tip</td>
                        <td>升级提示信息</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- 获取banner信息 -->
            <h3 id="t_api_doc_banner_get">banner.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">无需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=banner.get</p>
            <p>获取banner信息</p>
            
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success",
        "data": [
            {
                "title": "sdvsdfgsfdf",
                "img_url": "http://test.common.suifenqi.cn/image/banner/original/27663986ee37485dac26c3e2e9e9df7b.jpg",
                "url": "http://sfsdf",
                "type": "web"
            },
            {
                "title": "地方vgdafgf",
                "img_url": "http://test.common.suifenqi.cn/image/banner/original/d2376d4bfa4fe498af4aa9d7418d488f.jpg",
                "url": "http://localhost",
                "type": "web"
            },
            {
                "title": "asfdf",
                "img_url": "http://test.common.suifenqi.cn/image/banner/original/91028914bacc67e5fce6ff40bf36cbfe.jpg",
                "url": "http://sdfsdfsdf",
                "type": "web"
            },
            {
                "title": "SFSDFDF",
                "img_url": "http://test.common.suifenqi.cn/image/banner/original/c1b57ced9bd2cbedd39660cca0839a5d.jpg",
                "url": "HTTP:///SDAFSDFSADFSDF",
                "type": "web"
            }
        ]
    }
                   </code>
                </pre>
            </div>
            <p>接口数据说明：</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>title</td>
                        <td>下方的标题文字</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>img_url</td>
                        <td>图片地址</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>url</td>
                        <td>链接地址或app页面</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>type</td>
                        <td>web和app两个值</td>
                        <td>web是外链跳转,app页面切换</td>
                    </tr>
                </tbody>
            </table>            
        <h1 id="t_api_doc_bind">联动优势相关 API</h1>
            <h3 id="t_api_doc_user_info_bank_bind">user.info.bank.bind</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.bank.bind</p>
            <p>获取绑定银行的第三方的确认html5的url</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>                    
                    <tr>
                        <td>user_bank_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户银行信息id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>bind_plat_type</td>
                        <td><span class="label label-info">可空</span></td>
                        <td>第三方平台的类型.默认为"联动优势"</td>
                        <td>当前为 liandongyoushi</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "url":"xxxxxxxxx"
        }
    }
                   </code>
                </pre>
            </div>
        <h3 id="t_api_doc_bill_repay">bill.repay</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=bill.repay</p>
            <p>获取html5的Url进行充值,成功后直接跳转html5转账的页面</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>bill_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>账单的id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>amount</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>所还金额</td>
                        <td>有小数的保留两位小数</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "url":"xxxxxxxxx"
        }
    }
                   </code>
                </pre>
            </div>
<h3 id="t_api_doc_user_info_balance_get">user.info.balance.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.balance.get</p>
            <p>获取联动优势的余额</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "remain_money":"xxxxxxxxx",
            "balance":"xxxxxxxxx",
            "is_repaying":"xxxxxxxxx"
        }
    }
                   </code>
                </pre>
            </div>
<h3 id="t_api_doc_user_info_balance_repay">user.info.balance.repay</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.balance.repay</p>
            <p>获取三方(联动优势)html5的转账页面</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>amount</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>所还金额</td>
                        <td>有小数的保留两位小数</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "url":"xxxxxxxxx"
        }
    }
                   </code>
                </pre>
            </div>
<h3 id="t_api_doc_user_info_balance_withdrawals">user.info.balance.withdrawals</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.info.balance.withdrawals</p>
            <p>获取三方(联动优势)html5的提现页面</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>amount</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>提现金额</td>
                        <td>有小数的保留两位小数</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success", 
        "data": 
        {
            "url":"xxxxxxxxx"
        }
    }
                   </code>
                </pre>
            </div>            
<h3 id="t_api_doc_user_resetutpwd">user.resetutpwd</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=user.resetutpwd</p>
            <p>修改第三方交易密码</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success",
    }
                   </code>
                </pre>
            </div>            
    <h1 id="t_api_doc_goods">商品抢购 API</h1>
            <h3 id="t_api_doc_goods_preiod_get">goods.preiod.get</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=goods.preiod.get</p>
            <p>获得商品抢购信息(首页)</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success",
        "data": {
            "publish_time": "2016-02-06 21:00:00",
            "name": "apple iphone6s plus 128G 颜色随机",
            "cover_img": "xxx",
            "coin_price": "1",
            "preiod_id": "1",
            "total_coin": "15"
        }
    }
                   </code>
                </pre>
            </div>
        <h3 id="t_api_doc_goods_preiod_detail">goods.preiod.detail</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=goods.preiod.detail</p>
            <p>获得商品抢购的详细信息(详细页面)</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>preiod_id</td>
                        <td><span class="label label-info">可选</span></td>
                        <td>抢购期数的id</td>
                        <td>传空获得最新,过往穿具体id</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
                        {
                            "status": "success",
                            "data": {
                                "preiods": {
                                    "ids": "2,1"
                                },
                                "goods_name": "apple iphone6s plus 128G 颜色随机",
                                "preiod_id": "1",
                                "carousel_img": [
                                    "xxxxx",
                                    "xxxxx"
                                ],
                                "prize_winner": "",
                                "publish_time": "2016-02-06 21:00:00",
                                "system_time": "2016-01-22 13:49:32",
                                "lucky_num": "",
                                "participant_info": {
                                    "number_list": {
                                        "number_list": "23456812,93422228,78458870"
                                    },
                                    "all_list": [
                                        {
                                            "name": "186****5783",
                                            "count": "2"
                                        },
                                        {
                                            "name": "137****1421",
                                            "count": "6"
                                        }
                                    ]
                                }
                            }
                        }
                   </code>
                </pre>
            </div>
<h3 id="t_api_doc_goods_preiod_exchange">goods.preiod.exchange</h3>
            <p><span class="label label-success">GET</span><span class="label label-success">需签名</span></p>
            <p>API : http://{api_host}/gateway.cgi?mod=goods.preiod.exchange</p>
            <p>兑换抢购商品</p>
            <table class='table'>
                <thead>
                    <th>参数名</th>
                    <th>是否必需</th>
                    <th>中文名</th>
                    <th>备注</th>
                </thead>
                <tbody>
                    <tr>
                        <td>v</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>API主版本号</td>
                        <td>当前为1</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>用户id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>preiod_id</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>抢购活动的id</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>quantity</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>兑换的数量</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><span class="label label-info">必需</span></td>
                        <td>签名</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
    
            <p>返回结果格式(json)：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        status  = "success" | "failure"
        message = null | ERROR MESSAGE
        data = { 接口数据 }
    }
                    </code>
                </pre>
            </div>

            
            <p>返回示例：</p>
            <div class='highlight'>
                <pre>
                    <code class='json'>
    {
        "status": "success",
        "data": {
            "number_string": "77094265",
            "quantity": "1"
        }
    }
                   </code>
                </pre>
            </div>            
        <style>
            .docs_main {font-size:13px;}
            .docs_main .label {margin-right:5px;}
            code {font-size:13px;}
            h1 {margin-bottom:10px;padding-bottom:10px;border-bottom:3px double #eee;margin-top:40px;font-size:18px;}
            h2 {color:#999;border-bottom:1px solid #eee;padding:5px 0;font-size:14px;}
            h3 {border-left:3px solid lightseagreen;font-size:18px;padding-left:10px;margin-bottom:20px;margin-top:60px;}
            
            ul.nav.list-group.bs_list_group {width: 263px;}
            @media(max-width:1200px){ 
                ul.nav.list-group.bs_list_group {position:static;width: 100%;}
            }
        </style>
    </div>
</div>
</div>
<?php $this->_endblock(); ?>