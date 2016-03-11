<?php
class Model_Admin extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "admin",
            'orderby'   =>  'id'
        ));
    }
}
?>