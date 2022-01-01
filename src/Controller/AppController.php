<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Session\DatabaseSession;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\Core\Configure;
use Cake\Database\Type;
use Cake\I18n\FrozenTime;




class AppController extends Controller
{


//	public $helpers = ['AkkaCKEditor.CKEditor'];
	 public function initialize()
    {
        parent::initialize();
		
		
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');	
		$this->loadComponent('Auth',['loginRedirect'=>['controller'=>'Dashboard','action'=>'index'],
                                     'logoutRedirect'=>['controller'=>'Users',"action"=>"login"],
                                     'authorize' => array('Controller')  
                                    ]);			
    }


	 
	public function isAuthorized($users)
    {
        if(isset($users))
        {			
            return true;
        }
        else{
            return false;
        }
    }
	 
	
    public function beforeRender(Event $event)
    {
		if(file_exists(TMP.'installed.txt')) 
		{
			$this->loadComponent("GYMFunction");
			$check_alert_on = $this->GYMFunction->getSettings("enable_alert");
			if($check_alert_on)
			{			
				$this->GYMFunction->sendAlertEmail();
				$this->GYMFunction->sendAlertEmailToAdmin();		
			}		
		}
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }		
    }
	
 	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['register','/users/login','index','classBooking', 'forgotPassword','resetPassword']);
		/* $session = $this->request->session();
		 if($session->read("User") != null)
		{  */
		if(file_exists(TMP.'installed.txt') && $this->request->controller != "Installer")
		{
			$this->loadComponent("GYMFunction");
			@$lang = $this->GYMFunction->getSettings("sys_language");		
			if (empty($lang)) {
				return;
			}
			
			I18n::locale($lang);
			
			// @$time_zone = $this->GYMFunction->getSettings("time_zone");
			// if($time_zone != '')
			// {
				// date_default_timezone_set($time_zone);
			// }
			
			$dateformatlocale = "yyyy-MM-dd";
			
			if($lang == 'en' ||
			   $lang == 'zh_CH' || 
			   $lang == 'cs' || 
			   $lang == 'fr' || 
			   $lang == 'de' || 
			   $lang == 'el' || 
			   $lang == 'it' || 
			   $lang == 'ja' || 
			   $lang == 'pl' || 
			   $lang == 'pt_BR' || 
			   $lang == 'pt_PT' || 
			   $lang == 'ru' || 
			   $lang == 'es' || 
			   $lang == 'th' || 
			   $lang == 'tr' 
			   )
			{
				
				$dateformatlocale = 'yyyy-MM-dd';
			}
			elseif($lang == 'ar' || $lang == 'fa')
			{
				$dateformatlocale = 'yyyy-MM-dd';
			}
			
		 	
			Time::setDefaultLocale('en'); // For any mutable DateTime
			FrozenTime::setDefaultLocale('en'); // For any immutable DateTime
			Date::setDefaultLocale('en'); // For any mutable Date
			FrozenDate::setDefaultLocale('en'); // For any immutable Date  
		  
		 	// Time::$defaultLocale = $lang;
			Time::setToStringFormat($dateformatlocale);
			Date::setToStringFormat($dateformatlocale);
			FrozenDate::setToStringFormat($dateformatlocale);
			Type::build('date')
			->useImmutable()->useLocaleParser()
			->setLocaleFormat($dateformatlocale);
			Type::build('datetime')
			->useImmutable()->useLocaleParser()
			->setLocaleFormat($dateformatlocale);  
			
			//Configure::write('Config.timezone', $time_zone);
			
		}
		/* } */
	} 
}
