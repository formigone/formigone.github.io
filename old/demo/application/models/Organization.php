<?php

class Application_Model_Organization extends Application_Model_AbstractModel {

   public function __construct($db = null) {
      parent::__construct($db);
   }

   public function listAll() {
      return $this->db->query("
         select *
         from organization
         order by name
         ")->fetchAll();
   }

   public function findByName($name) {
      return $this->db->query("
         select *
         from organization
         where name = :name
         limit 1
         ", array(
         "name" => $name
      ))->fetch();
   }

   public function findById($id) {
      return $this->db->query("
         select *
         from organization
         where id = :id
         limit 1
         ", array(
         "id" => $id
      ))->fetch();
   }

   public function add($name) {
      return $this->db->query("
         insert into organization (name)
         values (:name)
         ", array(
         "name" => $name
      ));
   }

   public function findDepartmentByName($name, $org) {
      return $this->db->query("
         select *
         from department
         where name = :name
         and organization_id = :org
         limit 1
         ", array(
         "name" => $name,
         "org" => $org
      ))->fetch();
   }

   public function addDepartment($name, $org) {
      return $this->db->query("
         insert into department (name, organization_id)
         values (:name, :org)
         ", array(
               "name" => $name,
               "org" => $org
            ));
   }

   public function listDepartments($orgId) {
      return $this->db->query("
         select *
         from department
         where organization_id = :org
         ", array(
               "org" => $orgId
            ))->fetchAll();
   }

   public function findTeamByName($name, $dept) {
      return $this->db->query("
         select *
         from team
         where name = :name
         and department_id = :dept
         limit 1
         ", array(
         "name" => $name,
         "dept" => $dept
      ))->fetch();
   }

   public function addTeam($name, $dept) {
      return $this->db->query("
         insert into team (name, department_id)
         values (:name, :dept)
         ", array(
         "name" => $name,
         "dept" => $dept
      ));
   }

   public function listTeams($deptId) {
      return $this->db->query("
         select *
         from team
         where department_id = :dept
         ", array(
         "dept" => $deptId
      ))->fetchAll();
   }

   public function findDepartmentById($id) {
      return $this->db->query("
         select *
         from department
         where id = :id
         limit 1
         ", array(
         "id" => $id
      ))->fetch();
   }

   public function findTeamById($teamId) {
      return $this->db->query("
         select
            t.id as t_id, t.name as t_name, d.id as d_id, d.name as d_name, o.id as o_id, o.name as o_name
         from team t
         join department d on t.department_id = d.id
         join organization o on d.organization_id = o.id
         where t.id = :team
         limit 1
         ", array(
            "team" => $teamId
      	)
      )->fetch();
   }

   public function addUsernameToOrg($username, $orgId) {
      return $this->db->query("
         insert into organization_member (user_id, organization_id)
         values (
            (
               select id
               from user
               where username = :username
               limit 1
            ),
            :org
         )
         ", array(
               "username" => $username,
               "org" => $orgId
            )
      );
   }

   public function listEmployeesByOrg($id) {
      return $this->db->query("
         select u.username as name, u.id
         from user u
         join organization_member o on o.user_id = u.id
         where o.organization_id = :org
         order by u.username
         ", array(
            "org" => $id
      	)
      )->fetchAll();
   }

   public function listTeamsByOrganization($id) {
      return $this->db->query("
         select t.id, t.name
         from team t
         join department d on t.department_id = d.id
         join organization o on d.organization_id = o.id
         where o.id = :org
         order by t.name
         ", array(
               "org" => $id
            )
      )->fetchAll();
   }
}
