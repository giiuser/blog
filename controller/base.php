<?php

/**
 * Description of Controller_Base
 *
 * @author sergey
 */

class Controller_Base {
        
        public $user;
	protected $template;
	protected $layouts; // шаблон
        
        //базовый контроллер
	public function __construct() 
        {
		//подумав, решил сделать центральную проверку на залогиненность, поэтому, это здесь
		if (!empty($_COOKIE['uniqid'])) 
                {
			$this->user = Model_User::checkUser($_COOKIE['uniqid']);
		} else {
                        $this->user = null;
                }
                
                //автоматом прогружаем шаблон
                $this->template = new Application_Template($this->layouts, get_class($this), $this->user);
		
	}

}
