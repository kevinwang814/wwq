  <?php
    //获取相关信息
    //1、获取农场主，2、获取种子，3、获取工具
    /*$farmerList = importModel('Farm')->getList(array('condition'=>'status="enabled"'));
    $seedList = importExtend('Seed')->getList();
    $toolList = importExtend();*/
    $view = Core_View::getInstance();
    //$view->assign('farmerList',$farmerList);
    //$view->assign('seedList',$seedList);
    //$view->assign('toolList',$toolList);
    $view->display('farm/add');