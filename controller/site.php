<?php

/**
 * Description of Controller_Site
 *
 * @author sergey
 */

//главная индексная страница и страница с ошибками (пока только 404)
class Controller_Site extends Controller_Base {
    
        public $layouts = 'main';
	
	public function index() 
        {
		
		$model = new model_post;
                $posts = $model->getAll();
		
		return $this->template->render('index', ['posts' => $posts]);
	}
        
        public function error()
        {
                header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
                return $this->template->render('404');
        }
	
}