<?php
	class Index extends Controller{
		public function view($categorie=null){
			$sessionStatu = controller::check_session();
			$postsModel = new Model('posts');
			$posts = $postsModel->query('SELECT id, title, summary, date_creation, nbr_comments, categories, author from posts_view');
			$this->giveVar(compact('posts'));
			$this->display('view');
			/*

			posts_view :
			create view posts_view as SELECT posts.id, posts.title, posts.content, posts.summary, editors.name as author, posts.date_creation,
			GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories,
			(select count(*) from comments WHERE comments.posts_id = posts.id) AS nbr_comments
			from posts 
			inner join editors on posts.editors_id = editors.id
			inner join posts_categories on posts.id = posts_categories.posts_id 
			inner join categories on categories.id = posts_categories.categories_id 
			group by posts.id 
			*/
		}
	}
?>
