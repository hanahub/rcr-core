<?php

class MY_Shopify extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model("Shopify");
    }

    function discount($shop) {
      $output = "console.log('testtest');";
      echo $output;
    }

    function get_offer($shop = '') {
      try {
        $sc = new ShopifyClient(STORE_URL, SHOPIFY_APP_PASSWORD, SHOPIFY_APP_APIKEY, SHOPIFY_APP_SECRET);            

        $result = $sc->call("GET", "/admin/api/2019-04/price_rules.json", array());

        print_r($result);

      } catch (Exception $e) {
        print_r($e);
      }
    }

    function delete_offer($shop = '') {
      try {
        $sc = new ShopifyClient(STORE_URL, SHOPIFY_APP_PASSWORD, SHOPIFY_APP_APIKEY, SHOPIFY_APP_SECRET);            

        $result = $sc->call("DELETE", "/admin/api/2019-04/price_rules/391436042317.json", array());

        print_r($result);

      } catch (Exception $e) {
        print_r($e);
      }
    }

    function offer($shop = '') {
      try {
        $sc = new ShopifyClient(STORE_URL, SHOPIFY_APP_PASSWORD, SHOPIFY_APP_APIKEY, SHOPIFY_APP_SECRET);            

        // $result = $sc->call("POST", "/admin/api/2019-04/price_rules.json", array(
        //   "price_rule" => array(
        //     "title" => "SUMMERSALE10OFF",
        //     "target_type" => "line_item",
        //     "target_selection" => "all",
        //     "allocation_method" => "across",
        //     "value_type" => "fixed_amount",
        //     "value" => "-10.0",
        //     "customer_selection" => "all",
        //     "starts_at" => "2019-07-15T17:59:10Z"
        //   )
        // ));

        $result = $sc->call("POST", "/admin/api/2019-04/price_rules.json", array(
          "price_rule" => array(
            "title" => "15OFFCOLLECTION",
            "target_type" => "line_item",
            "target_selection" => "all",
            "allocation_method" => "across",
            "value_type" => "percentage",
            "value" => "-20.0",
            "usage_limit" => 20,
            "customer_selection" => "all",
            "prerequisite_subtotal_range" => array(
              "greater_than_or_equal_to" => "50.0"
            ),
            "starts_at" => "2019-07-16T10:45:42-04:00"
          )
        ));

        print_r($result);


        // foreach ($pids as $pid) {

        //     $product = $sc->call("GET", "/admin/products/{$pid}.json?fields=tags,variants", array());

        //     $price = $product['variants'][0]['price'];
        //     $tags = explode(',', str_replace(' ', '', $product['tags']));
            
        //     foreach ($tags as $tag) {
        //         if (in_array($tag, $tag_names)) {
        //             $key = array_search($tag, $tag_names);
        //             $pixel = $tag_pixels[$key];

        //             $log = array("product_id" => $pid, "tag" => $tag, "pixel" => $pixel);
        //             $this->Shopify->log($log);

        //             if ($pixel != "") {
        //                 $track .= $this->init_with_customer_info($shop, $pixel, $tag, $customer_id);
        //                 $track .= "fbq('track', 'Purchase', {
        //                         content_name: 'Purchase: {$tag}',
        //                         content_ids: [{$pid}],
        //                         content_type: 'product',                                    
        //                         value: {$price},
        //                         currency: 'USD'
        //                     })";
        //             }
        //         }
        //     }
        // }
      } catch (Exception $e) {
        print_r($e);
      }
    }

    function related_functions($print = 1) {
        $output = <<<EOF
            function getCookie(cname) {
                var name = cname + '=';
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1);
                    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
                }
                return '';
            }
            function createCookie(name, value, days) {
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days*24*60*60*1000));
                    var expires = '; expires=' + date.toGMTString();
                }
                else var expires = '';
                document.cookie = name + '=' + value + expires + '; path=/';
            }
            function appendurl(url) {
                 var script = document.createElement('script');
                 script.setAttribute('type', 'text/javascript');
                 script.setAttribute('src', url);
                 document.body.appendChild(script); 
            }


