<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <a href="#">
                    <span class="fa fa-users"></span>
                    <span>用户管理</span>
                    <span class="glyphicon glyphicon-menu-right" style="font-size:12px;"></span>
                </a>
                <a href="#">
                    <span>学校管理</span>
                </a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    学校管理
                </div>
                <div class="panel-body">
                    <a class="btn btn-primary" role="button" id="addCollege" data-toggle="modal" data-target="#collegeModal">新增学校</a>
                </div>
                <form class="form-inline" style="margin-bottom: 10px">
                    &nbsp;&nbsp;
                    <div class="form-group">
                      <label>地区:</label>
                      <input type="text" class="form-control" id="filterArea" placeholder="北京">
                    </div>
                    &nbsp;&nbsp;
                    <div class="form-group">
                      <label>学校:</label>
                      <input type="text" class="form-control" id="filterCollege" placeholder="学校名称">
                    </div>
                    <button type="submit" class="btn btn-default" id="submitFilter">筛选</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    学校列表
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>地区</th>
                            <th>学校</th>
                            <th>编辑</th>
                        </tr>
                        <?php
                            if(isset($collegeList) && is_array($collegeList)){
                                $html = '';
                                foreach($collegeList as $collegeInfo){
                                    $html .= '<tr>';
                                    $html .= '<td>'.$collegeInfo['areaName'].'</td>';
                                    $html .= '<td>'.$collegeInfo['collName'].'</td>';
                                    $html .= '<td><button id="detailCollege" college-name="'.$collegeInfo['collName'].'" data-toggle="modal" data-target="#collegeModal" class="btn btn-info btn-sm" colloge-id='.$collegeInfo['collId'].' area-id="'.$collegeInfo['areaId'].'" parent-id="'.$collegeInfo['parentId'].'">详情</button>';
                                    $html .= ' <button id="deleteCollege" class="btn btn-danger btn-sm" college-id='.$collegeInfo['collId'].'>删除</button>';
                                    $html .= '</td></tr>';
                                }
                                echo $html;
                            }
                        ?>
                        
                    </table>
                    <?php echo "<div style='font-size:13px;color:#8D8D8D'>共有<span style='color:red'>".$collegeCount."</span>条数据</div>"?>
                    <div class="datatable-pagination">
                        <?php echo $pager;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="collegeModal" tabindex="-1" role="dialog" aria-labelledby="collegeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="collegeModalLabel">新增学校</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>地区:</label>
                <select id="prov" class="form-control">
                    
                </select>
            </div>
            <div class="form-group">
                <label>城市:</label>
                <select id="city" class="form-control">
                </select>
            </div>
            <div class="form-group">
                <label>学校:</label>
                <input type="text" class="form-control" id="collName" placeholder="填写学校名称">
            </div>
          </div>
          <div class="modal-footer">
            <button id="saveCollege" type="button" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on('click','#deleteCollege',function(){
            var collegeId = $(this).attr('college-id');
            if(window.confirm('删除将是不可修复的，确定删除?')){
                $.ajax({
                    url:'handler.html',
                    type:'POST',
                    dataType:'json',
                    data:{
                        collegeId:collegeId,
                        dealType:'deleteCollege'
                    },
                    success:function(data,status,xhr){
                        if(data.status == 'success'){
                            alert("操作成功!");
                            window.location.href = '/college/list.html';
                        }
                    },
                });
            }
        });
        
        $(document).on('click','#addCollege',function(){
            $('#collegeModalLabel').text('新增学校');
            $('#prov').html('');
            $('#city').html('');
            $('#collName').val('');
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    dealType:'addCollege',   //请求类型(新增大学)
                    level:0                  //请求等级(获取省份)
                },
                success:function(data,status,xhr){
                    if(data.status == 'success'){
                        //console.log(JSON.stringify(data.cityList));
                        var provList = data.provList;
                        var dom1 = '';
                        for(var key in provList){
                            dom1 += '<option value="'+provList[key]['id']+'">'+provList[key]['name']+'</option>';
                        }
                        $('#prov').html(dom1);
                        var cityList = data.cityList;
                        var dom2 = '<option></option>';
                        for(var key in cityList){
                            dom2 += '<option value="'+cityList[key]['id']+'">'+cityList[key]['name']+'</option>';
                        }
                        $('#city').html(dom2);
                    }
                },
            });
        });
        
        $(document).on('change','#prov',function(){
            var provId = $('option:selected',this).val();
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    dealType:'addCollege', //请求类型：新增大学
                    level:1,                //请求等级：获取市区
                    provId:provId
                },
                success:function(data,status,xhr){
                    if(data.status == 'success'){
                        var cityList = data.cityList;
                        var dom = '<option></option>';
                        for(var key in cityList){
                            dom += '<option value="'+cityList[key]['id']+'">'+cityList[key]['name']+'</option>';
                        }
                        $('#city').html(dom);
                    }
                },
            });
        });
        
        
        $(document).on('click','#saveCollege',function(){
            var areaId = $('#prov option:selected').val();
            var cityName = $('#city option:selected').text();
            var collName = $.trim($('#collName').val());
            var collId = $('#collName').attr('coll-id');
            if(collName == ''){
                alert("学校名称必填选项");
                return false;
            }
            if(cityName != '市辖区' && cityName != '市辖县' && cityName != ''){
                areaId = $('#city option:selected').val();
            }
            if(collId == undefined){
                $.ajax({
                    url:'handler.html',
                    type:'POST',
                    dataType:'json',
                    data:{
                        dealType:'saveCreate', //请求类型：保存大学
                        areaId:areaId,          //area_id
                        name:collName           //大学名称
                    },
                    success:function(data,status,xhr){
                        if(data.status == 'success'){
                            alert("操作成功!");
                            window.location.href = '/college/list.html';
                        }
                    },
                });
            }else{
                $.ajax({
                    url:'handler.html',
                    type:'POST',
                    dataType:'json',
                    data:{
                        dealType:'saveUpdate', //请求类型：保存大学
                        areaId:areaId,          //area_id
                        name:collName,           //大学名称
                        collId:collId
                    },
                    success:function(data,status,xhr){
                        if(data.status == 'success'){
                            alert("操作成功!");
                            window.location.href = '/college/list.html';
                        }
                    },
                });   
            }

        });
        
        $(document).on('click','#detailCollege',function(){
            $('#collegeModalLabel').text('学校详情');
            $('#prov').html('');
            $('#city').html('');
            $('#collName').val('');
            var collId = $(this).attr('colloge-id');
            var areaId = $(this).attr('area-id');
            var parentId = $(this).attr('parent-id');
            var collName = $(this).attr('college-name');
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    dealType:'detailCollege',
                    //collId:collId,
                    areaId:areaId,
                    parentId:parentId
                },
                success:function(data,status,xhr){
                    if(data.status == 'success'){
                        //console.log(JSON.stringify(data));
                        var provList = data.provList;
                        var dom1 = '';
                        for(var key in provList){
                            if(data.provId == provList[key]['id']){
                                dom1 += '<option selected="selected" value="'+provList[key]['id']+'">'+provList[key]['name']+'</option>';                                 
                            }else{
                                dom1 += '<option value="'+provList[key]['id']+'">'+provList[key]['name']+'</option>';                            
                            }

                        }
                        $('#prov').html(dom1);
                        var cityList = data.cityList;
                        var dom2 = '<option></option>';
                        for(var key in cityList){
                            if(data.cityId == cityList[key]['id']){
                                dom2 += '<option selected="selected" value="'+cityList[key]['id']+'">'+cityList[key]['name']+'</option>';
                            }else{
                                dom2 += '<option value="'+cityList[key]['id']+'">'+cityList[key]['name']+'</option>';
                            }
                            
                        }
                        $('#city').html(dom2);
                        $('#collName').attr('coll-id',collId).val(collName);
                    }
                },
            });
        });
        
        
        
        $(document).on('click','#submitFilter',function(){
            var filterArea = $('#filterArea').val();
            var filterCollege = $('#filterCollege').val();
            if(filterArea != '' || filterCollege != ''){
                $.ajax({
                    url:'handler.html',
                    type:'POST',
                    dataType:'json',
                    data:{
                        dealType:'filterCollege', //请求类型：新增大学
                        filterArea:filterArea,
                        filterCollege:filterCollege
                    },
                    success:function(data,status,xhr){
                        if(data.status == 'success'){
                            var cityList = data.cityList;
                            var dom = '<option></option>';
                            for(var key in cityList){
                                dom += '<option value="'+cityList[key]['id']+'">'+cityList[key]['name']+'</option>';
                            }
                            $('#city').html(dom);
                        }
                    },
                });
            }
    });
});
</script>
<?php $this->_endblock(); ?>