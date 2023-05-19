<?php

class StringHelper extends BaseHelper
{
    /**
     * Make URL SEO friendly
     * @param  string $string     url
     * @param  string $replaceStr string to replace spaces
     * @return string             url
     */
    public function make_seo_url_friendly($string, $replaceStr = '-')
    {
        //Lower case everything
        $string = strtolower($string);

        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", '', $string);

        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", ' ', $string);

        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", $replaceStr, $string);

        return $string;
    }

    /**
     * Sorting header
     * @param  string $field     field
     * @param  string $title     title
     * @param  string $routeName route name
     * @return string            link to route
     */
    public static function makeSortingHeader($field, $title, $routeName='dashboard.index'){
        $urlParams = Input::except('page', '_token', 'sort', 'asc');
        array_filter($urlParams);
        $sort = ($field == Input::get('sort')) ? Input::get('asc', 0) : 0;
        $urlParams['sort'] = $field;
        $sortDisplayText = $sort ? "Sort {$field} Descending" : "Sort {$field} Ascending";
        if(!$sort){
            $sortClass = "sort-desc";
            if($field == Input::get('sort')) $title = $title ." &#9660;";
        }else{
            $sortClass = "sort-asc";
            if($field == Input::get('sort')) $title = $title ." &#9650;";
        }

        $sort = $sort ? 0 : 1;
        $urlParams['asc'] = $sort;

        return link_to_route($routeName, $title, $urlParams, ['title'=>$sortDisplayText, 'class'=>$sortClass]);
    }
}
