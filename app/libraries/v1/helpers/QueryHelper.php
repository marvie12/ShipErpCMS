<?php

class QueryHelper extends BaseHelper
{
    /**
     * Returns sort query
     *
     * @param      <type>  $field  The field in es index (eg. vehicle_name or vehicle_name.keyword)
     * @param      <type>  $order  The order (asc or desc)
     *
     * @return     string  ( description_of_the_return_value )
     */
    public static function sort($field, $order)
    {
        if ($field && $order) {
            return json_decode('{"'.$field.'":{"order":"'.$order.'"}}', true);
        }

        return [];
    }

    public static function buildFiltersQuery($keywords, $filterType, $makes, $bodyTypes, $price, $fuelTypes, $transmissions)
    {
        if ($keywords || $filterType || $makes || $bodyTypes || $price || $fuelTypes || $transmissions) {
            $query = self::buildFilterQuery($keywords, $filterType);
            $makesQuery = self::buildFilterQuery($makes, 'make_name');
            $bodyTypeQuery = self::buildFilterQuery($bodyTypes, 'body_type');
            $priceQuery = self::buildFilterQuery($price, 'price');
            $fuelTypeQuery = self::buildFilterQuery($fuelTypes, 'fuel_type');
            $transmissionQuery = self::buildFilterQuery($transmissions, 'transmission');

            $parentQuery = '{"bool": {"must": ['.$query.','.$makesQuery.','.$bodyTypeQuery.', '.$priceQuery.', '.$fuelTypeQuery.', '.$transmissionQuery.', {"bool": {"must": [{"term": {"status": "1"}}]}}]}}';
        } else {
            $parentQuery = '{"bool": {"must": [{"term": {"status": "1"}}]}}';
        }

        return json_decode($parentQuery, true);
    }

    public static function buildFilterQuery($keywords, $filterType)
    {
        $nullQuery = '{"bool": {"should": []}}';
        $query = '';

        if ($keywords) {
            $keywords = json_decode($keywords, true);
            $keywordsLength = count($keywords);

            if ($filterType == 'price') {
                $minPrice = $keywords['min'];
                $maxPrice = $keywords['max'];
                $maxPrice = ($maxPrice != 0) ? ',"lt": "'.$maxPrice.'"' : '';
                $query = '{"range": {"price": {"gt": "'.$minPrice.'"'.$maxPrice.'}}}';
            } else {
                foreach ($keywords as $key => $keyword) {
                    $query .= '{"wildcard": {"'.$filterType.'.keyword": "*'.$keyword.'*"}}';
                    $query .= ($keywordsLength != ($key+1)) ? ',' : '';
                }
            }

            $query = '{"bool": {"should": ['.$query.']}}';

        } else {
            $query = $nullQuery;
        }

        return $query;
    }

    public static function buildSingleQuery($keywords, $filterType, $match)
    {
        $keywords = urldecode($keywords);
        if ($match == 'wildcard') {
            $keywords = '*'.$keywords.'*';
        }
        $query = '{"bool":{"must":[{"'.$match.'":{"'.$filterType.'.keyword":"'.$keywords.'"}}, {"term": {"status": "1"}}] }}';
        return json_decode($query, true);
    }

    public static function buildMultipleQuery($keywords, $filterType, $match, $operator = 'must')
    {
        $keywords = json_decode($keywords, true);
        $keywordsLength = count($keywords);
        $filterType = json_decode($filterType, true);
        $match = json_decode($match, true);
        $query = '';

        foreach ($keywords as $key => $keyword) {
            $query .= '{"'.$match[$key].'":{"'.$filterType[$key].'":"'.$keyword.'"}}';
            $query .= ($keywordsLength != ($key+1)) ? ',' : '';
        }

        $parentQuery = '{"bool": {"must": ['.$query.']}}';
        
        return json_decode($parentQuery, true);
    }
}
