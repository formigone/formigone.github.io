<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

   private $config;

   protected function _initRequest() {
      $this->config = new Zend_Config_Ini(APPLICATION_PATH. "/configs/application.ini", "production");
      Zend_Registry::set("config", $this->config);
   }

   protected function _initDatabases() {
      try {
         $db = Zend_Db_Table::getDefaultAdapter();
         Zend_Registry::set("db", $db);
      } catch (Zend_Db_Adapter_Exception $e) {
         echo $e->getMessage();
         die("Could not connect to def db");
      }
   }
}
