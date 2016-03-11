<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HTTP/1.1 500 Internal Server Error</title>
<script language="javascript">
setTimeout("goto()", <?php echo $wait * 1000;?>);
function goto()
{<?php if( empty($url) ) echo 'window.history.go(-1);'; else echo "window.location.href=\"{$url}\"";?>}
</script>
<style type="text/css">
body {background-color:	#fff; margin:40px;font-family: Consolas, Verdana, Arial, sans-serif;}
#content {border: 1px solid #E1E1E1;background-color:	#eee;padding:20px 20px 12px 20px;width:900px;margin:0 auto;}
h1{font-weight:normal;font-size:22px;color:#000;margin:0 0 4px 0;padding:10px;background:#fff55d;}
p{color:#333;font-size:13px;}

#redirect{color:#999;}
</style>
</head>
<body>
  <div id="content">
    <h1><?php echo $message;?></h1>
    <p><?php echo $message;?></p>
    <?php echo '<p id="redirect">'. $wait .' seconds later will be redirect, if not automatically jump, Please <a href="javascript:goto();">click here</a>.</p>';?>

  </div>
</body>
</html>