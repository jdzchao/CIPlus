<?php defined('BASEPATH') or exit ('No direct script access allowed');
require_once PLUGINS_PATH . 'restful' . DIRECTORY_SEPARATOR . 'Restful_Controller.php';

abstract class MY_Controller extends Restful_controller {

    public function __construct($security = true) {
        parent::__construct();
    }

}