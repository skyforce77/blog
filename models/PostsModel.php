<?php

class PostsModel extends Model{
	function __construct(){
		parent::__construct('posts_view');
	}

	public function getPosts($where, $order, $left_limit, $offset){
		$sql = 'select *
		from categories 
		inner join posts_categories on categories.id = posts_categories.categories_id 
		inner join posts_view on posts_view.id = posts_categories.posts_id
		'.$where.' group by posts_view.id '.$order.' limit '.$left_limit.','.$offset.' ;';
		$result = $this->query($sql);
		return $result->fetchAll();
	}

	public function countPosts($where){
		$sql = 'select *
		from categories 
		inner join posts_categories on categories.id = posts_categories.categories_id 
		inner join posts_view on posts_view.id = posts_categories.posts_id
		'.$where.' group by posts_view.id ;';
		$result = $this->query($sql);
		return $result->rowCount();
	}

	public function addPost($array = array()){
		$key = array('title', 'editors_id', 'summary', 'content', 'categories');
		foreach($key as $value){
			if(!array_key_exists($value, $array)){
				return 1;
			}
		}

		$req = $this->link->prepare('INSERT INTO posts (title, summary, content, editors_id, date_creation) VALUES (:title, :summary, :content, :editors_id, :date_creation)');
		$req->execute(array(
			':title' => $array['title'],
			':summary' => $array['summary'],
			':content' => $array['conntent'],
			':editors_id' => $array['editors_id'],
			':date_creation' => date("Y-m-d H:i:s")
			));
		$lastId = $req->lastInsertId();
		$req = $this->link->prepare('INSERT INTO posts_categories (posts_id, categories_id) VALUES (:posts_id, :categories_id)');
		foreach ($array['categories'] as $value) {			
			$req->execute(array(
				':posts_id' => $lastId,
				':categories_id' => $value
				));
		}
	}
}

?>