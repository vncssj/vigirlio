<?php
namespace App\Model\Table;
use Cake\ORM\Table;
/* use Cake\Validation\Validator; */
use Cake\ORM\RulesChecker;
use Cake\ORM\Rule\IsUnique;

Class GymMemberTable extends Table{
	
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
		// $this->belongsTo("StaffMembers",["foreignKey"=>"assign_staff_mem"]);
		$this->belongsTo("ClassSchedule",["foreignKey"=>"assign_class"]);
		$this->belongsTo("GymGroup",["foreignKey"=>"assign_group"]);
		$this->belongsTo("GymInterestArea",["foreignKey"=>"intrested_area"]);
		$this->belongsTo("GymSource",["foreignKey"=>"g_source"]);
		$this->belongsTo("Membership",["foreignKey"=>"selected_membership"]);
		$this->belongsTo("MembershipHistory");
		$this->belongsTo("MembershipPayment");
		$this->belongsTo("GymAttendance");
		$this->belongsTo("GymMeasurement");
		$this->belongsTo("GymMemberClass",["targetForeignKey"=>"member_id"]);
		/* // $this->belongsTo("GymMemberClass"); */
		$this->BelongsTo("GymRoles",["foreignKey"=>"role"]); //for staffmember
		$this->BelongsTo("Specialization",["propertyName"=>"specialization"]); //for staffmember
		/* 
		// $this->belongsTo("Installment_Plan",[
											// "foreignKey"=>"install_plan_id",
											// "propertyName"=>'duration'
											// ]);
		// $this->belongsTo("Activity");	
		// $this->hasMany("Membership_Activity",["foreignKey"=>"membership_id"]); */
	}
	
	
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->isUnique(['email'],'Email já está em uso.'));
		$rules->add($rules->isUnique(['username'],'Esse usuário já existe.')); /*  MOVED TO LOGIN TABLE - REMOVE */ 
		return $rules;
	} 
}