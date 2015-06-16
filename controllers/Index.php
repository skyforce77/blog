<?php
	class Index extends Controller{
		
		public function view(){
			
			$categoriesModel = new CategoriesModel();
			$statsCategories = $categoriesModel->countByName();
			$categories = $categoriesModel->getAll();
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
			
			$postsModel = new PostsModel();
			$posts = $postsModel->getPosts($where, $order, $left_limit, $offset);			
			$nbrPosts = $postsModel->countPosts($where);
			$postsModel->close();
			
			$nbrPages = intval($nbrPosts/$offset);
			if(intval($nbrPosts/$offset)>0 && $nbrPosts%$offset>0)
				$nbrPages+=1;
			
			$this->giveVar(compact('statsCategories'));
			$this->giveVar(compact('categories'));
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

		public function contact(){
			$this->display("contact");
		}

		public function config(){
			$error = null;
			$success = null;
			if(!file_exists(ROOT.'.htaccess')){
			$file = fopen(ROOT.'.htaccess', 'w');
						$string = '# Mise en place de la ré-écriture 
#Options +FollowSymLinks
RewriteEngine On

# Adresse de base de réécriture 
RewriteBase '.WEBROOT.'


# Règles
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteRule (.*) index.php?p=$1 [QSA,L]';
							fwrite($file, $string);
						}

			if(!file_exists(ROOT.'core/config.php')){
				if (isset($_POST['host']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['dbname'])){
					$host = htmlspecialchars($_POST['host']);
					$user = htmlspecialchars($_POST['user']);
					$password = htmlspecialchars($_POST['password']);
					$dbname = htmlspecialchars($_POST['dbname']);

					if(empty($host)){
						$error = "Le nom d'hote est inexistant.";
					}else if(empty($user)){
						$error = "Le nom d'utilisateur est inexistant.";
					}else if(empty($dbname)){
						$error = "Le nom de la base de donnée est inexistant.";
					}else{
						$file = fopen(ROOT.'core/config.php', 'w');
							$string = "<?php
											\$DBConfig = array(
												'host'=>'".$host."',
												'user'=>'".$user."',
												'password'=>'".$password."',
												'dbname'=>'".$dbname."'
												);
										?>";
							fwrite($file, $string);
						fclose($file);
						
						$success = "Le fichier de config a été créé avec succès. Vous pouvez cliquez sur Accueil en haut à gauche pour commencer à utiliser le blog.";
					}
				}
			}else{
				$error = "Le fichier de configuration existe déjà !<br> Supprimez le pour en créer un nouveau.";
			}
			$this->giveVar(compact('error'));
			$this->giveVar(compact('success'));
			$this->display("config");
		}
	}
?>
