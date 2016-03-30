<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php if($url != '' && $url != false) echo '<meta http-equiv="refresh" content="'. $wait .';URL='. $url .'" />';?>
<?php if($url == false): ?>
<script>
    function closewin(){ 
        self.opener=null; 
        self.close();
    } 
    function clock(){
        i=i-1 
        document.title="本窗口将在"+i+"秒后自动关闭!"; 
        if(i>0)setTimeout("clock();",1000); 
        else closewin();
    } 
    var i=<?php echo $wait; ?> 
    clock(); 
    
</script>
<?php endif; ?>
<title>操作成功 - 话费多</title>
<link type="image/x-icon" rel="shortcut icon" href="/img/favicon.ico">
<link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="/css/site.css">
</head>
<body id="page">
<div class="nav_logo">
     <img src="/img/logo.png" class="logo"  style="width:100px;"/>
</div>
    <div class="container">
        <div class="center-block" id="success">
            <div class="icon"><i class="glyphicon glyphicon-ok"><!--[if lt IE 9]>√<![endif]--></i></div>
            <h4><?php echo $message;?></h4>
            <p>
                <?php if($url != '' && $url != false) echo '<span id="redirect">'. $wait .' 秒以后自动跳转，如果没有，请点<a href="'. $url .'">手动跳转</a>.</span>';?>
                <?php if($url == false) echo '<span id="redirect">本窗口将在'. $wait .' 秒以后自动关闭</span>';?>
            </p>
        </div>
    </div>

    
    <style>
    body {background:#fff;padding:0;margin:0;}
        #success {padding:20px;width:400px;border-radius: 20px;background:#eee;}
        .glyphicon {font-size:36px;color:#fff;}
        .icon {text-align: center;margin-bottom:20px;background:#5cb85c;color:#fff;border-radius:38px;padding:20px;text-align: center;display:block;width:76px;margin:0 auto;}
        h4 {text-align:center;margin-bottom:10px;padding-bottom:10px;border-bottom:1px solid #ddd;}
        p {margin:0;}
        #redirect{display:inline-block; width:100%; text-align: center;}
    /** hack for （反人类的） Internet Explorer */
    .container {
        text-align: center;
    }
    .container p {
        text-align: left;
    }
    </style>
</body>
</html>
