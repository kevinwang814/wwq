<?php
class Model_News extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "news",
            'orderby'   =>  'id'
        ));
    }
}
?>