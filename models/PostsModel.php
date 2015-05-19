<?php

class PostsModel extends Model{

	private $id;
	private $title;	
	private $content;
	private $summary;
	private $author;
	private $date_creation;
	private $categories;
	private $nbrComments;


	function __construct(){
		parent::__construct('posts_view');
	}

	public function getPosts($where, $order, $left_limit, $offset){
		$sql = 'select *
		from categories 
		inner join posts_categories on categories.id = posts_categories.categories_id 
		inner join posts_view on posts_view.id = posts_categories.posts_id
		WHERE :where group by posts_view.id order by :order limit :left, :offset ;';
		$query = $this->link->prepare($sql);
		$query->bindParam(':where', $where, PDO::PARAM_STR);
		$query->bindParam(':order', $order, PDO::PARAM_STR);
		$query->bindParam(':left', $left_limit, PDO::PARAM_INT);
		$query->bindParam(':offset', $offset, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll();
	}

	public function selectById($id){
		$sql = 'select *
		from posts_view where id = :id';
		$query = $this->link->prepare($sql);
		$query->execute(array(':id' => $id));
		$res =$query->fetchAll();
		return $res;
	}

	public function countPosts($where){
		$sql = 'select *
		from categories 
		inner join posts_categories on categories.id = posts_categories.categories_id 
		inner join posts_view on posts_view.id = posts_categories.posts_id WHERE
		:where group by posts_view.id ;';
		$query = $this->link->prepare($sql);
		$query->bindParam(':where', $where, PDO::PARAM_STR);
		$query->execute();
		return $query->rowCount();
	}

	public function addPost($array = array()){		
		if(empty($array)){
			return 1;
		}
		$key = array('title', 'editors_id', 'summary', 'content', 'categories');
		foreach($key as $value){
			if(!array_key_exists($value, $array)){
				return 1;
			}
		}
		
		$req = $this->link->prepare('INSERT INTO posts (title, summary, content, editors_id, date_creation) VALUES (:title, :summary, :content, (SELECT id FROM editors WHERE id=:editors_id), :date_creation)');
		$res = $req->execute(array(
			':title' => $array['title'],
			':summary' => $array['summary'],
			':content' => $array['content'],
			':editors_id' => $array['editors_id'],
			':date_creation' => date("Y-m-d H:i:s")
			));

		if($res == FALSE){
			return 1;
		}
		$lastId = $this->link->lastInsertId();
		$req = $this->link->prepare('INSERT INTO posts_categories (posts_id, categories_id) VALUES (:posts_id, :categories_id)');
		foreach ($array['categories'] as $value) {			
			$res = $req->execute(array(
				':posts_id' => $lastId,
				':categories_id' => $value
				));
			if($res == FALSE){
				return 1;
			}
		}
		return 0;
	}

	public function deletePost($id){
		$query = $this->link->prepare('DELETE FROM posts WHERE id = :id');
		$res = $query->execute(array(':id' => $id));
		return $res;
	}
}

?>