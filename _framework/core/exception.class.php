<?php
/**
 * 异常处理
 */
class Core_Exception extends Exception
{
    public function __construct($message, $code=0, $previous=null)
    {
        parent::__construct($message, $code);

        $this->traceString = $this->getTraceAsString();

        if(is_array($previous))
        {
            $this->file = $previous['errfile'];
            $this->line = $previous['errline'];
        }
        else if(is_object($previous))
        {
            $this->file = $previous->getFile();
            $this->line = $previous->getLine();
            $this->traceString = $previous->getTraceAsString();
        }
        /*$debugModel = importModel('Recharge_Debug');
        $debugModel->create(array('info'=>$this->traceString));
          */
         
    }

    public function __toString()
    {
        include FW_PATH . '/tpl/exception.tpl.php';
        return '';
    }
}

?>