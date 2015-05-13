<?php

class PostsModel extends Model{
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
}

?>