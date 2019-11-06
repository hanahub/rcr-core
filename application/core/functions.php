<?php

function getAllProducts($collection_id) {
    global $sc;

    $result = array();    
    try {            
        $count = $sc->call("GET", "/admin/products/count.json?collection_id={$collection_id}&tags=Bachelorette", array());                        
        $total = ceil($count / 250) + 1;
        for ($i = 1; $i <= $total; $i++) {                
            $products = $sc->call("GET", "/admin/products.json?fields=id,title,tags,variants&limit=250&page={$i}&collection_id={$collection_id}&tags=Bachelorette", array());
            $result = array_merge($result, $products);                
        }
        
    } catch (Exception $e) {
        handle_exception($e);
    }
    return $result;
}


function getShopifyProducts($since_id = '', $limit = 10) {
    $sc = $_SESSION['SC'];
    $param = array(
                    'fields' => 'id,title,image,published_at,handle',
                    'limit' => $limit,
                    'published_status' => 'published',                    
                );
    
    if (!empty($since_id)) $param['since_id'] = $since_id;
    
    $products = $sc->call('GET', '/admin/products.json', $param, '');
    
    foreach($products as $key => $product) {
                
        $metafield = $sc->call('GET', '/admin/products/' . $product['id'] . '/metafields.json', 
                    array(
                        'key' => 'facebook_published',
                    )
                );
        
        if (!empty($metafield) && $metafield[0]['value'] == 1) {
             unset($products[$key]);
             continue;
        }
        
        if (isset($product['image']['src'])) {
            $str = $product['image']['src'];
            $last_slash_pos = strripos($str, '/');                
            $last_dot_pos = strripos($str, '.');
            
            $filename = substr($str, $last_slash_pos + 1, $last_dot_pos - $last_slash_pos - 1);
            $small_filename = substr_replace($str, $filename . '_small', $last_slash_pos + 1, $last_dot_pos - $last_slash_pos - 1 );
        
            $products[$key]['published_at'] = date('D, j M Y H:i:s \G\M\T', strtotime($products[$key]['published_at']));
            $products[$key]['image']['small_src'] = $small_filename;            
            $products[$key]['link'] = SHOPIFY_STORE . "products/" . $products[$key]['handle'];
            $products[$key]['content'] = "NEW {COLLECTION} MUG!
Order Here: {LINK}
Click The Link Above To Order!";
        }
    }
    
    return $products;
}




?>
