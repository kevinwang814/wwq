<?php
class Model_Training extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "training",
            'orderby'   =>  'id'
        ));
    }
}
?>