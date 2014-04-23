<?php

class Application_Model_User extends Application_Model_AbstractModel {

   public function __construct($db = null) {
      parent::__construct($db);
   }

   public function getRole($userId) {
      return $this->db->query("
         select r.name
         from user u
         join role r on u.role_id = r.id
         where u.id = :user
         limit 1
         ", array(
            "user" => $userId
      	)
      )->fetch();
   }

   public function getOrganization($userId) {
      return $this->db->query("
         select organization_id
         from organization_member
         where user_id = :user
         ", array(
            "user" => $userId
      	)
      )->fetch();
   }

   public function getDepartments($userId) {
      return $this->db->query("
         select department_id
         from organization_member o
         join department_member d on d.user_id = o.user_id
         where o.user_id = :user
         ", array(
                  "user" => $userId
               )
      )->fetchAll();
   }

   public function findUniqueByUsername($username) {
      return $this->db->query("
         select id, username, role_id
         from user
         where username = :user
         limit 1
         ", array(
            "user" => $username
            )
      )->fetch();
   }

   public function create($username, $password, $salt, $roleId) {
      return $this->db->query("
         insert into user (username, password, salt, role_id)
         values (:username, :password, :salt, :role)
         ", array(
            "username" => $username,
            "password" => $password,
            "salt" => $salt,
            "role" => $roleId
      	)
      );
   }

   public function listRoles() {
      return $this->db->query("
         select *
         from role
         order by id
         ")->fetchAll();
   }
}
