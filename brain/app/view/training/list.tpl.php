<?php $this->_extends('_layout/default'); ?>
<?php $this->_block('wapper'); ?>
<div id="main-content">
    <!-- 新闻动态管理内容【开始】-->
    <section id="movie-content" style="margin-top: 50px">
        <div class="container-fluid">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="panel-title col-md-1 col-xs-3 col-sm-3" >培训管理</h3>
                        <div class="col-md-2 col-xs-3 col-sm-3">
                            <button type="button" class="btn btn-default" onclick="window.location.href='/training/add.html'">
                                <span class="glyphicon glyphicon-plus"></span>
                                添加培训内容
                            </button>
                        </div>
                        <div class="col-md-2 col-xs-6 col-sm-6">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="查找培训内容">
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
                                <th>培训id</th>
                                <th>培训标题</th>
                                <th>培训更新时间</th>
                                <th>培训管理</th>
                            </tr>
                            <?php
                                if(isset($trainingList) && is_array($trainingList) && isset($page) && isset($page_size)){
                                    $dom = '';
                                    $i = ($page-1)*$page_size+1;
                                    foreach ($trainingList as $trainingInfo) {

                                        $dom .= '<tr>';
                                        $dom .= '<td>'.$i.'</td>';
                                        $dom .= '<td>'.$trainingInfo['title'].'</td>';
                                        $dom .= '<td>'.$trainingInfo['update_time'].'</td>';
                                        $dom .= '<td><button type="button" class="btn btn-primary update" onclick="window.location.href=\''.U('training/detail',array('id'=>$trainingInfo['id'])).'\'">';
                                        $dom .= '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>修改</button>';
                                        $dom .= '<button type="button" class="btn btn-danger delete deleteTraining" training-id='.$trainingInfo['id'].'>';
                                        $dom .= '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>删除';
                                        $dom .= '</button></td>';
                                        $dom .= '</tr>';
                                        $i++;
                                    }
                                    echo $dom;
                                }
                            ?>
                        </table>
                        <?php echo "<div style='font-size:13px;color:#8D8D8D'>共有<span style='color:red'>".$trainingCount."</span>条数据</div>"?>
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
        $('.menu:eq(3) .second-nav').show();
        $('.menu:eq(3) .menu-content').addClass('active');
        $('.menu:eq(3) .menu-content span').addClass('cur');
        $('.menu:eq(3) .second-nav li:eq(0)').addClass('active');
    });
    
    $(document).on('click','.deleteTraining',function(){
        var trainingId = $(this).attr('training-id');
        if(window.confirm('删除将是不可修复的，确定删除?')){
            $.ajax({
                url:'handler.html',
                type:'POST',
                dataType:'json',
                data:{
                    trainingId:trainingId,
                    requestType:'deleteTraining'
                },
                success:function(data,status,xhr){
                    if(data.status == 'success'){
                        alert("操作成功!");
                        window.location.href = '/training/list.html';
                    }
                },
            });
        }
    });
</script>
<?php $this->_endblock();