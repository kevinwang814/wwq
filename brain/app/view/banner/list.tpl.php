<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="#">
                    <span class="fa fa-tags"></span>
                    <span>Banner管理</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="#">
                    <span>Banner管理</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="/finance/issued/list.html">
                    <span>列表</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Banner操作
                </div>
                <div class="panel-body">
                    <div id="banner-now">
                        <span id="add-banner" data-toggle="modal" data-target="#bannerModal" style="border:5px dotted #898989;font-size:60px;padding:0px 15px 0px 15px;color:#898989">+</span>
                    </div>
                    <?php if(isset($bannerListEnabled) && is_array($bannerListEnabled)):?>
                    <?php foreach ($bannerListEnabled as $bannerEnabled):?>
                    <?php echo '<div style="float:left;margin:0px 10px 5px 0px;position:relative;"><div data-toggle="modal" data-target="#editBanner" class="editBanner" banner-id='.$bannerEnabled['id'].' style="bottom:0px;position:absolute;height:100%;width:100%;background:rgba(0,0,0,.5);text-align:center;font-weight:bold;color:#FFFFFF;display:none">点击编辑</div><img class="bannerImage" style="width:200;cursor:pointer" src='.$bannerEnabled['image'].'></div>';?>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:0px;padding-top: 0px">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    历史Banner
                </div>
                <div class="panel-body">
                    <?php if(isset($bannerListDisabled) && is_array($bannerListDisabled)):?>
                    <?php foreach ($bannerListDisabled as $bannerDisabled):?>
                    <?php echo '<div style="float:left;margin:0px 10px 5px 0px;position:relative;"><div data-toggle="modal" data-target="#detailBanner" class="detailBanner" banner-id='.$bannerDisabled['id'].' style="bottom:0px;position:absolute;height:100%;width:100%;background:rgba(0,0,0,.5);text-align:center;font-weight:bold;color:#FFFFFF;display:none">查看详情</div><img class="bannerImage" style="width:200;cursor:pointer" src='.$bannerDisabled['image'].'></div>';?>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="bannerModalLabel">添加Banner</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>标题:</label>
                <input type="text" class="form-control" id="bannerTitle" placeholder="请输入Banner标题">
            </div>
            <label>选择图片:</label>
            <div id="bannerDiv">
            </div>
            <div class="form-group">
                <label>链接地址:</label>
                <input type="text" class="form-control" id="bannerUrl" placeholder="http(s)://">
            </div>
            <div class="form-group">
                <label>截止时间:</label>
                <input type="text" class="form-control" id="closeTime" placeholder="点击选择时间(先选时分秒)">
            </div>
            <label>使用范围:</label>
            <label class="radio-inline">
                <input type="radio" name="useType" value="web"> web
            </label>
            <label class="radio-inline">
              <input type="radio" name="useType" checked="checked" value="app"> app
            </label>
          </div>
          <div class="modal-footer">
            <button id="saveBanner" banner-id="" type="button" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>
        </form>
    </div>
  </div>
</div>



<!-- Modal-detailBanner -->
<div class="modal fade" id="detailBanner" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="bannerModalLabel">Banner详情</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>Banner标题:</label>
                <p id="detailBannerTitle"></p>
            </div>
            <label>Banner图片:</label>
            <div id="detailBannerDiv">
                <img id="detailBannerImage" alt="banner图片缩略图" src="">
            </div>
            <div class="form-group">
                <label>链接地址:</label>
                <p id="detailBannerUrl" style="word-break:break-all;text-indent:2em "></p>
            </div>
            <div class="form-group">
                <label>使用范围:</label>
                <p id="detailBannerUseType" style="word-break:break-all;text-indent:2em "></p>
            </div>
            <div class="form-group">
                <label>开始时间:</label>
                <p id="detailBannerCreateTime"></p>
            </div>
            <div class="form-group">
                <label>截止时间:</label>
                <p id="detailBannerCloseTime"></p>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal-editBanner -->
