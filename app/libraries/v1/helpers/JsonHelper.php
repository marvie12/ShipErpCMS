<?php

/**
*Writes json file to public folders
*/
class JsonHelper extends BaseHelper
{
    /**
     * { function_description }
     *
     * @param      string  $path      /path/here/
     * @param      string  $filename  filename
     * @param      json    $data      data
     */
    public static function write($path, $filename, $data)
    {
        $path = getenv('WEBSITE_PUBLIC_PATH').$path;

        if (!File::isDirectory($path)) {
            try {
                File::makeDirectory($path, 0777, true, true);
            } catch (Illuminate\Exception $e) {
            }
        }

        file_put_contents($path.$filename.'.json', $data);
    }
}
