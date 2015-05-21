<?php
	class Index extends Controller{
		
		public function view(){
			require_once(ROOT.'models/PostsModel.php');
			require_once(ROOT.'models/CategoriesModel.php');

			$sessionStatu = controller::check_session();
			$postsModel = new PostsModel();

			$categoriesModel = new CategoriesModel();
			$statsCategories = $categoriesModel->countByName();
			$categoriesModel->close();
			
			$param = array('order' => 'date_creation DESC');
			$left_limit = 0;
			$offset = 10;
			$where = null;
			$order = "date_creation DESC";

			if(isset($_GET['page'])){
				$currentPage = $_GET['page'];
				$left_limit = ($_GET['page']-1)*$offset;
			}

			if(isset($_GET['sort'])){
				$sort = $_GET['sort'];
				if($sort == 'Plus récent'){
					$order = 'date_creation DESC';
				}
				else if($sort == 'Moins récent'){
					$order = 'date_creation ASC';
				}
				else if($sort == 'Auteur A-Z'){
					$order = 'author ASC';
				}
				else if($sort == 'Auteur Z-A'){
					$order = 'author DESC';
				}
			}

			
			if(isset($_GET['categorie']) && $_GET['categorie'] != 'Toutes les catégories'){
				$where = intval($_GET['categorie']);
			}
			
			$posts = $postsModel->getPosts($where, $order, $left_limit, $offset);			
			$nbrPosts = $postsModel->countPosts($where);
			
			$nbrPages = intval($nbrPosts/$offset);
			if(intval($nbrPosts/$offset)>0 && $nbrPosts%$offset>0)
				$nbrPages+=1;
			
			$this->giveVar(compact('statsCategories'));
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
