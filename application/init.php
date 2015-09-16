<?php

/**
 * Route and start controllers
 *
 * @author sergey
 */

class Application_Init {
        
	public function __construct() 
        {
                //получаем uri без первичного слеша
                $path = substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1);
                
                if(empty($path))
                {
                        $path = 'site/index';
                }
                //и разбираем его в массив
		$this->route = explode('/', $path);
		$this->run();
	}

	private function run() 
        {
                //первый массив - имя контроллера
		$controllerName = array_shift($this->route);
                
		if (!preg_match('#^[a-zA-Z0-9-]*$#', $controllerName))
                {
			$this->ErrorPage404();
                }
                        //запускаем контроллер
			$this->runController('controller_' . $controllerName);
	}

	private function runController($controllerName) {
                        
		$ctrl = new $controllerName();
                
                $action = array_shift($this->route);
                
                //по умолчанию выводим индексный экшен
		if (empty($action)) 
                {
			$action = 'index';
		}

		if (method_exists($ctrl, $action)) 
                {
                        
			if (empty($this->route))
                        {
                                //если в uri больше ничего нет, то запускаем экшен
				$ctrl->$action();
                        } else {
                                //либо передаем доп.аргументы
				call_user_func_array (array($ctrl,$action), $this->route);
                        }
                        
		} else {
			$this->ErrorPage404();
                }
                        
	}
        
        static public function ErrorPage404()
        {
                header('Location: /site/error');
        }

}