<?php

class Application_Model_Skill extends Application_Model_AbstractModel {

   public function __construct($db = null) {
      parent::__construct($db);
   }

   public function listSkillSetsForTeam($teamId, $nested = false) {
      $nestedSql = $nested ? "s.parent_skill >= 0" : "s.parent_skill = 0";
      return $this->db->query("
         select s.id as s_id, s.parent_skill s_parent, s.name s_name, ts.id ts_id, ts.rank ts_rank, t.id t_id, t.name as t_name
         from team_skill ts
         join skill s on s.id = ts.skill_id
         join team t on t.id = ts.team_id
         where t.id = :team and {$nestedSql}
         order by ts.rank, s.name
         ", array(
            "team" => $teamId
      	)
      )->fetchAll();
   }

   public function addSkillSet($skill) {
      $sql = $this->db->query("
         insert into skill (name) values (:skill)
         ", array(
            "skill" => $skill
      	)
      );

      return $sql->getAdapter()->lastInsertId();
   }

   public function addSkill($skill, $parent) {
      $sql = $this->db->query("
         insert into skill (name, parent_skill) values (:skill, :parent)
         ", array(
               "skill" => $skill,
               "parent" => $parent
            )
      );

      return $sql->getAdapter()->lastInsertId();
   }
   public function linkSkillToTeam($skillId, $teamId, $order) {
      return $this->db->query("
         insert into team_skill (skill_id, team_id, rank)
         values (:skill, :team, :rank)
         ", array(
            "skill" => $skillId,
            "team" => $teamId,
            "rank" => $order
      	)
      );
   }
}
