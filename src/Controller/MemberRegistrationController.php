<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\IdentifierExpression;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

class MemberRegistrationController  extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Csrf');
		$this->loadComponent("GYMFunction");
	}

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'getMembershipEndDate', 'addPaymentHistory', 'getMembershipClasses']);
		if (in_array($this->request->action, ['getMembershipEndDate', 'getMembershipClasses', 'get_membership_classes', 'getMembershipClasses'])) {
			$this->eventManager()->off($this->Csrf);
		}
	}

	public function teste()
	{
		echo "Olaaa";
	}


	public function index()
	{
		$this->viewBuilder()->layout('login');
		$member = $this->MemberRegistration->GymMember->newEntity();
		$m = date("d");
		$y = date("y");
		$prefix = "M" . $lastid;
		$member_id = $prefix . $m . $y;

		$this->set("member_id", $member_id);
		$classes = $this->MemberRegistration->GymMember->ClassSchedule->find("list", ["keyField" => "id", "valueField" => "class_name"]);
		$groups = $this->MemberRegistration->GymMember->GymGroup->find("list", ["keyField" => "id", "valueField" => "name"]);
		$interest = $this->MemberRegistration->GymMember->GymInterestArea->find("list", ["keyField" => "id", "valueField" => "interest"]);
		$source = $this->MemberRegistration->GymMember->GymSource->find("list", ["keyField" => "id", "valueField" => "source_name"]);
		$membership = $this->MemberRegistration->GymMember->Membership->find("list", ["keyField" => "id", "valueField" => "membership_label"]);


		$this->set("classes", $classes);
		$this->set("groups", $groups);
		$this->set("interest", $interest);
		$this->set("source", $source);
		$this->set("membership", $membership);
		$this->set("edit", false);
		if ($this->request->is("post")) {
			$this->request->data['member_id'] = $member_id;
			$image = $this->GYMFunction->uploadImage($this->request->data['image']);
			$image1 = $this->GYMFunction->uploadImage($this->request->data['img1']);
			$image2 = $this->GYMFunction->uploadImage($this->request->data['img2']);
			$image3 = $this->GYMFunction->uploadImage($this->request->data['img3']);
			$image4 = $this->GYMFunction->uploadImage($this->request->data['img4']);
			$this->request->data['image'] = (!empty($image)) ? $image : "Thumbnail-img.png";
			$this->request->data['img1'] = (!empty($image1)) ? $image1 : "Thumbnail-img.png";
			$this->request->data['img2'] = (!empty($image2)) ? $image2 : "Thumbnail-img.png";
			$this->request->data['img3'] = (!empty($image3)) ? $image3 : "Thumbnail-img.png";
			$this->request->data['img4'] = (!empty($image4)) ? $image4 : "Thumbnail-img.png";
			$this->request->data['birth_date'] = $this->GYMFunction->get_db_format_date($this->request->data['birth_date']);
			$this->request->data['membership_valid_from'] = $this->GYMFunction->get_db_format_date($this->request->data['membership_valid_from']);
			$this->request->data['membership_valid_to'] = $this->GYMFunction->get_db_format_date($this->request->data['membership_valid_to']);
			$this->request->data['created_date'] = date("Y-m-d");
			$this->request->data['assign_group'] = json_encode($this->request->data['assign_group']);
			$this->request->data['membership_status'] = "Prospect";
			$this->request->data['member_type'] = "Member";
			$this->request->data["role_name"] = "member";

			$member = $this->MemberRegistration->GymMember->patchEntity($member, $this->request->data);


			if ($this->MemberRegistration->GymMember->save($member)) {
				$this->request->data['member_id'] = $member->id;
				$this->GYMFunction->add_membership_history($this->request->data);


				if (!empty($this->request->data["assign_class"])) {
					foreach ($this->request->data["assign_class"] as $class) {
						$new_row = $this->MemberRegistration->GymMemberClass->newEntity();
						$data = array();
						$data["member_id"] = $member->id;
						$data["assign_class"] = $class;
						$new_row = $this->MemberRegistration->GymMemberClass->patchEntity($new_row, $data);
						$this->MemberRegistration->GymMemberClass->save($new_row);
					}
				}

				$url = Router::url('/', true);
				$logo = $this->GYMFunction->getSettings("gym_logo");
				$logo = (!empty($logo)) ? "/webroot/upload/" . $logo : "Thumbnail-img.png";
				$sys_name = $this->GYMFunction->getSettings('name');
				$sys_email = $this->GYMFunction->getSettings('email');

				$header = '<p style="vertical-align: middle;font-size: 20px;color: #fff;font-weight: 700;display:block;background: #000;font-size: 16px;">
					<img src="' . $url . $logo . '" alt="' . $sys_name . '" height="100" style="display: inline-block;vertical-align: middle;"> ' . $sys_name . '</p>';

				$message = "{$header}<br>Oi {$this->request->data["first_name"]},\n\n";
				$message .= "<br>Obrigado por se registrar em nosso sistema. \n<br>";
				$message .= "<br>Seu usuário: {$this->request->data["username"]}\n";
				$message .= "<br>Você pode fazer o login uma vez após o administrador revisar sua conta e ativá-la.\n\n<br>Obrigado.";

				$email = new Email('default');
				$email->from([$sys_email => $sys_name]);
				$email->emailFormat('html');
				$email->subject("Cadastrado com sucesso | " . $sys_name);
				$email->to($this->request->data["email"]);
				$email->send($message); //Here

				$this->Flash->success(__("Cadastro concluído com sucesso. Você receberá um e-mail após a ativação"));


				return $this->redirect(["controller" => "users", "action" => "login"]);
			} else {
				if ($member->errors()) {
					foreach ($member->errors() as $error) {
						foreach ($error as $key => $value) {
							$this->Flash->error(__($value));
						}
					}
				}
			}
		}
	}

	private function addPaymentHistory($data)
	{
		$row = $this->MemberRegistration->MembershipPayment->newEntity();
		$save["member_id"] = $data["member_id"];
		$save["membership_id"] = $data["selected_membership"];
		$save["membership_amount"] = $this->GYMFunction->get_membership_amount($data["selected_membership"]);
		$save["paid_amount"] = 0;
		$save["start_date"] = $data["membership_valid_from"];
		$save["end_date"] = $data["membership_valid_to"];
		$save["payment_status"] = 0;
		$save["created_date"] = date("Y-m-d");
		/* $save["created_dby"] = 1; */
		$row = $this->MemberRegistration->MembershipPayment->patchEntity($row, $save);
		if ($this->MemberRegistration->MembershipPayment->save($row)) {
			return true;
		} else {
			return false;
		}
	}


	public function regComplete()
	{
		$this->autoRender = false;
		echo "<br><p><i><strong>Sucesso!</strong> Cadastro concluído com sucesso.</i></p>";
		echo "<p><i><a href='{$this->request->base}/Users'>Clique aqui</a> para ir para a página de login.</i></p>";
	}

	public function getMembershipEndDate()
	{
		$this->autoRender = false;

		if ($this->request->is("ajax")) {

			$date = $this->request->data["date"];
			$date = str_replace("/", "-", $date);
			$membership_id = $this->request->data["membership"];
			$date1 = date("Y-m-d", strtotime($date));
			$membership_table =  TableRegistry::get("Membership");
			$row = $membership_table->get($membership_id)->toArray();
			$period = $row["membership_length"];
			$end_date = date("Y-m-d", strtotime($date1 . " + {$period} dias"));
			echo $end_date;
			die;
		}
	}
	public function getMembershipClasses()
	{
		if ($this->request->is("ajax")) {
			$membership_id = $this->request->data["m_id"];
			$mem_tbl = TableRegistry::get("Membership");
			$class_tbl = TableRegistry::get("ClassSchedule");
			$mem_classes = $mem_tbl->get($membership_id)->toArray();
			$mem_classes = json_decode($mem_classes["membership_class"]);
			$data = null;
			if (!empty($mem_classes)) {
				foreach ($mem_classes as $class) {
					$class_data = $class_tbl->find()->where(["id" => $class])->hydrate(false)->toArray();
					if (!empty($class_data)) {
						$class_data = $class_data[0];
						$data .= "<option value='{$class_data['id']}'>{$class_data['class_name']}</option>";
					}
				}
			}
			echo $data;
		}

		die;
	}
}
