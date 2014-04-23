<?php

class IndexController extends Zend_Controller_Action {

   public function indexAction() {
      $userService = new Application_Service_User();
      $this->view->user = $userService->getUser();
   }

   public function loginAction() {
      $request = $this->getRequest();

      if ($request->isPost()) {
         $userService = new Application_Service_User();
         $username = $request->getParam("username");
         $password = $request->getParam("password");

         if ($userService->login($username, $password)) {
            return $this->_helper->redirector("index");
         } else {
            $this->view->failed = true;
            $this->view->message = "Invalid username or password";
         }
      } else {
         return $this->_helper->redirector("index");
      }
   }

   public function logoutAction() {
      $userService = new Application_Service_User();
      $userService->logout();
      return $this->_helper->redirector("index");
   }
}
