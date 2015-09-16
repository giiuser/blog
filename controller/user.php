<?php

/**
 * Description of Controller_User
 *
 * @author sergey
 */

class Controller_User extends Controller_Base {
    
        public $layouts = 'main';
    
	public function login() {
            
                $error='';
                
		//контроллер для авторизации юзера
		if (!empty($_POST))
                {
                        $model = new Model_User();
                        
                        $key = $model->authUser($_POST['name'], md5($_POST['pass']));
                        //если авторизация прошла, ставим куку с хэшем на сеанс, кука меняется после каждого залогинивания (в БД тоже)
                        if ($key)
                        {                            
                                setcookie('uniqid', $key, 0, '/');
                                header("Location: /");                                
                        } else {
                            $error = 'Вы что-то ввели неправильно!';
                        }
		}		
                        
                return $this->template->render('login', ['error' => $error]);    
                
	}
        
        public function logout()
        {
                setcookie('uniqid', '', time() - 3600, '/');
                header('Location: /');	
        }
        
}
