<?php

/**
 * Description of user
 *
 * @author sergey
 */

class Model_User extends Model_Base {

        public $id;
        public $name;
        public $password;
        public $key;

        public function fieldsTable()
        {
                return [
                        'id' => 'Id',
                        'name' => 'Имя',
                        'password' => 'Пароль',
                        'key' => 'Хэш'
                       ];
        }
        
        //функция для первичной авторизации пользователя
        public function authUser($login, $pass)
        {
		try {
			$db = $this->db;
			$stmt = $db->prepare('SELECT id FROM ' . $this->table . ' WHERE name=:name AND password=:pass'); 
			$stmt->execute([':name' => $login, ':pass' => $pass]);
                        $result = $stmt->fetch(PDO::FETCH_NUM);

                        if(!empty($result[0]))
                        {       
                                $key = md5(md5(microtime().rand(0,10000)));
                                //пишем сгенеренное значение в БД 
                                $db->query('UPDATE ' . $this->table . ' SET cookie=' . $db->quote($key) . ' WHERE id=' . $result[0]); 
                        } else{
                                return false;
                        }
		}catch(PDOException $e){
			return false;
		}
                
                //и возвращаем его для записи в куку
                return $key;
        } 
        
        //этой функцией проверяем залогинен юзер или нет по всему сайту через куку. Кука действительна только на один сеанс.
        static public function checkUser($cookie) 
        {
                try {
			global $dbObject;
			$stmt = $dbObject->prepare('SELECT name FROM user WHERE cookie=:cookie'); 
			$stmt->execute([':cookie' => $cookie]);
                        $result = $stmt->fetch(PDO::FETCH_NUM);
                        
                        if (empty($result[0]))
                        {
                                return false;
                        }
                } catch (Exception $ex) {
                        return false;
                }
                //возвращаем никнейм
                return $result[0];
                
        }
    
}