EOF;
    
        //$output = trim(preg_replace('/\s+/', ' ', $output));        
        
        if ($print == 1) echo $output;
        else return $output;
    }
    
    function fb_pixel_script($print = 1) {
        $output = "!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','//connect.facebook.net/en_US/fbevents.js');
";
        
        if ($print == 1) echo $output;
        else return $output;
    }

    function trackify_init($shop) {
        $this->related_functions();
        //$this->fb_pixel_script();
    }

    function ptag($shop) {

        $this->trackify_init($shop);

        $checkout = "if (typeof Shopify != 'undefined' && typeof Shopify.checkout != 'undefined') {
                //if (Shopify.checkout['token'] != 'undefined' && getCookie(Shopify.checkout['token']) != '1') 
                {
                    var updated_at = new Date(Shopify.checkout.updated_at).getTime();
                    var current_date = new Date().getTime();

                    //if ((current_date - updated_at) < 300000) 
                    {                    
                        var line_items = Shopify.checkout['line_items'];
                        var total_price = Shopify.checkout['total_price'];

                        var pd_id = '';
                        for (var i = 0; i < Object.keys(line_items).length; i++) {
                            pd_id += line_items[i]['product_id']+',';
                        }                       
                        
                        pd_id = pd_id.slice(0, -1);
                        var source = '" . base_url() . "checkout/' + Shopify.shop + '/?pd_id=' + pd_id + '&total_price=' + total_price + '&customer=' + Shopify.checkout.customer_id;
                        appendurl(source); 
                        createCookie(Shopify.checkout['token'], '1', 90);
                    }
                }
            }";

        echo $checkout;

    }

    function checkout($shop) {
        global $sc;

        $pids = explode(',', rtrim($_GET['pd_id'], ','));   
        $pd_id = $_GET['pd_id'];       
        $total_price = $_GET['total_price'];
        $customer_id = $_GET['customer'];

        $store = $this->Shopify->get_store_details(array("url" => $shop));
        $db_tags = $this->Shopify->get_tags($store["id"]);
        $tag_names = array_column($db_tags, 'name');
        $tag_pixels = array_column($db_tags, 'pixel');

        $track = "";
        try {
            $sc = new ShopifyClient($store['url'], $store['password'], $store['apikey'], $store['secret']);            
            
            foreach ($pids as $pid) {

                $product = $sc->call("GET", "/admin/products/{$pid}.json?fields=tags,variants", array());

                $price = $product['variants'][0]['price'];
                $tags = explode(',', str_replace(' ', '', $product['tags']));
                
                foreach ($tags as $tag) {
                    if (in_array($tag, $tag_names)) {
                        $key = array_search($tag, $tag_names);
                        $pixel = $tag_pixels[$key];

                        $log = array("product_id" => $pid, "tag" => $tag, "pixel" => $pixel);
                        $this->Shopify->log($log);

                        if ($pixel != "") {
                            $track .= $this->init_with_customer_info($shop, $pixel, $tag, $customer_id);
                            $track .= "fbq('track', 'Purchase', {
                                    content_name: 'Purchase: {$tag}',
                                    content_ids: [{$pid}],
                                    content_type: 'product',                                    
                                    value: {$price},
                                    currency: 'USD'
                                })";
                        }
                    }
                }
            }
        } catch (Exception $e) {

        }

        echo $track;

    }

    function init_with_customer_info($shop, $pixel, $tag, $customer_id) {
        global $sc;
        
        try {

            $customer = $sc->call("GET", "/admin/customers/{$customer_id}.json?fields=email,first_name,last_name,default_address", array());

            $em = strtolower($customer['email']);
            $ph = strtolower($customer['default_address']['phone']);
            $fn = strtolower($customer['first_name']);
            $ln = strtolower($customer['last_name']);
            $ct = strtolower($customer['default_address']['city']);
            $st = strtolower($customer['default_address']['province']);
            $zp = strtolower($customer['default_address']['zip']);
            
            $params = "{
                em: '{$em}',
                ph: '{$ph}',
                fn: '{$fn}',
                ln: '{$ln}',
                ct: '{$ct}',
                st: '{$st}',
                zp: '{$zp}'
            }";

            $output = $this->init_pixel($pixel, $params);
        } catch (Exception $e) {
            $output = $this->init_pixel($pixel_id);
        }
        return $output;
    }

    function init_pixel($pixel, $params = "", $force_init = 0) {
        if ($params == "") {
            $output = "fbq('init', '" . $pixel . "');
";
        } else {
            $output = "fbq('init', '" . $pixel . "', {$params});
";
        }        

        return $output;
    }
    
}    
?>