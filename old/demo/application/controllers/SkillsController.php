<?php

class SkillsController extends Zend_Controller_Action {

   private $role;

   public function init() {
      $auth = Zend_Auth::getInstance()->getIdentity();
      if (empty($auth)) {
         return $this->_helper->redirector->gotoRoute(array(
            "controller" => "index"
         ));
      }
      $this->role = $auth->role;

      // TODO: Move this logic to some config file
      if ($this->role == "EMPLOYEE") {
         return $this->_helper->redirector->gotoRoute(array(
            "controller" => "index"
         ));
      }
   }

   public function indexAction() {
      $request = $this->getRequest();
      $teamId = (int) $request->getParam("team");

      $orgService = new Application_Service_Organization();
      $skillService = new Application_Service_Skill();

      if ($this->role != "SUPER_ADMIN" || $teamId == 0) {
         $this->_helper->redirector("index", "manage");
      }

      $res = $orgService->findTeamById($teamId);

      $this->view->skillSets = $skillService->getSkillMatrixForTeam($teamId);
      $this->view->org = $res["organization"];
      $this->view->dept = $res["department"];
      $this->view->team = $res["team"];
      $this->view->role = $this->role;
   }

   public function addSkillSetAction() {
      $request = $this->getRequest();
      $teamId = $request->getParam("team");

      $orgService = new Application_Service_Organization();
      $skillService = new Application_Service_Skill();

      if ($this->role != "SUPER_ADMIN") {
         $this->_helper->redirector("index", "manage");
      }

      if ($request->isPost()) {
         $skill = $request->getParam("skill_set");
         $order = $request->getParam("order");

         $res = $skillService->addSkillSet($teamId, $skill, $order);

         if (! $res["error"]) {
            return $this->_helper->redirector("index", "skills", null, array("team" => $teamId));
         } else {
            $this->view->error = $res["error"];
            $this->view->message = $res["message"];
         }
      }

      $res = $orgService->findTeamById($teamId);

      $this->view->skillSets = $skillService->listSkillSetsForTeam($teamId);
      $this->view->org = $res["organization"];
      $this->view->dept = $res["department"];
      $this->view->team = $res["team"];
      $this->view->role = $this->role;
   }

   public function addSkillAction() {
      $request = $this->getRequest();
      $teamId = $request->getParam("team");

      $orgService = new Application_Service_Organization();
      $skillService = new Application_Service_Skill();

      if ($this->role != "SUPER_ADMIN") {
         $this->_helper->redirector("index", "manage");
      }

      if ($request->isPost()) {
         $skill = $request->getParam("skill");
         $parent = $request->getParam("parent");

         $res = $skillService->addSkill($teamId, $skill, $parent);

         if (! $res["error"]) {
            return $this->_helper->redirector("index", "skills", null, array("team" => $teamId));
         } else {
            $this->view->error = $res["error"];
            $this->view->message = $res["message"];
         }
      }

      $res = $orgService->findTeamById($teamId);

      $this->view->skillSets = $skillService->listSkillSetsForTeam($teamId);
      $this->view->org = $res["organization"];
      $this->view->dept = $res["department"];
      $this->view->team = $res["team"];
      $this->view->role = $this->role;
   }
}
