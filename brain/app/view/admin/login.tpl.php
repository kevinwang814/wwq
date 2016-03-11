<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>达意农场管理系统</title>
    <link rel="stylesheet" href="/css/login.css"/>
</head>
<body>
    <div class="login2016">
        <form action="<?php echo U('admin/login')?>" method="post">
            <input type="text" name="name" placeholder="请输入用户名" />
            <br />
            <input type="password" name="password" placeholder="请输入密码" />
            <br />
            <div><?php if(isset($errorMessage)){echo $errorMessage;}?></div>
            <input type="submit" value="登入" />
        </from>
    </div>
</html>
