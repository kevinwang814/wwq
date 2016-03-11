<?php

$view = Core_View::getInstance();
$view->assign('param', 'done');
$view->display('api/doc');

