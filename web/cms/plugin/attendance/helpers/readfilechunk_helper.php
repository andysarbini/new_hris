<?php
/**/
function file_get_contents_chunked($file,$chunk_size,$callback)
{
    try
    {
        $handle = fopen($file, "r");
        $i = 0;
        $x = 0;

        $chunk = array();
        while (!feof($handle)) {
            while ($row = fgets($handle)) {
                // can parse further $row by usingstr_getcsv
                $x ++;
                $chunk[] = $row;
                if ($x == $chunk_size) {
                    call_user_func_array($callback, array($chunk, &$handle, $i));
                    unset($chunk);
                    $x = 0;
                }         
            }
        }
        fclose($handle);
    }
    catch(Exception $e)
    {
         trigger_error("file_get_contents_chunked::" . $e->getMessage(),E_USER_NOTICE);
         return false;
    }
    return true;
}


function ttt($a){
	
	echo $a . "\r\n";
	
}

file_get_contents_chunked('test.csv', 1, "ttt");
