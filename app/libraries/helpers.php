<?php 

/**
 * Display the layout for the given `device()` and a given theme.
 *
 * This method will locate the \c blade that the client is requesting, this\n
 * method will also prevent the use of multiple template with the same layout.
 *
 * @param      string          $path   The path
 * @param      boolean|string  $theme  The theme (Optional)
 *
 * @throws     Exception       No template found
 *
 * @return     string          The template
 */
if(!function_exists('template')) {
    function template($path = '', $theme = false) {
        // clean up the values of the $path
        $path    = implode('.', (array_filter(explode('.', $path))));
        $folders = ['v1']; // default folders

        if($theme) {
            $folders[] = $theme;
            $folders = array_reverse($folders);
        }

        // map all the values of the $folders and replace it with
        // the complete path including the file
        $template = array_map(function($folder) use ($path){
            return $folder.'.'.$path;

            // if the $theme is set, then the system needs to iterate the $folders
            // again to get the folders inside the theme folder
        }, $folders);
        
        // if the $theme is set, then the system needs to iterate the $folders
        // again to get the folders inside the theme folder
        $paths = array_filter($template, function($theme){
            return View::exists($theme); // check if the folder/file exists
        });

        $template = array_shift($paths);

        if(!$template) { // if the system detects that the file is not exists
                        // throw a new Exception error, included the file
                        // requested
            throw new Exception("No template found for {$path}", 1);
        }

        return $template;
    }
}

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        $devicePath = config('web.version');
        
        return View::make($devicePath.'.'.$view, $data, $mergeData);
    }
}

if (! function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return Config::get();
        }
        
        if (is_array($key)) {
            return Config::set($key);
        }
        
        return Config::get($key, $default);
    }
}

if (! function_exists('clean_encoding')) {
    function clean_encoding($text, $type = 'standard')
    {
        // http://alanwhipple.com/2011/06/04/php-clean-encoding-issues-smart-curly-quotes-em-dashes/

        // determine the encoding before we touch it
        $encoding = mb_detect_encoding($text, 'UTF-8, ISO-8859-1');

        // The characters to output
        if ($type == 'standard') {
            // run of the mill standard characters
            $outp_chr = array('...', "'", "'", '"', '"', '•', '-', '-');
        } elseif ($type == 'reference') {
            // decimal numerical character references
            $outp_chr = array('&#8230;', '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8226;', '&#8211;', '&#8212;');
        }

        //replace utf-8
        $find = array('â€œ', 'â€™', 'â€¦', 'â€”', 'â€“', 'â€˜', 'Ã©', 'Â', 'â€¢', 'Ëœ', 'â€', 'Ã¨', 'Ãª', 'Ã±', 'Ã‰'); // en dash
        $replace = array('“', '’', '…', '—', '–', '‘', 'é', '', '•', '˜', '”', 'è', 'ê', 'ñ', 'É');

        // The characters to replace (purposely indented for comparison)
        // UTF-8 hex characters
        $utf8_chr = array("\xe2\x80\xa6", "\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", '\xe2\x80\xa2', "\xe2\x80\x93", "\xe2\x80\x94");

        // ASCII characters (found in Windows-1252)
        $winc_chr = array(chr(133), chr(145), chr(146), chr(147), chr(148), chr(149), chr(150), chr(151));

        // First, replace UTF-8 characters.
        $text = str_replace($utf8_chr, $outp_chr, $text);

        // Next, replace Windows-1252 characters.
        $text = str_replace($winc_chr, $outp_chr, $text);

        // even if the string seems to be UTF-8, we can't trust it, so convert it to UTF-8 anyway
        $text = mb_convert_encoding($text, 'UTF-8', $encoding);

        $text = str_replace($find, $replace, $text);

        return $text;
    }
}