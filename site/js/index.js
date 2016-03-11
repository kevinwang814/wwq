var scrolling = false;

var scrollStart = function(block) {
    //console.log(block);
    $('#header_nav [data=nav]').removeClass('selected');
    $('#header_nav [data-target=' + block + ']').addClass('selected');
};

var showBlock = function(block) {
    if (scrolling) { return false;};

    console.log('showBlock:' + block + ' scrolling=' + scrolling);
    var b = $(block);
    if ( !b.hasClass('animate') ) {
        b.addClass('animate'); 
    };

    if (!scrolling) {
        //console.log(block);
        $('#header_nav [data=nav]').removeClass('selected');
        $('#header_nav [data-target=' + block + ']').addClass('selected');
    }
};

$(function() {
    window.setInterval(function() {
        $('#header_nav').width($(window).width());
    }, 100);
    
    
    /*$(document).on('hover','.block_goods .goods_div',function(){
        alert("ff");
    });*、
    /*$(document).on('mouseleave','.block_goods .goods_div div',function(){
        $(this).hide('normal');
    });*/
    $('.block_goods .goods_div').hover(function(){
        $('div',this).show();
    },function(){
        $('div',this).hide();
    });
    /*$(document).on('mouseenter mouseleave','.block_goods .goods_div',function(e){
        console.log("dd");
        if(e.type == 'mouseenter'){
            console.log("进来");
        }else if(e.type == "mouseleave"){
            console.log("出去");
        }
    });*/
});
