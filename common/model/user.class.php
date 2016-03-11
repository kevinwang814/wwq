<?php
class Model_User extends Core_Model
{
    function __construct()
    {
        $this->setModel(array(
            'table_name' => "user",
            'orderby'   =>  'id'
        ));
    }
}
?>