<?php
class System_Log {
    static $log = array();
    static function query($sql) {
      System_Log::logit("Consulta", $sql);
    }
    
    static function logit($desc, $log) {
        if(is_array($log) || is_object($log)) $log = print_r($log, true);
        System_Log::$log[] =array('desc' => $desc, 'log'=>$log, 'data' => date("Y-m-d H:i:s"));
    }
    
    static function salva() {
        $base = System_CONFIG::get('base');
        $dir = System_CONFIG::get('config_dir');
        $dir = empty($dir) ? "/log" : $dir;
        
        if(is_dir($base.$dir) && count(System_Log::$log) > 0) {
            $str = "";
            foreach(System_Log::$log as $log) {
                $str.="\n\n\n";
                $str.=print_r(System_Log::$log, 1);
            }
            
            $fileName = ".txt";
            $i = 1;
            while(file_exists($base.$dir."/log_".date("Ymd_His").$fileName)) {
                $fileName = "_".$i.".txt";
            }
            
            
            file_put_contents($base.$dir."/log_".date("Ymd_His").$fileName, $str);
        }
    }
    
}