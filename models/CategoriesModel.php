<?php

class CategoriesModel extends Model{
	function __construct(){
		parent::__construct('categories');
	}

	public function countByName(){
		$this->link->prepare("SELECT name, COUNT(sele");
	}
}

?>