<?php

/**
 * Description of Application_Template
 *
 * @author sergey
 */

Class Application_Template {

	private $template;
	private $controller;
	private $layouts;
	private $vars = array();
	
	public function __construct($layouts, $controllerName, $user) 
        {
		$this->layouts = $layouts;
		$arr = explode('_', $controllerName);
		$this->controller = strtolower($arr[1]);
                $this->user = $user;
        }
	
	// отображение
	public function render($name, $vars = false) 
        {
                //проверяем присутствие шаблона
		$pathLayout = __DIR__ . '/../views/layouts/' . $this->layouts . '.php';
                //проверяем присутствие вьюхи
		$content = __DIR__ . '/../views/' . $this->controller . '/' . $name . '.php';
                
		if (file_exists($pathLayout) == false) 
                {
			return false;
		}
                
		if (file_exists($content) == false) 
                {
			return false;
		}
                
		if(!empty($vars))
                {
                        //передаем значения во вьюху
                        foreach ($vars as $key => $value) {
                                $$key = $value;
                        }                    
                }

		include ($pathLayout);                
	}
	
}
