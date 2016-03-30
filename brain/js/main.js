/**
 * Created by Czar on 2016/1/12.
 */

/*后台 js*/


$(function () {
    //调用获取高度函数
    getHeight();

    //点击菜单事件
    /*$('.menu .menu-content').on('click', function () {
        var $this = $(this);
        var $this_par = $('.menu .menu-content');
        $this_par.removeClass('active');
        $this.addClass('active');
        $this_par.find('span').removeClass('cur');
        $this.find('span').addClass('cur');
    });*/


    //二级菜单事件
    $('.menu-list').on('click','>li', function () {
        auto_slide($(this),'second-nav');
        $('.three-nav').slideUp();
        $('.second-nav-list').removeClass('active');
        $('.three-nav-list a').removeClass('detail');
    });

    //阻止冒泡事件
    $('.second-nav-list').on('click', function (e) {
        auto_slide($(this),'three-nav');
        $(this).addClass('active');
        $(this).siblings('li').removeClass('active');
        $('.three-nav-list a').removeClass('detail');
        e.stopPropagation();
        //return false;//同时阻止系统默认事件和冒泡事件
    });
    $('.three-nav-list').on('click', function (e) {

        $(this).find('a').addClass('detail');
        $(this).siblings('li').find('a').removeClass('detail');

        e.stopPropagation();
        //return false;//同时阻止系统默认事件和冒泡事件
    });



    //获取系统时间事件
    setInterval(function(){$('time').html(currentTime)},1000);

    //弹出用户操作事件
    $('.user-info').hover(function () {
        $('.user-nav').show();
    }, function () {
        $('.user-nav').hide();
    });


    //登录界面点击关闭按钮事件
    $('.close').on('click', function(c){
        $('.login-form').fadeOut('slow', function(c){
            $('.login-form').remove();
        });
    });


    //左边所有的超链接，拦截点击事件，发送ajax，结果写入右边的容器里面
    /*$(".detail").on('click',function () {
        $.get($(this).attr("href"), function (r) {
            $("#main-content").html(r);
        }, "html");
        return false;
    });*/




});


//主界面中设置左边栏的高度，随着浏览器高度自适应
function getHeight() {
    var menu_right = document.getElementById('menu-left');//获取menu-right的高度
    var body_height = document.documentElement.clientHeight;//document.body.clientHeight中在<!DOCTYPE html>声明下会返回0
    menu_right.style.height = body_height + 'px';//将正文的高度赋值给menu-right
}

//获取系统时间函数
function currentTime(){
    var d = new Date(),
    str = '';
    str += d.getFullYear()+'年';
    str  += d.getMonth() + 1+'月';
    str  += d.getDate()+'日';
    str += d.getHours()+'时';
    str  += d.getMinutes()+'分';
    str+= d.getSeconds()+'秒';
    return str;
}


//点击菜单收缩函数
function auto_slide($this,nav) {

    var $_nav = $this.find('.' + nav);
    $('.' + nav).slideUp('slow');

    if($_nav.css('display') == 'block') {
        $_nav.slideUp();
    }
    else {
        $_nav.slideDown();
    }
}

//视频管理界面 js事件
//点击修改按钮事件
function update_cli(obj) {
    var $this = $(obj);
    var $parents = $this.parents('tr');
    var $name = $parents.find('.movice-name');
    var $sec_par = $name.parent();
    $name.addClass('update_name');
    $name.removeAttr('readonly');
    $name.focus().select();
    $sec_par.append('<span class="ok glyphicon glyphicon-ok" onclick="update_ok(this)"></span>' +
        '<span class="remove glyphicon glyphicon-remove" onclick="update_ok(this)"></span>');
}
//点击修改名字之后确定按钮事件
function update_ok(obj) {
    var $this = $(obj);
    var $parents = $this.parent();
    var $name = $parents.find('.movice-name');
    $name.removeClass('update_name');
    $name.attr('readonly');
    $parents.find('.ok,.remove').remove();
}
