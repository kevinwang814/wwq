;(function(){
FX.register('scrollanimate', [], {
    target:         'this',
    class:          'animate',
    offset:         0,
    offset_rate:    0.3,
    big_screen:     1000,
    sensitivity:    500, // 500为敏感区间，一般情况下此值对动画无影响
    onanimate:      ''

}, function(attrs){
    var $this = $(this);
    if (attrs.target === 'this') {
        var target = $(this);
    } else {
        var target = $(attr.target);
    }

    var handle = window.setInterval(function(){
        var curr_top = $(window).scrollTop(), // 当前网页滚动的高度
            window_height = $(window).height(); // 浏览器窗口中网页可见高度

        // 判断target是否触发动画，因为用户可能在加载后改变页面尺寸，
        // 因此需要每次根据屏幕高度选择判断方案。
        var happen = false;

        // 若浏览器高度大于阀值big_screen时使用百分比中心判断（否则使用顶部top值判断）
        if ( window_height >= attrs.big_screen ) {
            var target_top = target.offset().top, // target在页面中的高度
                target_height = target.height(), // target的高度
                target_middle = target_top + (target_height / 2); // target中心的高度

            // target中间高度与浏览器滚动高度之间的差
            var offset = target_middle - curr_top;
            // 获得触发区间
            var start = window_height * (1 - attrs.offset_rate) / 2,
                end = window_height - start;
            // 若target中心在此区间内，则触发
            happen = (offset >= start) && (offset <= end);

        }else{
            var target_top = target.offset().top, // target在页面中的高度
                show_top = attrs.offset; // target的显示高度
            happen = ( (curr_top >= target_top - show_top) 
                && (curr_top < target_top + show_top + attrs.sensitivity) );
        };

        if ( happen && !$(this).hasClass(attrs.class) ) {
            $this.addClass(attrs.class); 
        };

        if ( happen && attrs.onanimate ) {
            eval(attrs.onanimate);
        };
        
    }, 100);

});
})();