<div class="modal fade" id="editBanner" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="bannerModalLabel">编辑Banner</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>Banner标题:</label>
                <input type="text" class="form-control" id="editBannerTitle" placeholder="请输入Banner标题">
            </div>
            <label>选择图片:</label>
            <div id="editBannerDiv">
                <div style="float:left;margin:0px 10px 5px 0px;position:relative;">
                    <div class="deleteImage" style="bottom:0px;position:absolute;height:100%;width:100%;background:rgba(0,0,0,.5);text-align:center;font-weight:bold;color:#FFFFFF;display:none">点击删除</div>
                    <img id="editBannerImage" class="bannerSrc" style="width:200px;height:100px;cursor:pointer" src>
                </div>
            </div>
            <div class="form-group">
                <label>链接地址:</label>
                <input type="text" class="form-control" id="editBannerUrl" placeholder="http(s)://">
            </div>
            <label>使用范围:</label>
            <label class="radio-inline">
              <input type="radio" name="useType" id="bannerWeb" value="web"> web
            </label>
            <label class="radio-inline">
              <input type="radio" name="useType" id="bannerApp" value="app"> app
            </label>
            <div class="form-group">
                <label>截止时间:</label>
                <input type="text" class="form-control" id="editBannerCloseTime" placeholder="点击选择时间(先选时分秒)">
            </div>
          </div>
          <div class="modal-footer">
            <button id="saveEditBanner" type="button" class="btn btn-primary">确认修改</button>
            <button id="deleteBanner" type="button" class="btn btn-primary" >删除banner</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </form>
    </div>
  </div>
</div>




<script src="/vendor/js/ajaxfileupload.js"></script>
<script src="/vendor/js/laydate.js"></script>
<script>
    laydate({
        elem: '#closeTime',
                    format: 'YYYY-MM-DD hh:mm:ss',
                    istime:true
    });
    laydate({
        elem: '#editBannerCloseTime',
                    format: 'YYYY-MM-DD hh:mm:ss',
                    istime:true
    });
