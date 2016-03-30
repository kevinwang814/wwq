<?php
class Model_Farm extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "farm",
            'orderby'   =>  'id'
        ));
    }
}
?>