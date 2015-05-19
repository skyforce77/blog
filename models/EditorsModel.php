<?php

class EditorsModel extends Model{
	function __construct(){
		parent::__construct('editors');
	}

	public function checkUser($login ,$pass){
		$query = $this->link->prepare('SELECT * FROM editors WHERE name = :name ;');
		$query->execute(array(':name'=>$login));
		$ret = $query->fetchAll();
		
		if(empty($ret)){
			return null;
		}else{			
			$ret = $ret[0];
		}


		if($ret['password'] === $pass){
			return $ret;
		}else{
			return null;
		}
	}
	
	public function getUserById($id){
		$query = $this->link->prepare('SELECT * FROM editors WHERE id = :id ;');
		$query->execute(array(':id'=>$id));
		$ret = $query->fetchAll();
		
		if(empty($ret)){
			return null;
		}else{	
			return $ret[0];
		}
	}
}
?>
