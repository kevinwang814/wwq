<?php
    $page = getv_t('page', 1);
    $page_size = 10;
    $offset = ($page - 1) * $page_size;
    $option = array(
        //'orderby'=>'id ASC',
        'offset' => $offset,
        'limit' => $page_size,
        'status'=>'enabled',
    );
    $collegeList = importExtend('College')->getList($option);
    $collegeCount = importModel('College')->getCount();
    $pager = new Ext_Pager($page, $collegeCount, U('college/list'), $page_size);
    $view = Core_View::getInstance();
    $view->assign('collegeList',$collegeList);
    $view->assign('collegeCount',$collegeCount);
    $view->assign('pager', $pager->show(3));
    $view->display('college/list');