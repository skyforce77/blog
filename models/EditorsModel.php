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


	public function pseudoExist($p){
		$query = $this->link->prepare('SELECT * FROM editors WHERE name = :name ;');
		$query->execute(array(':name'=>$p));
		$ret = $query->rowCount();
		if($ret==0){
			return false;
		}else{			
			return true;
		}
	}

	public function addEditor($name, $pass, $mail, $public){
		$query = $this->link->prepare('INSERT INTO editors(name, password, mail, date_registration, public) VALUES(:name, :password, :mail, :dateReg, :public);');
		$res = $query->execute(array(
			':name'=>$name,
			':password'=>$pass,
			':mail'=>$mail,
			':dateReg'=>date("Y-m-d H:i:s"),
			':public'=>$public
			));
		return $res;
	}
}
?>
