<?php

class Core_Debug
{
    
    public static function getBackTrace($nTraceLine = 1)
    {
        $backtrace = debug_backtrace();
    
        $strBackTrace = '';
        if (!is_null($nTraceLine))
        {
            $strBackTrace = $backtrace[$nTraceLine]['file'] . '(' . $backtrace[$nTraceLine]['line'] . ')';
        }
        else
        {
            foreach ($backtrace as $nTraceLine => $arrLine)
            {
            	   $strBackTrace .= (isset($arrLine['file']) ? $arrLine['file'] : '')
            	   . (isset($arrLine['line']) ? '(' . $arrLine['line'] . ')' : '') . "\n";
            }
        }
    
        $strBackTrace .= ' - Memory: ' . memory_get_usage(true);
    
        return $strBackTrace;
    }
    
    public static function dump($var = 'Halabuda', $nTraceLine = 1)
    {
        $strBackTrace = '';
        if (!is_null($nTraceLine))
        {
            $strBackTrace = self::getBackTrace($nTraceLine);
        }
        
        echo($strBackTrace);
        
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        if (PHP_SAPI == 'cli') {
            $output = PHP_EOL
            . PHP_EOL . $output
            . PHP_EOL;
        } else {
            if(!extension_loaded('xdebug')) {
                $output = htmlspecialchars($output, ENT_QUOTES);
            }
        
            $output = '<pre>'
                . $output
                . '</pre>';
        }
        
        echo($output);
    }
    
    public static function dumpDie($var = 'Halabuda', $nTraceLine = 2)
    {
        self::dump($var, $nTraceLine);
        die();
    }
}