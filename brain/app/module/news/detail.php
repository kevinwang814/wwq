<?php
    $id = getv_t('id');
    $view = Core_View::getInstance();
    $view->assign('id',$id);
    $view->display('news/detail');