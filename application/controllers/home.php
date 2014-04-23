<?php if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
}

class Home extends CI_Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data = array(
         'page' => array(
            'title' => 'Formigone Software | Custom Web-based & Mobile Apps | Digital Services'
         )
      );

      $this->load->view('layouts/bootstrap', $data);
   }
}
