<?php 
define('ROOT', str_replace('index.php', '', '/'));
require_once(ROOT.'core/config.php');

class Model{
	/* A initialiser dans la classe de la table */

	protected $table;
	protected $link;


	public function __construct(){
		try {
		    $this->link = new PDO('mysql:host='.$DBConf['host'].';dbname='.$DBConf['dbname'].'', $DBConf['user'], $DBConf['password']);		    
		} catch (PDOException $e) {
		    print "Erreur !: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	function query($sql){
		if($sql != null){
			$this->link->query($sql);
		}
	}

	function save($data){
		if(isset($data['id']) && !empty($data['id'])){
			$sql = "UPDATE ".$this->table." SET ";
			foreach ($data as $key => $value) {
				if($k!='id')
					$sql.= "$k='$v'";
			}
			$sql = substr($sql, 0, -1);
			$sql .= "WHERE id=0".data["id"];
		}
		else{
			unset($data['id']);
			$sql = "INSERT INTO ".$this->table."(";
			foreach ($data as $key => $value) {
				if($k!='id')
					$sql.= "$k";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ") VALUES (";
			foreach ($data as $value) {
				$sql .= "'$value'";
			}
			$sql .= ")";
		}
		mysqli_query($sql) or die(mysqli_error()."<br> QUERY : ".mysqli_query());
		if(!isset($data['id'])){
			$this->id = mysqli_insert_id();			
		}
		else{
			$this->id = $data['id'];
		}
	}

	
	public function setTable($value){
		$this->table = $value;
	}

	public function close(){
		if($this->link != null){
			$this->link = null;
		}
	}
}
?>