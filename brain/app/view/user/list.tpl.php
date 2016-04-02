<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
        <!-- 新闻动态管理内容【开始】-->
        <section id="movie-content" style="margin-top: 50px">
            <div class="container-fluid">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title col-md-3 col-xs-3 col-sm-3" >用户管理</h3>
                            <div class="col-md-2 col-xs-3 col-sm-3">
                                <button type="button" class="btn btn-default" onclick="window.location.href='/user/add.html'">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    添加用户
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-6 col-sm-6">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="查找用户">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                              </span>
                                    </div><!-- /input-group -->
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tr class="active">
                                    <th>用户id</th>
                                    <th>用户姓名</th>
                                    <th>用户电话</th>
                                    <th>用户邮箱</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                <?php if(isset($userList) && is_array($userList) && isset($page) && isset($page_size)){
                                    $dom = '';
                                    $i = ($page-1)*$page_size+1;
                                    foreach ($userList as $userInfo){
                                        $i++;
                                        $dom .= '<tr><td>'.$i.'</td>';
                                        $dom .= '<td>'.$userInfo['name'].'</td>';
                                        $dom .= '<td>'.$userInfo['mobile_num'].'</td>';
                                        $dom .= '<td>'.$userInfo['email'].'</td>';
                                        $dom .= '<td>'.$userInfo['update_time'].'</td>';
                                        $dom .= '<td>';
                                        $dom .= '<button type="button" class="btn btn-primary update" onclick="window.location.href=\''.U('user/detail',array('id'=>$userInfo['id'])).'\'">';
                                        $dom .= '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>修改</button>';
                                        $dom .= '<button type="button" class="btn btn-danger delete deleteUser" user-id='.$userInfo['id'].'>';
                                        $dom .= '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>删除</button>';
                                        $dom .= '</td><tr>';
                                    }
                                    echo $dom;
                                    }
                                ?>
                            </table>
                            <?php echo "<div style='font-size:13px;color:#8D8D8D'>共有<span style='color:red'>".$userCount."</span>条数据</div>"?>
                            <div class="datatable-pagination">
                                <?php echo $pager;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 新闻动态管理内容【结束】-->
    </div>
    <!-- ./main-content end.-->

</section>
<!-- 右边内容【end】-->
<script>
    $(function () {
        $('.menu:eq(0) .second-nav').show();
        $('.menu:eq(0) .menu-content').addClass('active');
        $('.menu:eq(0) .menu-content span').addClass('cur');
        $('.menu:eq(0) .second-nav li:eq(0)').addClass('active');
    });
    
    
    
    $(document).on('click','.deleteUser',function(){
        var userId = $(this).attr('user-id');
        if(window.confirm('删除将是不可修复的，确定删除?')){
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    userId:userId,
                    requestType:'deleteUser'
                },
                success:function(data,status,xhr){
                    if(data.status == 'success'){
                        alert("操作成功!");
                        window.location.href = '/user/list.html';
                    }
                },
            });
        }
    });
</script>

<?php $this->_endblock(); ?>