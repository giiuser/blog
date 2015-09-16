<?php

/**
 * Description of Model_Comment
 *
 * @author sergey
 */

class Model_Comment extends Model_Base {

        public $id;
        public $postid;
        public $name;
        public $post;

        public function fieldsTable()
        {
                return [
                        'id' => 'Id',
                        'postid' => 'Id поста',
                        'name' => 'Имя комментатора',
                        'post' => 'Текст комментария'
                       ];
        }
        
        //из-за специфичности получения комментариев, решил вытащить эту функцию сюда, а не делать ее в базовой модели
        public function getComments($id)
        {
		try {
			$db = $this->db;
			$stmt = $db->prepare('SELECT * FROM ' . $this->table . ' WHERE postid=:id'); 
			$stmt->execute([':id' => $id]);
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
                
                return $result;
        }        
    
}
