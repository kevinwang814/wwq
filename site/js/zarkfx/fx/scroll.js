;(function(){
var is_ie6 = navigator.userAgent.indexOf('MSIE 6') !== -1;

if(is_ie6){ // ie6 hack
    var getScrollTop = function(){
        var scrollPos;
        if (typeof window.pageYOffset != 'undefined') {
            scrollPos = window.pageYOffset;
        }
        else if (typeof document.compatMode != 'undefined' &&
            document.compatMode != 'BackCompat') {
                scrollPos = document.documentElement.scrollTop;
            }
        else if (typeof document.body != 'undefined') {
            scrollPos = document.body.scrollTop;
        };
        return scrollPos;
    };
};

var scroll_objs = []
var last_top = null;
$(window).scroll(function(){
    var this_top = $(document).scrollTop();
    if (last_top === null || Math.abs(last_top-this_top) >= 10 || this_top === 0){
        last_top = this_top;
        for(var i in scroll_objs){
            if (scroll_objs[i].scrollTop < this_top){
                scroll_objs[i].$hide_obj.fadeIn();
            }else{
                if (scroll_objs[i].scrollTop >= 0){
                    scroll_objs[i].$hide_obj.fadeOut();
                };
            };
        };
    };
});

FX.register('scroll', [], {
    style:          'none',
    speed:          0,
    scrollTop:      -1,
    target:         undefined,
    top:            undefined,
    bottom:         undefined,
    left:           undefined,
    right:          undefined,
    offset:         0,
    onstart:        '',
    onend:          ''

}, function(attrs){
    var $this = $(this),
        $scroll_obj;

    if (attrs.style === 'default' ){
        $this.hide();
        $scroll_obj = $('<div class="zarkfx_scroll_style" ><div>').appendTo('body');
    }else{
        $scroll_obj = $this;
    };

    var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body'); // opera hack

    $scroll_obj.click(function(){
        if (attrs.target === undefined){
            target_top = 0;
        }else{
            target_top = $(attrs.target).offset().top + attrs.offset;
            if ( $(document).scrollTop() <= 100 ) {
                target_top -= 50;
            }
        };
        scrolling = true;
        if (attrs.onstart) {
            eval(attrs.onstart);
        }
        $body.animate({scrollTop: target_top}, {
            duration:  parseInt(attrs.speed),
            complete:  function() {
                if (attrs.onend) {
                    eval(attrs.onend);
                }
                scrolling = false;
            }
        });
        return false;
    });

    // add to scroll_objs
    scroll_objs.push({scrollTop: attrs.scrollTop,
        $hide_obj: $scroll_obj
    });

    // show or hide this obj
    var this_top = $(document).scrollTop();
    if (attrs.scrollTop > this_top){
        $scroll_obj.hide();
    }else{
        $scroll_obj.show();
    };

    // set position
    if (attrs.top !== undefined || attrs.bottom !== undefined || attrs.left !== undefined || attrs.right !== undefined ){
        // 此处加入IE6判断，IE6使用绝对定位
        if(is_ie6){
            $scroll_obj.css('position','absolute').appendTo('body');
        }else{
            $scroll_obj.css('position','fixed').appendTo('body');
        };
    };
    if (attrs.bottom !== undefined) {
        if(is_ie6){
          $(window).scroll(function(){
              var scroll_bottom = $(document).height() + parseInt(attrs.bottom) - $(window).height();
              $this.css('bottom', scroll_bottom - getScrollTop());
          });
        }else{
            $scroll_obj.css('bottom', attrs.bottom + 'px');
        };
    };
    if (attrs.top !== undefined) {
        if(is_ie6){
          $(window).scroll(function(){
              var scroll_top = parseInt(attrs.top);
              $scroll_obj.css('top', scroll_top + getScrollTop());
          });
        }else{
            $scroll_obj.css('top', attrs.top + 'px');
        };
    };
    if (attrs.right !== undefined) $scroll_obj.css('right', attrs.right + 'px');
    if (attrs.left !== undefined) $scroll_obj.css('left', attrs.left + 'px');

});
})();
