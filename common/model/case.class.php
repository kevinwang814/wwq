<?php
class Model_Case extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "case",
            'orderby'   =>  'id'
        ));
    }
}
?>