<?php
/**
 * 可以产生一个唯一的数字
 */
class Helper_Incr
{   
    /**
     * 返回一个 INCR 值，INCR 值的范围是 [0, $max)。
     * 对于同一个 $key，该函数可以保证在操作系统级别内，每次调用此函数都能得到不同的值，不会出现两个进程同时调用此函数而得到相同的值的情况（除非有超过 $max 个进程同时调用此函数）
     * 
     * @param string    INCR 值的名字
     * @param int       INCR 最大的增量，返回的 INCR 值不大于此数字
     */
    public static function get($key, $max = 1000) {
        $path = C('helper_incr_dir') . '/' . $key;
        
        if (!file_exists(C('helper_incr_dir'))) {
            mkdir(C('helper_incr_dir'));
        }
        if (!file_exists($path)) {
            touch($path);
        }
        
        /// 获取锁
        $sem = sem_get(ftok($path, C('host_id')));
        sem_acquire($sem);
        
            /// 使用 fopen 系列函数，因为效率比 file_get_content 函数高
            $fp = fopen($path, "r+");
            
            if ($fp === false) {
                sem_release($sem);
                    
                throw new Exception('无法打开文件：' . $path);
            }
            
            $incr = (int)fread($fp, filesize($path) + 1);
            $incr++;
            $incr %= $max;
            
            rewind($fp);
            fwrite($fp, $incr);
            fclose($fp);
        
        /// 解锁
        sem_release($sem);
        
        return $incr;
    }
}
?>
