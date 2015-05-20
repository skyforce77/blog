<?php

class CategoriesModel extends Model{
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
}

?>