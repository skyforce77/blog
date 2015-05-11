<?php
	class Index extends Controller{
		public function view($page=null){
			$sessionStatu = controller::check_session();
			$postsModel = new Model('posts_view');
			$param = null;
			$left_limit = 0;
			$offset = 10;
			$where = "";
			$order = "";

			if(isset($_GET['p'])){
				$currentPage = $_GET['p'];
				$left_limit = ($_GET['p']-1)*$offset;
			}

			if(isset($_GET['sort'])){
				$sort = $_GET['sort'];
				if($sort == 'Plus récent'){
					$param = array('order' => 'date_creation DESC');
				}
				else if($sort == 'Moins récent'){
					$param = array('order' => 'date_creation ASC');
				}
				else if($sort == 'Auteur A-Z'){
					$param = array('order' => 'author ASC');
				}
				else if($sort == 'Auteur Z-A'){
					$param = array('order' => 'author DESC');
				}
			}
			
			if($param['order'] != null){
				$order = "ORDER BY ".$param['order']." ";
			}
			if(isset($_GET['categorie']) && $_GET['categorie'] != 'Toutes les catégories'){
				$where = " where categories.id = ".$_GET['categorie']." ";
			}
			$sql = 'select *
			from categories 
			inner join posts_categories on categories.id = posts_categories.categories_id 
			inner join posts_view on posts_view.id = posts_categories.posts_id
			'.$where.' group by posts_view.id '.$order.' limit '.$left_limit.','.$offset.' ;';
			$result = $postsModel->query($sql);
			$posts = $result->fetchAll();

			$sql = 'select *
			from categories 
			inner join posts_categories on categories.id = posts_categories.categories_id 
			inner join posts_view on posts_view.id = posts_categories.posts_id
			'.$where.' group by posts_view.id ;';
			$result = $postsModel->query($sql);

			$nbrPosts = $result->rowCount();
			$nbrPages = $nbrPosts%$offset;
			
			$this->giveVar(compact('nbrPages'));
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
