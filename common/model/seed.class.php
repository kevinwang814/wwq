<?php
class Model_Seed extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "seed",
            'orderby'   =>  'id'
        ));
    }
}
?>