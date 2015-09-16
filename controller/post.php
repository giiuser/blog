<?php

/**
 * Description of Controller_Post
 *
 * @author sergey
 */

class Controller_Post extends Controller_Base{
    
        public $layouts = 'main';
        private $error;
            
	public function write() {
		if (!$this->user)
                {    
                    return header('Location: /');
                }
                
                $error = '';
                
		if (!empty($_POST)) 
                {
                        
                        //сохраняем запись в блоге
			$model = new Model_Post;
                        //решил не заморачиваться и вырезать все теги. Естественно, не проблема, сделать различные допуски.
                        $model->title = strip_tags($_POST['title']);
                        $model->post = strip_tags($_POST['post']);
                        $model->author = $this->user;
                        
                        $result = $model->save();
                        //если все ок, редиректим на вьюху с постом
                        if($result !== false)
                        {
                                header('Location: /post/view/' . (int)$result);
                        } else {
                            $error = 'Что-то вы делаете не так';
                        }
		}
		
		return $this->template->render('write', ['error' => $error]);
		
	}
        
	public function view($id) {
                
                //проверяем id на целочисленность, иначе - 404
                if(intval($id))
                {
                        //выводим пост по id
                        $model = new Model_Post;
                        $post = $model->getById($id);
                        
                        $cmodel = new Model_Comment;
                        //если запощен комментарий, обрабатываем
                        if (!empty($_POST)) 
                        {
                                $cmodel->postid = $id;
                                $cmodel->name = strip_tags($_POST['name']);
                                $cmodel->post = strip_tags($_POST['post']);
                                $result = $cmodel->save();
                                if($result !== false)
                                {
                                        $error = 'Вы что-то написали нехорошее!';
                                }
                        }
                        
                        //получаем все наличествующие комментарии
                        $comments = $cmodel->getComments($id);
                        //и выводим их
                        return $this->template->render('view', ['post' => $post, 'comments' => $comments]);
                }else{
                        Application_Init::ErrorPage404();
                }
                
	}        
        
}
