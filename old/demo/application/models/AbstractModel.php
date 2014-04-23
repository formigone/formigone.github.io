<?php

class Application_Model_AbstractModel {
   protected $db;

   public function __construct($db = null) {
      $this->db = $db;

      if (empty($this->db)) {
         $this->db = Zend_Db_Table::getDefaultAdapter();
      }
   }
}
