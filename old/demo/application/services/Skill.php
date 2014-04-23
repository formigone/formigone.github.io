<?php

class Application_Service_Skill {

   private $skill;

   public function __construct() {
      $this->skill = new Application_Model_Skill();
   }

   public function listSkillSetsForTeam($teamId) {
      return $this->skill->listSkillSetsForTeam($teamId);
   }

   public function addSkillSet($teamId, $skill, $order) {
      $order = (int) $order;

      $skillId = $this->skill->addSkillSet($skill);
      $this->skill->linkSkillToTeam($skillId, $teamId, $order);

      return array(
         "error" => false
      );
   }

   public function addSkill($teamId, $skill, $parent) {
      $res = array(
         "error" => false
      );

      $parent = (int) $parent;

      if ($parent == 0) {
         $res["error"] = true;
         $res["message"] = "Every skill need to be associated with a skill set.";
      }

      $skillId = $this->skill->addSkill($skill, $parent);
      $this->skill->linkSkillToTeam($skillId, $teamId, 0);

      return $res;
   }

   public function getSkillMatrixForTeam($teamId) {
      $skills = $this->skill->listSkillSetsForTeam($teamId, true);
      $list = array(
         "skillSets" => array()
      );

      foreach ($skills as $_skill) {
         $key = $_skill["s_parent"] == 0 ? $_skill["s_id"] : $_skill["s_parent"];
         if (! array_key_exists($key, $list["skillSets"])) {
            $list["skillSets"][$key] = array(
               "skills" => array()
            );
         }

         if ($_skill["s_parent"] == 0) {
            $list["skillSets"][$key]["id"] = $_skill["s_id"];
            $list["skillSets"][$key]["name"] = $_skill["s_name"];
         } else {
            array_push($list["skillSets"][$key]["skills"], array(
               "id" => $_skill["s_id"],
               "name" => $_skill["s_name"]
            	)
            );
         }
      }

      return $list;
   }
}
