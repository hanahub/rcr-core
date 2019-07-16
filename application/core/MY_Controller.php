<?php

class MY_Controller extends CI_Controller {

    function __construct()
    {
        global $sc;       
        
        parent::__construct();
        $this->load->model("Shopify");


        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();        
        $this->crud->unset_jquery();
                
        
        $_SESSION[APP_ID]['STORE_ID'] = 1;
        // $store = $this->Shopify->get_store_details(array("id" => $_SESSION[APP_ID]['STORE_ID']));
        $store = array(
          "url" => "test-rcr.myshopify.com",
          "password" => "eaab7ea166bed3f225a79d0c92668a02",
          "apikey" => "320c619f38e04b3adf4a838edf116f7c",
          "secret" => "5ce3b550ffbcd4953e7efd10dfdbe2ac"
        );
        $_SESSION[APP_ID]['CURRENT_STORE'] = $store;
        $sc = new ShopifyClient($store['url'], $store['password'], $store['apikey'], $store['secret']);
        
        date_default_timezone_set('UTC');    
    }
}