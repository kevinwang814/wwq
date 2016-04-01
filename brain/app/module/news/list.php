<?php
    //获取新闻列表
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
    $newsList = importExtend('News')->getList($option);
    $newsCount = importModel('News')->getCount($option2);
    $pager = new Ext_Pager($page,$newsCount,U('news/list'),$page_size);
    $view = Core_View::getInstance();
    $view->assign('pager', $pager->show(3));
    $view->assign('page', $page);
    $view->assign('page_size', $page_size);
    $view->assign('newsList',$newsList);
    $view->assign('newsCount',$newsCount);
    $view->display('news/list');