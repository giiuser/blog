<?php

/**
 * Description of Post
 *
 * @author sergey
 */

class Model_Post extends Model_Base{
    
        public $id;
        public $author;
        public $ctime;
        public $title;
        public $post;
        
        //получаем имена полей для функции save в базовой модели
        public function fieldsTable()
        {
                return array(
                        'id' => 'Id',
                        'author' => 'Автор',
                        'ctime' => 'Дата публикации',
                        'title' => 'Заголовок',
                        'post' => 'Текст',
                );
        }
              
}
