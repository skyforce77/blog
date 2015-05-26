<?php

class CategoriesModel extends Model{
	private $name;
	private $nbrPosts;
	private $id;

	function __construct(){
		parent::__construct('categories');
	}

	public function countByName(){
		$query = $this->link->prepare("SELECT name, (select count(*) from posts_categories where categories_id = categories.id) AS count 
			FROM categories 
			LEFT JOIN posts_categories ON categories.id = posts_categories.categories_id group by name order by name ASC;");
		$query->execute();
		return $query->fetchAll();
	}

	public function getAll(){
		$query = $this->link->prepare("SELECT * FROM categories ORDER BY name ASC;");
		$query->execute();
		$query->setFetchMode(PDO::FETCH_CLASS, 'CategoriesModel');
		return $query->fetchAll();
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

	public function getNbrPosts(){
		return $this->nbrPosts;
	}

	public function setNbrPosts($n){
		$this->nbrPosts = $n;
	}
}

?>