</script>
<script>
    var fileType = new Array('image/png','image/jpeg','image/gif','image/bmp');
    var addBannerDom = '<div style="width:100%;height:100px;background:#ECECEC;border-radius: 10px;color:#717171;line-height: 100px;text-align: center;position: relative"><div style="font-size:20px;font-weight: bold;position: absolute;top:0px;left:0px;width:100%;height:100%;">点击上传</div><input type="file" name="bannerImage" id="bannerImage" style="width:100%;height:100%;background:red;opacity: 0;cursor: pointer"></div>';
    //选择图片之后自动上传
    
    $(document).on("click","#add-banner",function(){
        $('#bannerDiv').html('');
        $('#bannerDiv').append(addBannerDom);
    });
    
    $(document).on("change",'#bannerImage',function(){
        var file = $(this).get(0).files[0];
        var type = file['type'];
        var fileElementId = $(this).attr('id');
        var parentId = $(this).parent().parent().attr('id');
        if($.inArray(type,fileType) != -1){
            $.ajaxFileUpload({
                url:'handler.html?elementId=bannerImage',
                secureuri:false,
                fileElementId:fileElementId,
                dataType:'json',
                success:function(data,status){
                    if(data.src != undefined){
                        var dom = '<div style="float:left;margin:0px 10px 5px 0px;position:relative;"><div class="deleteImage" style="bottom:0px;position:absolute;height:100%;width:100%;background:rgba(0,0,0,.5);text-align:center;font-weight:bold;color:#FFFFFF;display:none">点击删除</div><img class="bannerSrc" style="width:200px;height:100px;cursor:pointer" src="'+data.src+'"></div>';
                        if(parentId == 'bannerDiv'){
                            $('#bannerDiv').children().remove();
                            $('#bannerDiv').append(dom); 
                        }else if(parentId == 'editBannerDiv'){
                            $('#editBannerDiv').children().remove();
                            $('#editBannerDiv').append(dom); 
                        }

                    }
                }
                });
        }else{
            alert('图片格式不正确');
        }
    });

    //删除
    $('#deleteBanner').on('click',function(){
        var bannerId = $(this).attr('banner-id');
        var saveType = 'deleteBanner';
        $.ajax({
            url:'handler.html',
            type:'POST',
            dataType:'json',
            data:{
                saveType:saveType,
                bannerId:bannerId
            },
            success:function(data,status,xhr){
                if(data.status == 'success'){
                    $('#myModal').modal('hide');
                    window.location.href = '/banner/list.html';
                }else{
                    alert('删除失败');
                }
            }

        });
    });
    
    
    
    //新建、编辑
    $('#saveBanner,#saveEditBanner').on('click',function(){
        var flag = false;
        var reg = new RegExp("[a-zA-z]+://[^s]*");
        if($(this).attr('id') == 'saveBanner'){
            var bannerTitle = $.trim($('#bannerTitle').val());
            var bannerSrc = $.trim($('#bannerDiv img').attr('src'));
            var bannerUrl = $.trim($('#bannerUrl').val());
            var closeTime = $('#closeTime').val();
            var saveType = 'saveBanner';
            var useType = $('input:radio[name="useType"]:checked').val();
            var bannerId = '';
        }else if($(this).attr('id') == 'saveEditBanner'){
            var bannerTitle = $.trim($('#editBannerTitle').val());
            var bannerSrc = $.trim($('#editBannerDiv img').attr('src'));
            var bannerUrl = $.trim($('#editBannerUrl').val());
            var closeTime = $('#editBannerCloseTime').val();
            var useType = $('input:radio[name="useType"]:checked').val();
            var saveType = 'saveEditBanner';
            var bannerId = $(this).attr('banner-id');
        }

        if(bannerSrc.length != 0){
            flag = true;
        }else{
            flag = false;
            alert("请选择图片");
        }
        if(bannerUrl != ''){
            if(reg.test(bannerUrl)){
                
            }else{
                flag = false;
                alert("网址格式不正确!");
            }
        }
        if(flag == true){
            //ajax提交
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    bannerTitle:bannerTitle,
                    bannerSrc:bannerSrc,
                    bannerUrl:bannerUrl,
                    closeTime:closeTime,
                    useType:useType,
                    saveType:saveType,
                    bannerId:bannerId
                },
                success:function(data,status,xhr){
                    //console.log(JSON.stringify(data));
                    if(data.status == 'success'){
                        $('#myModal').modal('hide');
                        window.location.href = '/banner/list.html';
                    }else{
                        alert('保存失败');
                    }
                }
                
            });
        }
    });
    
    $(document).on('mouseleave click','div.editBanner,div.detailBanner',function(e){
        if(e.type == 'mouseleave'){
            $(this).css({
                'display':'none',
            })
        }else if(e.type == 'click'){
            var bannerId = $(this).attr('banner-id');
            var dealType = $(this).attr('class');
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    bannerId:bannerId,
                },
                success:function(data,status,xhr){
                    if(data.status == 'success'){
                        if(dealType == 'editBanner'){
                            console.log(data.bannerInfo);
                            $('#editBannerTitle').val(data.bannerInfo['title']);
                            $('#editBannerImage').attr('src',data.bannerInfo['image']);
                            $('#editBannerUrl').val(data.bannerInfo['url']);
                            $('#editBannerCloseTime').val(data.bannerInfo['close_time']);
                            $('#saveEditBanner').attr('banner-id',data.bannerInfo['id']);
                            $('#deleteBanner').attr('banner-id',data.bannerInfo['id']);
                            if(data.bannerInfo['type'] == 'app'){
                                $('#bannerWeb').attr('checked','');
                                $('#bannerApp').attr('checked','checked');
                            }else if(data.bannerInfo['type'] == 'web'){
                                $('#bannerApp').attr('checked','');
                                $('#bannerWeb').attr('checked','checked');
                            }
                        }else if(dealType == 'detailBanner'){
                            $('#detailBannerTitle').text(data.bannerInfo['title']);
                            $('#detailBannerImage').attr('src',data.bannerInfo['image']);
                            $('#detailBannerUrl').text(data.bannerInfo['url']);
                            $('#detailBannerCreateTime').text(data.bannerInfo['create_time']);
                            $('#detailBannerCloseTime').text(data.bannerInfo['close_time']);
                            $('#detailBannerUseType').text(data.bannerInfo['type']);
                        }
                    }
                }
            });
        }
    });

    $(document).on('mouseenter','.bannerImage',function(e){
        if(e.type == 'mouseenter'){
            //console.log("进入");
            var height = $(this).height();
            $(this).prev('div.editBanner,div.detailBanner').css({
                'line-height':height+'px',
                'display':'block',
                'cursor':'pointer'
            })
        }
    });

    $(document).on('mouseleave click','div.deleteImage',function(e){
        if(e.type == 'mouseleave'){
            $(this).css({
                'display':'none',
            })
        }else if(e.type == 'click'){
            if(window.confirm("确定删除?")){
                //先添加、再删除
                var parentId = $(this).parent().parent().attr('id');
                if(parentId == 'bannerDiv'){
                    $('#bannerDiv').append(addBannerDom);
                }else if(parentId == 'editBannerDiv'){
                    $('#editBannerDiv').append(addBannerDom);
                }
                $(this).parent().remove();
                //console.log($(this).parent().prev('div#coverImageDiv').get(0));
            }
        }
    });

    $(document).on('mouseenter','.bannerSrc',function(e){
        if(e.type == 'mouseenter'){
            //console.log("进入");
            var height = $(this).height();
            $(this).prev('div.deleteImage').css({
                'line-height':height+'px',
                'display':'block',
                'cursor':'pointer'
            })
        }
    });







</script>
<?php $this->_endblock(); ?>