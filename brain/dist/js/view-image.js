$(function() {
    $("img.img-thumbnail").each(function(){
        $(this).css('cursor','pointer').attr('data-toggle',"modal");
    });
    $("img.img-thumbnail").click(function(){
        var hasVideoSrc = $(this).attr("video-url");
        if(hasVideoSrc){
            initPlayer(hasVideoSrc);
            $("#changImgDirection").css('display','none');
        }else{
            var imageHtml = "<img src='' alt='' class='img-responsive element-center'/>";
            $('#showBigImage').html(imageHtml);
            var img = $('#showBigImage img');
            var imgSrc = $(this).attr("src");
            if(imgSrc.length > 0){
                img.attr('src',imgSrc);
            }
            $("#changImgDirection").css('display','');
            var time = 1;
            $("#changImgDirection").on('click',function(){           
                time = time%4;
                var img = $('#showBigImage img');
                switch(time){
                    case 0:
                        img.css('transform','rotate(0deg)');
                        break;
                    case 1:
                        img.css('transform','rotate(90deg)');
                        break;
                    case 2:
                        img.css('transform','rotate(180deg)');
                        break;
                    case 3:
                        img.css('transform','rotate(270deg)');
                        break;
                }
                time ++;
            });
        }
        $("#imageModal").modal('toggle');
    });
    function initPlayer(vLink) {
        if ($("#video-embed").length) {
            return;
        }
        var vType = 'application/x-mpegURL';
        var player = $('<video id="video-embed" class="video-js vjs-default-skin element-center"></video>');
        $('#showBigImage').empty();
        $('#showBigImage').append(player);
        videojs('video-embed', {
            "width":"540px",
            "height": "432px",
            "controls": true,
            "autoplay": false,
            "preload": "auto"
        }, function() {
            this.src({
                type: vType,
                src: vLink
            });
        });
    }
    function disposePlayer() {
        if ($("#video-embed").length) {
            $('#showBigImage').empty();
            videojs('video-embed').dispose();
        }
    }
    $('#imageModal').on('hidden.bs.modal', function() {
        disposePlayer();
    });    
});



