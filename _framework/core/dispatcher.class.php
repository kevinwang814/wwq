<?php
/**
 * 路由分发类,分发请求到相应的处理脚本
 */
class Core_Dispatcher
{

    public $_moduleRootPath;

    public $_module;

    public function  __construct($moduleRootPath = '')
    {
        $this->_moduleRootPath = $moduleRootPath;
        //$this->_module = isset($_GET['method']) ? $this->SafeModule($_GET['method']) : '';
        if($this->_module == '')
        {
            $this->_module = isset($_GET['mod']) ? $this->SafeModule( $_GET['mod'] ) : '';
            file_put_contents('C:\Users\Administrator\Desktop\back_stage3.2\data.log', $this->_moduleRootPath.'---'.$this->_module."wzb\r\n",FILE_APPEND);
        }
    }

    public function ExplodeModule( $module )
    {
        return explode( '.', $module );
    }

    public function SafeModule( $module )
    {
        $module = trim( $module );
        $module = str_replace( array( '/', '\\', '../', '..\\' ), '', $module );
        $module = preg_replace( array( '/\.{2,}/is' ), '', $module );
        return $module;
    }

    public function BeforeRun()
    {

    }

    public function Run( $quoteData = array() )
    {
        $this->BeforeRun();
        $moduleList = $this->ExplodeModule( $this->_module );
        $modulePath = $this->_moduleRootPath . '/' . implode( '/', $moduleList ) . '.php';

        if ( !is_file( $modulePath ) )
        {
            $modulePath = $this->_moduleRootPath . '/' . implode( '/', $moduleList ) . '/index.php';
            if ( !is_file( $modulePath ) )
            {
                header("HTTP/1.0 404 Not Found");
                show_404();
                exit();
            }
        }

        if(!empty ($quoteData))
        {
            @extract( $quoteData );
        }
        require_once $modulePath;
    }
}
