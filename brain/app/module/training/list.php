<?php
    //获取列表
    $page = getv_t('page',1);
    $page_size = 10;
    $offset = ($page-1)*$page_size;
    $option = array(
        'offset' => $offset,
        'limit' => $page_size,
        'orderby' => 'update_time DESC',
        'status' => 'enabled',
    );
    $option2 = array(
        'condition' => 'status = "enabled"'
    );
    $trainingList = importExtend('Training')->getList($option);
    $trainingCount = importModel('Training')->getCount($option2);
    $pager = new Ext_Pager($page,$trainingCount,U('training/list'),$page_size);
    $view = Core_View::getInstance();
    $view->assign('pager', $pager->show(3));
    $view->assign('page', $page);
    $view->assign('page_size', $page_size);
    $view->assign('trainingList',$trainingList);
    $view->assign('trainingCount',$trainingCount);
    $view->display('training/list');