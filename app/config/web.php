<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Class WebsiteConfig
    |--------------------------------------------------------------------------
    |Array of configuration usually found in ioc
    |
    */
    'name'    => 'ShipERP CMS',
    'title'   => 'ShipERP CMS',
    'version' => 'v1',
    'app'     => [
        'name'         => 'ShipERP CMS',
        'display_name' => 'ShipERP CMS',
        'domain'       => getenv('APP_DOMAIN'),
        'url'          => getenv('APP_URL')
    ],
    'website' => [
        'name'         => 'ShipERP',
        'display_name' => 'ShipERP',
        'domain'       => getenv('WEBSITE_DOMAIN'),
        'url'          => getenv('WEBSITE_URL')
    ]
);
