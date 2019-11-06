<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');       
        
class Main extends MY_Controller {

  function __construct() {    
    parent::__construct();
    header("Access-Control-Allow-Origin: *");

  }

  public function index($store_id = 0) {
    echo "Something is not right!!!!";
  }

  public function collection_count($id) {
    $count = 0;
    if (!empty($id)) {
      if ($id == "31896698924") {
        $count = 48; 
      } else {
        $results = getAllProducts($id);
        if (count($results) > 0) {
          foreach ($results as $result) {
            if (strpos($result["title"], '(Buy Now)') == false) {
              // if (is_array($result["variants"]) && $result["variants"][0]["inventory_quantity"] > 0)
              {
                $count ++;
              }
            }
          }
        }
      }
    }
    echo json_encode(array("count" => $count));
  }
}

?>
