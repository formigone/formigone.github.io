<?php

class ManageController extends Zend_Controller_Action {

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

   protected function isUserInOrg($org) {
      $userService = new Application_Service_User();
      $user = $userService->getUser();
      return $org == $user->org;
   }

   protected function hasTeamAssigned() {
      $userService = new Application_Service_User();
      $user = $userService->getUser();
      return count($user->depts) > 0;
   }

   protected function isUserInDept($dept) {
      $userService = new Application_Service_User();
      $user = $userService->getUser();
      return in_array($dept, $user->depts);
   }

   public function indexAction() {
      if ($this->role == "ADMIN") {
         return $this->_helper->redirector("organization");
      }

      if ($this->role == "DEPT_MAN") {
         return $this->_helper->redirector("department");
      }

      if ($this->role == "TEAM_MAN") {
         return $this->_helper->redirector("team");
      }

      $orgService = new Application_Service_Organization();
      $this->view->organizations = $orgService->listAll();
   }

   public function organizationAction() {
      if ($this->role == "DEPT_MAN") {
         return $this->_helper->redirector("department");
      }

      if ($this->role == "TEAM_MAN") {
         return $this->_helper->redirector("team");
      }

      $request = $this->getRequest();
      $id = $request->getParam("id");

      $orgService = new Application_Service_Organization();

      if (is_null($id)) {
         $userService = new Application_Service_User();
         $user = $userService->getUser();
         $id = $user->org;
         $this->_helper->redirector("organization", "manage", null, array(
            "id" => $id
         ));
      }

      $this->view->org = $orgService->findById($id);
      $this->view->depts = $orgService->listDepartments($id);
      $this->view->teams = $orgService->listTeamsByOrganization($id);
      $this->view->employees = $orgService->listEmployeesByOrg($id);
      $this->view->role = $this->role;
   }

   public function departmentAction() {
      $allow = false;
      if ($this->role == "SUPER_ADMIN" || $this->role == "ADMIN") {
         $allow = true;
      }

      $request = $this->getRequest();
      $deptId = $request->getParam("id");
      $orgId = $request->getParam("organization");

      $orgService = new Application_Service_Organization();

      if (! $allow || is_null($deptId) || is_null($orgId) || ! $this->isUserInOrg($orgId)) {
         if ($this->role != "SUPER_ADMIN") {
            $this->_helper->redirector("index");
         }
      }

      $this->view->org = $orgService->findById($orgId);
      $this->view->dept = $orgService->findDepartmentById($deptId);
      $this->view->teams = $orgService->listTeams($deptId);
      $this->view->employees = $orgService->listEmployeesByOrg($deptId);
      $this->view->role = $this->role;
   }

   public function teamAction() {
      $request = $this->getRequest();
      $teamId = $request->getParam("id");

      $orgService = new Application_Service_Organization();

      $res = $orgService->findTeamById($teamId);

      if (is_null($teamId) || ! $this->isUserInOrg($res["organization"]["id"]) || !$this->hasTeamAssigned()) {
         if ($this->role != "SUPER_ADMIN") {
            $this->_helper->redirector("no-assignment");
         }
      }

      $this->view->org = $res["organization"];
      $this->view->dept = $res["department"];
      $this->view->team = $res["team"];
      $this->view->employees = $orgService->listEmployeesByOrg($res["organization"]["id"]);
      $this->view->role = $this->role;

      // TODO: show team skill matrix
   }

   public function addOrganizationAction() {
      if ($this->role != "SUPER_ADMIN") {
         return $this->_helper->redirector("index");
      }

      $request = $this->getRequest();

      if ($request->isPost()) {
         $name = $request->getParam("name");
         $orgService = new Application_Service_Organization();
         $res = $orgService->addOrganization($name);

         if (! $res["error"]) {
            return $this->_helper->redirector("index");
         } else {
            $this->view->error = $res["error"];
            $this->view->message = $res["message"];
         }
      }
   }

   public function addDepartmentAction() {
      $request = $this->getRequest();
      $orgService = new Application_Service_Organization();
      $id = $request->getParam("organization");

      if ($this->role == "SUPER_ADMIN") {} elseif ($this->role == "ADMIN") {
         if (! $this->isUserInOrg($id)) {
            return $this->_helper->redirector("index");
         }
      } else {
         return $this->_helper->redirector("index");
      }

      $org = $orgService->findById($id);

      if ($request->isPost()) {
         $name = $request->getParam("name");
         $orgService = new Application_Service_Organization();
         $res = $orgService->addDepartment($id, $name);

         if (! $res["error"]) {
            return $this->_helper->redirector("index");
         } else {
            $this->view->error = $res["error"];
            $this->view->message = $res["message"];
         }
      }

      $this->view->org = $org;
      $this->view->role = $this->role;
   }

   public function addTeamAction() {
      $request = $this->getRequest();
      $orgService = new Application_Service_Organization();
      $orgId = $request->getParam("organization");
      $deptId = $request->getParam("department");

      if ($this->role == "SUPER_ADMIN" || $this->role == "ADMIN") {} elseif ($this->role == "DEPT_MAN") {
         if (! $this->isUserInOrg($orgId) || ! $this->isUserInDept($deptId)) {
            return $this->_helper->redirector("index");
         }
      } else {
         return $this->_helper->redirector("index");
      }

      $org = $orgService->findById($orgId);
      $dept = $orgService->findDepartmentById($deptId);

      if ($request->isPost()) {
         $name = $request->getParam("name");
         $orgService = new Application_Service_Organization();
         $res = $orgService->addTeam($deptId, $name);

         if (! $res["error"]) {
            return $this->_helper->redirector("index");
         } else {
            $this->view->error = $res["error"];
            $this->view->message = $res["message"];
         }
      }

      $this->view->org = $org;
      $this->view->dept = $dept;
      $this->view->role = $this->role;
   }

   public function addEmployeeAction() {
      $request = $this->getRequest();
      $orgService = new Application_Service_Organization();
      $orgId = $request->getParam("organization");

      if ($this->role != "SUPER_ADMIN") {
         if ($this->role != "ADMIN" && !$this->isUserInOrg($orgId)) {
            return $this->_helper->redirector("index");
         }
      }

      $org = $orgService->findById($orgId);

      if ($request->isPost()) {
         $username = $request->getParam("username");
         $password = $request->getParam("password");
         $fname = $request->getParam("first_name");
         $lname = $request->getParam("last_name");
         $roleId = $request->getParam("role_id");
         $userService = new Application_Service_User();
         $res = $userService->addEmployee($username, $password, $orgId, $roleId);

         if (! $res["error"]) {
            return $this->_helper->redirector("index");
         } else {
            $this->view->error = $res["error"];
            $this->view->message = $res["message"];
         }
      }

      $userService = new Application_Service_User();
      $this->view->roleList = $userService->listRoles();
      $this->view->role = $this->role;
   }

   public function noAssignmentAction() {
   }
}
