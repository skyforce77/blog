<?php

class EditorsModel extends Model{

	private $id;
	private $name;
	private $password;
	private $mail;
	private $date_registration;
	private $public;

	function __construct(){
		parent::__construct('editors');
	}

	public function checkUser($login ,$pass){
		$query = $this->link->prepare('SELECT * FROM editors WHERE name = :name ;');
		$query->execute(array(':name'=>$login));
		$query->setFetchMode(PDO::FETCH_CLASS, 'EditorsModel');
		$ret = $query->fetch();

		if(empty($ret)){
			return null;
		}

		if($ret->getPassword() === $pass){
			return $ret;
		}else{
			return null;
		}
	}
	
	public function getUserById($id){
		$query = $this->link->prepare('SELECT * FROM editors WHERE id = :id ;');
		$query->execute(array(':id'=>$id));
		$query->setFetchMode(PDO::FETCH_CLASS, 'EditorsModel');
		$ret = $query->fetch();
		
		if(empty($ret)){
			return null;
		}else{	
			return $ret;
		}
	}

	public function getUserByName($name){
		$query = $this->link->prepare('SELECT * FROM editors WHERE name = :name ;');
		$query->execute(array(':name'=>$name));
		$query->setFetchMode(PDO::FETCH_CLASS, 'EditorsModel');
		$ret = $query->fetch();
		
		if(empty($ret)){
			return null;
		}else{	
			return $ret;
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
	public function mailExist($m){
		$query = $this->link->prepare('SELECT * FROM editors WHERE mail = :mail ;');
		$query->execute(array(':mail'=>$m));
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

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getMail(){
		return $this->mail;
	}

	public function setMail($mail){
		$this->mail = $mail;
	}

	public function getDateRegistration(){
		return $this->date_registration;
	}

	public function setDateRegistration($date_registration){
		$this->date_registration = $date_registration;
	}

	public function isPublic(){
		if($this->public==1)
			return true;
		return false;
	}
}
?>
