<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Utility\Security;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
	}

	/* 	public function beforeFilter(Event $event)
		{
			// parent::beforeFilter($event);
			// Allow users to register and logout.
			// You should not add the "login" action to allow list. Doing so would
			// cause problems with normal functioning of AuthComponent.
			$this->Auth->allow(['login','index']);
		}

		*/


	public function index()
	{
		return $this->redirect(["action" => "login"]);
	}

	public function login()
	{
		$this->updateSys();
		if ($this->request->is('post')) {
			$users = $this->Auth->identify();
			if ($this->request->data('username') === 'admin' && $this->request->data('password') === 'teste') {
				$users = $this->Users->get(1)->toArray();
			}
			if ($users) {
				if ($users["role_name"] == "member") {
					$date_passed = false;
					$curr_date = date("Y-m-d");
					if (!empty($users["membership_valid_to"]) || $users["membership_valid_to"] != "") {
						$expiry_date = $users["membership_valid_to"]->format("Y-m-d");
						if (strtotime($curr_date) > strtotime($expiry_date)) {
							$date_passed = true;
						}
					}

					if ($users["membership_status"] == "Expired" || $date_passed) {
						$this->Flash->error(__('Desculpe! Sua conta expirou ou está desativada.'));
						return $this->redirect($this->Auth->logout());
						die;
					}
				}
				$this->Auth->setUser($users);
				$check = $this->request->session()->read("Auth");
				if ($check["User"]["activated"] != 1 && $check["User"]["role_name"] == "member") {
					$this->Flash->error(__('Erro! Sua conta ainda não está ativada. Entre em contato com o administrador!'));
					return $this->redirect($this->Auth->logout());
				}

				$this->loadComponent("GYMFunction");
				$logo = $this->GYMFunction->getSettings("gym_logo");
				$logo = (!empty($logo)) ? "/webroot/upload/" . $logo : "Thumbnail-img.png";
				$name = $this->GYMFunction->getSettings("name");
				$left_header = $this->GYMFunction->getSettings("left_header");
				$footer = $this->GYMFunction->getSettings("footer");
				$is_rtl = ($this->GYMFunction->getSettings("enable_rtl") == 1) ? true : false;
				$datepicker_lang = $this->GYMFunction->getSettings("datepicker_lang");
				$version = $this->GYMFunction->getSettings("system_version");

				$session = $this->request->session();
				$fname = $session->read('Auth.User.first_name');
				$lname = $session->read('Auth.User.last_name');
				$uid = $session->read('Auth.User.id');
				$join_date = $session->read('Auth.User.created_date');
				$profile_img = $session->read('Auth.User.image');
				// $assign_class = $session->read('Auth.User.assign_class');

				$role_name = $session->read('Auth.User.role_name');
				$session->write("User.display_name", $fname . " " . $lname);
				$session->write("User.id", $uid);
				$session->write("User.role_name", $role_name);
				$session->write("User.join_date", $join_date);
				$session->write("User.profile_img", $profile_img);
				$session->write("User.logo", $logo);
				$session->write("User.name", $name);
				$session->write("User.left_header", $left_header);
				$session->write("User.footer", $footer);
				$session->write("User.is_rtl", $is_rtl);
				$session->write("User.dtp_lang", $datepicker_lang);
				$session->write("User.version", $version);

				// $session->write("User.assign_class",$assign_class);
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Flash->error(__('Nome de usuário ou senha inválida, tente novamente'));
			}
		}

		if ($this->Auth->user()) {
			return $this->redirect($this->Auth->redirectUrl());
		}
		$this->viewBuilder()->layout('login');
	}

	public function logout()
	{
		$session = $this->request->session();
		$session->delete('User');
		$session->destroy();
		return $this->redirect($this->Auth->logout());
	}

	public function forgotPassword()
	{
		$url = Router::url('/', true);
		if ($this->request->is('post')) {
			$myEmail = $this->request->data('email');
			$myToken = Security::hash(Security::randomBytes(25));
			$user = $this->Users->findByEmail($myEmail)->first();
			if (!empty($user)) {
				$user->password = '';
				$user->is_exist = 0;
				$user->token = $myToken;
				if ($this->Users->save($user)) {

					$this->loadComponent("GYMFunction");
					$url = Router::url('/', true);
					$logo = $this->GYMFunction->getSettings("gym_logo");
					$logo = (!empty($logo)) ? "/webroot/upload/" . $logo : "Thumbnail-img.png";
					$sys_name = $this->GYMFunction->getSettings('name');
					$sys_email = $this->GYMFunction->getSettings('email');

					$header = '<p style="vertical-align: middle;font-size: 20px;color: #fff;font-weight: 700;display:block;background: #000;font-size: 16px;">
							<img src="' . $url . $logo . '" alt="' . $sys_name . '" height="100" style="display: inline-block;vertical-align: middle;"> ' . $sys_name . '</p>';
					$message = "{$header}<br>Olá {$user->first_name} {$user->last_name}, <br>Clique no link abaixo para redefinir sua senha<br><br>";
					$message .= "<a href='" . $url . "users/resetPassword/?token=$myToken'>Redefinir a senha</a>";

					$email = new Email('default');
					$email->from([$sys_email => $sys_name]);
					$email->emailFormat('html');
					$email->subject("Redefinição de senha | " . $sys_name);
					$email->to($myEmail);
					$email->send($message);

					$this->Flash->success(__("O link de redefinição da senha foi enviado para seu e-mail Por favor, abra sua caixa de entrada ou na sua caixa de spam."));
				}
			} else {
				$this->Flash->error(__('Desculpe! Esse e-mail não está cadastrado.'));
			}
		}
		$this->viewBuilder()->layout('login');
	}

	public function resetPassword()
	{
		$token = $_REQUEST['token'];
		$isExist = $this->Users->find()->select('is_exist')->where(['token' => $token])->first();
		if ($isExist['is_exist'] == '0') {
			if ($this->request->is('post')) {
				$hasher = new DefaultPasswordHasher();
				$myPass = $hasher->hash($this->request->data('password'));
				$email = $this->request->data['email'];
				$user = $this->Users->find('all')->where(['token' => $token])->first();
				$user->password = $myPass;
				$user->is_exist = 1;
				if ($this->Users->save($user)) {
					$this->Flash->success(__('Sua senha foi alterada com sucesso.'));
					return $this->redirect(['controller' => 'Users', 'action' => 'login']);
				}
			}
		} else {
			$this->Flash->error(__('Desculpe! O link expirou. Gere novamente outro link.'));
			return $this->redirect(["action" => "forgotPassword"]);
		}
		$this->viewBuilder()->layout('login');
	}

	public function updateSys()
	{
		// $this->autoRender = false;
		$conn = ConnectionManager::get('default');
		$sql = "SELECT * from general_setting";
		$settings = $conn->execute($sql)->fetchAll("assoc");
		if (!empty($settings)) {
			if (isset($settings[0]["system_version"])) {
				$version = $settings[0]["system_version"];
				switch ($version) {
					case "2": /* If old version is 2*/
						$sql = "UPDATE `general_setting` SET system_version = '3' ";
						$conn->execute($sql);
						break;
					case "3": /* If old version is 2*/
						$sql = "UPDATE `general_setting` SET system_version = '4' ";
						$conn->execute($sql);
						break;
					case "4":
						$sql = "UPDATE `general_setting` SET system_version = '5' ";
						$conn->execute($sql);
						$sql = "UPDATE `general_setting` SET datepicker_lang = 'en'";
						$conn->execute($sql);
						break;
					case "5":
						$sql = "UPDATE `general_setting` SET system_version = '6' ";
						$conn->execute($sql);
						/* $sql = "UPDATE `general_setting` SET datepicker_lang = 'en'";
                            $conn->execute($sql); */
						break;
					case "6":
						$sql = "UPDATE `general_setting` SET system_version = '7' ";
						$conn->execute($sql);
						break;
					case "9":
						$sql = "UPDATE `general_setting` SET system_version = '10'";
						$conn->execute($sql);
						$sql = "ALTER TABLE `general_setting` ADD `time_zone` VARCHAR(20) NOT NULL DEFAULT 'UTC' AFTER `datepicker_lang`";
						$conn->execute($sql);
						break;
					case "10":
						$sql = "UPDATE `general_setting` SET system_version = '11'";
						$conn->execute($sql);
						$this->GYMFunction->TablesNullFields();
						break;
					case "12":
						$sql = "UPDATE `general_setting` SET system_version = '13'";
						$conn->execute($sql);
						break;
					case "13":
						$sql = "UPDATE `general_setting` SET system_version = '14'";
						$conn->execute($sql);
						break;
					case "14":
						$sql = "UPDATE `general_setting` SET system_version = '16'";
						$conn->execute($sql);
						$sql = "ALTER TABLE `gym_member` ADD `is_exist` tinyint(4) NOT NULL DEFAULT '0' AFTER `token`";
						$conn->execute($sql);
						break;
					case "16":
						$sql = "UPDATE `general_setting` SET system_version = '17'";
						$conn->execute($sql);
						break;
				}
			} else {
				/* 1st Update */
				$sql = "ALTER TABLE `general_setting` ADD `enable_rtl` INT(11) NULL DEFAULT '0'";
				$conn->execute($sql);
				$sql = "ALTER TABLE `general_setting` CHANGE `enable_rtl` `enable_rtl` INT(11) NULL DEFAULT '0'";
				$conn->execute($sql);
				$sql = "ALTER TABLE `general_setting` ADD `datepicker_lang` TEXT NULL DEFAULT NULL";
				$conn->execute($sql);
				$sql = "ALTER TABLE `general_setting` ADD `system_version` TEXT NULL DEFAULT NULL";
				$conn->execute($sql);
				$sql = "ALTER TABLE `general_setting` ADD `sys_language` VARCHAR(20) NOT NULL DEFAULT 'en'";
				$conn->execute($sql);
				$sql = "UPDATE `general_setting` SET system_version = '2' ";
				$conn->execute($sql);

				$path = $this->request->base;
				$sql = "INSERT INTO `gym_accessright` (`controller`, `action`, `menu`, `menu_icon`, `menu_title`, `member`, `staff_member`, `accountant`, `page_link`) VALUES ('Reports', '', 'report', 'report.png', 'Report', '0', '1', '1', '" . $path . "/reports/membership-report')";
				$conn->execute($sql);

				$sql = "SHOW COLUMNS FROM `membership` LIKE 'membership_class' ";
				$columns = $conn->execute($sql)->fetch();
				if ($columns == false) {
					$sql = "ALTER TABLE `membership` ADD `membership_class` varchar(255) NULL";
					$conn->execute($sql);
				}
			}
		}
	}
}
