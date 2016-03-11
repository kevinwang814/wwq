<section id="content-right">
<div class="content-header">
    <div class="time pull-left">
        欢迎您，管理员。现在系统时间：
        <time datetime="2016/1/12"></time>
    </div>
    <div class="user-info pull-right">
        <img src="/img/sbg1.jpg" class="user-img" alt="img">
        <em class="user-name">
            <?php 
                if(sessionv('admin')){
                    echo sessionv('admin.name');
                }
            ?>
        </em>
        <span class="arrow-down"></span>

        <!-- 用户操作【start】-->
        <div class="user-nav">
            <span class="arrow-up"></span>
            <ul class="user-nav-ul">
                <li class="user-nav-list">
                    <a href="<?php echo U('admin/logout')?>">
                        <i class="ico exit">&nbsp;</i>
                        退出登录
                    </a>
                </li>
            </ul>
        </div>
        <!-- 用户操作【end】-->

    </div>
</div>
<!-- ./content-header end.-->