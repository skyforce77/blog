<?php
	class Index extends Controller{
		public function view(){
			require_once(ROOT.'models/PostsModel.php');
			$sessionStatu = controller::check_session();
			$postsModel = new PostsModel('posts_view');
			$param = null;
			$left_limit = 0;
			$offset = 10;
			$where = "";
			$order = "";

			if(isset($_GET['page'])){
				$currentPage = $_GET['page'];
				$left_limit = ($_GET['page']-1)*$offset;
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
			
			$posts = $postsModel->getPosts($where, $order, $left_limit, $offset);			
			$nbrPosts = $postsModel->countPosts($where);
			
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
