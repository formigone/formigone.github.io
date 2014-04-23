<?php

class Application_Service_Organization {

   public function listAll() {
      $org = new Application_Model_Organization();
      return $org->listAll();
   }

   public function addOrganization($name) {
      $res = array(
         "error" => false,
         "message" => ""
      );

      $org = new Application_Model_Organization();

      if ($org->findByName($name)) {
         $res["error"] = true;
         $res["message"] = "Organization name not available.";
         return $res;
      } else {
         $org->add($name);
      }

      return $res;
   }

   public function addDepartment($id, $name) {
      $res = array(
         "error" => false,
         "message" => ""
      );

      $org = new Application_Model_Organization();

      if ($org->findDepartmentByName($name, $id)) {
         $res["error"] = true;
         $res["message"] = "Department name not available.";
         return $res;
      } else {
         $org->addDepartment($name, $id);
      }

      return $res;
   }

   public function addTeam($id, $name) {
      $res = array(
         "error" => false,
         "message" => ""
      );

      $org = new Application_Model_Organization();

      if ($org->findTeamByName($name, $id)) {
         $res["error"] = true;
         $res["message"] = "Team name not available.";
         return $res;
      } else {
         $org->addTeam($name, $id);
      }

      return $res;
   }

   public function findById($id) {
      $org = new Application_Model_Organization();
      return $org->findById($id);
   }

   public function listDepartments($orgId) {
      $org = new Application_Model_Organization();
      return $org->listDepartments($orgId);
   }

   public function findDepartmentById($deptId) {
      $org = new Application_Model_Organization();
      return $org->findDepartmentById($deptId);
   }

   public function listTeams($deptId) {
      $org = new Application_Model_Organization();
      return $org->listTeams($deptId);
   }

   public function findTeamById($teamId) {
      $org = new Application_Model_Organization();
      $res = $org->findTeamById($teamId);
      $data = array(
      	"team" => array(
      	   "id" => $res["t_id"],
      	   "name" => $res["t_name"]
      	),
         "department" => array(
            "id" => $res["d_id"],
            "name" => $res["d_name"]
         ),
         "organization" => array(
            "id" => $res["o_id"],
            "name" => $res["o_name"]
         )
      );

      return $data;
   }

   public function listEmployeesByOrg($id) {
      $org = new Application_Model_Organization();
      return $org->listEmployeesByOrg($id);
   }

   public function listTeamsByOrganization($id) {
      $org = new Application_Model_Organization();
      return $org->listTeamsByOrganization($id);
   }
}
