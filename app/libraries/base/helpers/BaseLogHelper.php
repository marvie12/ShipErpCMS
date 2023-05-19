<?php

class BaseLogHelper
{
    public static function createLog($text, $fileName = '')
    {
        $customLogFilePath = storage_path().'/logs/customLogs.txt';
        $extraLogFilePath = storage_path().'/logs/'.$fileName.'.txt';

        $text = date('[Y-m-d h:i:s]').' '.$text."\n";

        file_put_contents($customLogFilePath, $text, FILE_APPEND | LOCK_EX);

        if ($fileName) {
            file_put_contents($extraLogFilePath, $text, FILE_APPEND | LOCK_EX);
        }
    }
}
