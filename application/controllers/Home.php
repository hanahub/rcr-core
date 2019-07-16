<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');       
        
class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($store_id = 0) {
      echo "Something is not right!";
    }

    public function install() {
        global $sc;

        try {
            $script = $sc->call('POST', '/admin/script_tags.json', array('script_tag' => array('event' => 'onload', 'src'=> base_url() . "discount/{$_SESSION[APP_ID]['CURRENT_STORE']['url']}" )));
        } catch (Exception $e) {
            print_r($e);
        }
    }
}

?>
