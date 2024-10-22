<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','DzHYhzKsb2Z6');
define('DB_DB','instructor');

class DB{/* DBv16.05.07 By Ko */
	
	private $mysqli;

	public $error;
	public $sql;
	
	public function __construct($db=DB_DB){
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, $db);
		$this->mysqli->set_charset("utf8");
	}
	
	public function __destruct(){
		$this->mysqli->close();
		if(!empty($this->error)){
			echo "ERROR: {$this->error}<br>{$this->sql}";
			exit();
		}
	}
	
	public function QUERY($cmd, $sql, $params=NULL, $types=NULL){
		$this->sql = $sql;
		
		$stmt = $this->mysqli->stmt_init();
		if(!$stmt->prepare($sql)){
			$this->error = $stmt->error;
			return null;
		}
		
		if($types&&$params){
			$bind_names[] = $types;
			for ($i=0; $i<count($params); $i++){
				$bind_name = 'bind' . $i;
				$$bind_name = $params[$i];
				$bind_names[] = &$$bind_name;
			}//_v($bind_names);
			call_user_func_array(array($stmt,'bind_param'), $bind_names);
		}
			
		switch($cmd){
			case 'INSERT':		
				if($stmt->execute()){
					$idx = $stmt->insert_id;
					$stmt->close();
					$this->error = null;
					return $idx;
				}else{
					$this->error = $stmt->error;
					return null;
				}
				break;
			
			case 'DELETE':
			case 'UPDATE':
				if($stmt->execute()){
					$affected = $stmt->affected_rows;
					$stmt->close();
					$this->error = null;
					return $affected;
				}else{
					$this->error = $stmt->error;
					return NULL;
				}
				break;
			
			case 'SELECT':
				if(!$stmt->execute()){
					$this->error = $stmt->error;
					return NULL;
				}
				
				$metaResults = $stmt->result_metadata();//_v($metaResults);

				while ($fields = $metaResults->fetch_field()) { 
					$var = $fields->name; 
					$all_fields[] = $var;
					$$var = null; 
					$parameters[$fields->name] = &$$var; 
				}
		
				call_user_func_array(array($stmt, 'bind_result'), $parameters); 
				
				$__cnt = 0;
				$rows = array();
				while($stmt->fetch()) {
					 foreach($all_fields as $field){
						$r[$field] = $parameters[$field];
					}
					$rows[$__cnt] = $r;
					$__cnt++;
				}
				$stmt->close();
				$this->error = null;
				return $rows;
				break;
		}
	}///Query
	
	public function SELECT($table, $where){
		$whStr = '';
		while(list($f,$v)=each($where)){$whStr.=" `{$f}`='{$v}' AND";}
		$whStr = substr($whStr,0,-4);
		$sql = "SELECT * FROM `{$table}` WHERE {$whStr}";//_d($sql);
		return $this->QUERY('SELECT', $sql);
	}

	public function INSERT($table, $data){
		$params = array();
		$types = $field = $value = '';
		while(list($f,$v)=each($data)){$params[]=$v;$types.='s';$field .= "`{$f}`,";$value .= "?,";}
		$field = substr($field,0,-1); $value = substr($value,0,-1);
		$sql = "INSERT INTO `{$table}` ($field) VALUES ($value)";//_d($sql);_v($params);_v($types);
		return $this->QUERY('INSERT', $sql, $params, $types);
	}///INSERT
	
	public function UPDATE($table, $data, $where){
		$params = array();
		$types = $field = $value = $whStr = '';
		while(list($f,$v)=each($data)){$params[]=$v;$types.='s';$field .= "`{$f}`=?,";}
		$field = substr($field,0,-1);
		while(list($f,$v)=each($where)){$params[]=$v;$types.='s';$whStr .= "`{$f}`=? AND";}
		$whStr = substr($whStr,0,-4);
		$sql = "UPDATE `{$table}` SET {$field} WHERE {$whStr}";//_d($sql);_v($params);_v($types);
		return $this->QUERY('UPDATE', $sql, $params, $types);
	}///UPDATE
	
	public function DELETE($table, $where){
		$params = array();
		$types = $whStr = '';
		while(list($f,$v)=each($where)){$params[]=$v;$types.='s';$whStr .= "`{$f}`=? AND";}
		$whStr = substr($whStr,0,-4);
		$sql = "DELETE FROM `{$table}` WHERE {$whStr}";//_d($sql);_v($params);_v($types);
		return $this->QUERY('DELETE', $sql, $params, $types);
	}///DELETE
	
}///class DB

?>
