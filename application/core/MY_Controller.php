<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        global $sc;       
        
        parent::__construct();
        
        $store = array(
          "url" => STORE_URL,
          "password" => SHOPIFY_APP_PASSWORD,
          "apikey" => SHOPIFY_APP_APIKEY,
          "secret" => SHOPIFY_APP_SECRET
        );
        $_SESSION[APP_ID]['CURRENT_STORE'] = $store;
        $sc = new ShopifyClient($store['url'], $store['password'], $store['apikey'], $store['secret']);
        
        date_default_timezone_set('UTC');    
    }
}