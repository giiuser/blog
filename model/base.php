<?php

/**
 * Description of baseModel
 *
 * @author sergey
 */

class Model_Base {

	protected $db;
	protected $table;

	public function __construct($select = false) 
        {
		// объект бд коннекта, да, глобальные переменные есть зло, но тут она одна на весь проект, решил оставить
		global $dbObject;
		$this->db = $dbObject;
		
		// имя таблицы
                $tn = explode('_', strtolower(get_class($this)));
		$this->table = $tn[1];
	}
        
	// запись в базу данных
	public function save() 
        {
                //выбираем имена полей таблицы
		$arrayAllFields = array_keys($this->fieldsTable());
		$arraySetFields = array();
		$arrayData = array();
                //делаем два массива, в одном имена полей, в другом значения
		foreach($arrayAllFields as $field){
			if(!empty($this->$field)){
				$arraySetFields[] = $field;
				$arrayData[] = $this->$field;
			}
		}
                //имена полей преобразуем в строку
		$forQueryFields =  implode(', ', $arraySetFields);
                //делаем строку с плейсхолдерами для prepared statement
		$rangePlace = array_fill(0, count($arraySetFields), '?');
		$forQueryPlace = implode(', ', $rangePlace);
		
		try {
                        //делаем вставку записи в БД
			$db = $this->db;
			$stmt = $db->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");  
			$result = $stmt->execute($arrayData);
                        if($result !== false)
                        {
                                //получаем id вставленной записи для подтверждения и редиректа, по желанию
                                $result = $db->lastInsertId();
                        }
		}catch(PDOException $e){
			return false;
		}
		
		return $result;
	}
	
	public function getAll() 
        {
                //просто получаем все записи из таблицы
            	try {
                        $db = $this->db;
			$stmt = $db->prepare('SELECT * FROM ' . $this->table);  
			$stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
		
		return $result;
        }    
        
	public function getById($id) 
        {
                //получаем записи по primary id
            	try {
                        $db = $this->db;
			$stmt = $db->prepare('SELECT * FROM ' . $this->table . ' WHERE id=:id');  
			$stmt->execute([':id' => $id]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
		
		return $result;
                
        }         
    
}
