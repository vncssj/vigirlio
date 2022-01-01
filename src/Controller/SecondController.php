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

	class UsersController extends AppController {

		public function initialize() {
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

		public function index() {		
			return $this->redirect(["action"=>"login"]);		
		}

 
public function fun()
    {
echo "Ola";                                         
    }


	}