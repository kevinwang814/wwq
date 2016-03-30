<?php
class Model_Tool extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "tool",
            'orderby'   =>  'id'
        ));
    }
}
?>