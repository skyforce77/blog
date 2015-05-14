<?php 


class Model{
	/* A initialiser dans la classe de la table */

	protected $table;
	protected $link;


	function __construct($tab){
		require('config.php');
		$this->table = $tab;
		try {
		    $this->link = new PDO('mysql:host='.$DBConfig['host'].';dbname='.$DBConfig['dbname'].'', $DBConfig['user'], $DBConfig['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));		    
			$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		} catch (PDOException $e) {
		    print_r("Erreur !: " . $e->getMessage() . "<br/>");
		    $this->link = null;
		    die();
		}
	}

	public function query($sql){
		if($sql != null && $this->link != null){
			$res = $this->link->prepare($sql);
			$res->execute();
			return $res;
		}
		return null;
	}

	public function select($champ = array(), $param = array()){
		$select = "";
		$conditions = "";
		$limit = "";
		$order = "";

		if(is_array($champ) && count($champ)){
			foreach ($champ as $value) {
				if(!empty($select))
					$select .= ", ";

				$select .= $value;
			}
		}
		else{
			$select = "*";
		}

		if(is_array($param) && count($param)){
			if(array_key_exists('conditions', $param)){
				$conditions = "WHERE ".$param['conditions']." ";
			}
			if(array_key_exists('limit', $param)){
				$limit = "LIMIT ".$param['limit']." ";
			}
			if(array_key_exists('order', $param)){
				$order = "ORDER BY ".$param['order']." ";
			}
		}

		$sql = "SELECT ".$select." FROM ".$this->table." ".$conditions.$order.$limit.";";
		$res = $this->link->prepare($sql);
		$res->execute();
		$return = $res->fetchAll();
		$res->closeCursor();

		return $return;
	}

	public function update($arr, $conditions){
		if(!is_array($arr))
			return null;

		$set = "";
		foreach ($arr as $key => $value) {
			if(!empty($set))
				$values .= ", ";

			$set .= $key."='".$value."'";
		}
		$sql = "UPDATE ".$this->table." SET ".$set." WHERE ".$conditions.";";

		$res = $this->link->prepare($sql);
		$res->execute();
	}

	public function insert($arr){
		if(!is_array($arr))
			return null;

		$values = "";
		$champs = "";
		foreach ($arr as $k => $v) {
			if(!empty($values))
				$values .= ", ";
			if(!empty($champs))
				$champs .= ", ";

			$champs .= $k;
			$values .= "'".$v."'";
		}
		$sql = "INSERT INTO ".$this->table." (".$champs.") VALUES (".$values.");";
		print_r($sql);
		$res = $this->link->prepare($sql);
		$res->execute();
	}

	public function delete($cond){
		$sql = "DELETE FROM  ".$this->table." WHERE ".$cond." ;";
		$res = $this->link->prepare($sql);
		$res->execute();
	}

	
	public function setTable($value){
		$this->table = $value;
	}
	public function getTable(){
		return $this->table;
	}
	public function getLink(){
		return $this->link;
	}

	public function close(){
		if($this->link != null){
			$this->link = null;
		}
	}
}
?>