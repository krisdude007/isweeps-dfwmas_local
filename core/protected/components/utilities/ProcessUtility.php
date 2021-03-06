<?php
class ProcessUtility{
    public static function findProcess($consoleCommand){
        $client = Yii::app()->params['client'];
        $find = "ps ax | grep {$client}_console";
        $processes = exec($find,$output);
        foreach($output as $k=>$v){
            if(preg_match('/^\s*(\d+).*'.$consoleCommand.'/',$v,$matches)){
                return $matches[1];
            }
        }
        return false;
    }

    public static function killProcess($consoleCommand){
        $process = self::findProcess($consoleCommand);
        if($process){
            $kill = exec("kill -9 {$process}");
            return true;
        }
        return false;
    }
    public static function startProcess($consoleCommand){
        $process = self::findProcess($consoleCommand);
        if(!$process){
            $client = Yii::app()->params['client'];
            $command = "php -q {$client}_console.php $consoleCommand > /dev/null 2>/dev/null & ";
            exec($command);
            return true;
        }
        return false;
    }

}
?>
