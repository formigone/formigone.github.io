<?php

class Application_Service_User {
   private $auth;

   /**
    *
    */
   public function __construct() {
      $this->auth = Zend_Auth::getInstance();
   }

   /**
    *
    * @return Zend_Auth_Adapter_DbTable
    */
	private function getAuthAdapter() {
		$adapter = new Zend_Auth_Adapter_DbTable(
			Zend_Db_Table::getDefaultAdapter()
		);

		$adapter->setTableName("user")
			->setIdentityColumn("username")
			->setCredentialColumn("password")
			->setCredentialTreatment("MD5(CONCAT(?, salt))");

		return $adapter;
	}

	/**
	 *
	 */
	protected function getUserRole($userId) {
	   $user = new Application_Model_User();
	   $role = $user->getRole($userId);
	   return empty($role) ? null : $role["name"];
	}

	/**
	 *
	 */
	protected function getUserOrganization($userId) {
	   $user = new Application_Model_User();
	   $org = $user->getOrganization($userId);
	   return empty($org) ? null : $org["organization_id"];
	}

	/**
	 *
	 */
	protected function getUserDepartments($userId) {
	   $user = new Application_Model_User();
	   $res = $user->getDepartments($userId);
	   $depts = array();
	   foreach ($res as $_dept) {
	      array_push($depts, $_dept["department_id"]);
	   }

	   return $depts;
	}

	/**
	 *
	 */
	public function getUser() {
	   return $this->auth->getIdentity();
	}

	/**
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function login($username, $password) {
		$adapter = $this->getAuthAdapter();
		$adapter->setIdentity($username);
		$adapter->setCredential($password);

		$res = $this->auth->authenticate($adapter);

		if ($res->isValid()) {
			$identity = $adapter->getResultRowObject();
			$identity->role = $this->getUserRole($identity->id);
			$identity->org = $this->getUserOrganization($identity->id);
			$identity->depts = $this->getUserDepartments($identity->id);
			$storage = $this->auth->getStorage();
			$storage->write($identity);
			return true;
		} else {
			return false;
		}
	}

	/**
	 *
	 */
	public function logout() {
		$this->auth->clearIdentity();
	}

	/**
	 *
	 */
	public function isLoggedIn() {
		return $this->auth->hasIdentity();
	}

	/**
	 *
	 */
	public function addEmployee($username, $password, $orgId, $roleId) {
	   $res = array(
	   	"error" => false
	   );

	   $user = new Application_Model_User();
	   $org = new Application_Model_Organization();

	   $isUnique = $user->findUniqueByUsername($username);

	   if (!empty($isUnique)) {
	      $res["error"] = true;
	      $res["message"] = "Username already taken";
	   } else {
	      $salt = $this->genSalt();
   	   $user->create($username, md5($password.$salt), $salt, $roleId);
   	   $org->addUsernameToOrg($username, $orgId);
	   }

	   return $res;
	}

	/**
	 *
	 */
	protected function genSalt() {
	   $chars = "illeQUEnosONESsalvabit0987654321!@#$^&*()~";
	   $charsLen = strlen($chars);
	   $saltLen = 16;
	   $str = "";

	   while (--$saltLen > 0) {
	      $rand = rand(0, $charsLen);
	      $str .= $chars[$rand];
	   }

	   return $str;
	}

	protected function formatConstString($str) {
      $parts = explode("_", $str);

      foreach ($parts as &$_part) {
         $_part = ucfirst(strtolower($_part));
      }

      return implode(" ", $parts);
	}

	/**
	 *
	 */
	public function listRoles() {
	   $user = new Application_Model_User();
	   $roles = $user->listRoles();
	   $list = array();

	   foreach ($roles as $_role) {
	      array_push($list, array(
	           "id" => $_role["id"],
	           "name" => $this->formatConstString($_role["name"])
	      	)
	      );
	   }

	   return $list;
	}
}
