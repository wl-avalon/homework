<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/2
 * Time: 下午3:35
 */

namespace app\modules\components;


class SPLog
{
    private static $logFile = null;

    public static function notice($test){
        if(is_null(self::$logFile)){
            $logFilePath = dirname(__DIR__) . "/logs/sp-ui.log";
            self::$logFile = fopen($logFilePath, 'a');
        }
        $test .= "\n";
        fwrite(self::$logFile, $test);
    }

    public static function warning($test){
        if(is_null(self::$logFile)){
            $logFilePath = dirname(__DIR__) . "/logs/sp-ui.wf";
            self::$logFile = fopen($logFilePath, 'a');
        }
        $test .= "\n";
        fwrite(self::$logFile, $test);
    }
}