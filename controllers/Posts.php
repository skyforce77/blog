<?php
	class Posts extends Controller{
		public function view($idPost){
			require_once(ROOT.'models/PostsModel.php');
			require_once(ROOT.'models/CommentsModel.php');

			$postResult = null;

			$postsModel = new PostsModel();
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$temp = new Model('comments');
			$postResult = array();		

			$canEdit = 0;
			if(isset($post[0])) {
				$this->giveVar(compact('post'));
				if(isset($_SESSION['editor_id']) && $post[0]['author'] == $_SESSION['editor_name']) {
					$canEdit = 1;
				}
			}

			$this->giveVar(compact('canEdit'));

			$commentsModel = new CommentsModel('comments');


			if(isset($_POST['mail']) && isset($_POST['pseudo']) && isset($_POST['text'])){
				$message = "";
				$mail = htmlspecialchars($_POST['mail']);
				$pseudo = htmlspecialchars($_POST['pseudo']);
				$text = htmlspecialchars($_POST['text']);
				
				if(isset($_SESSION['dateComment'])){
					$date = $_SESSION['dateComment'];
					$diff = abs(floor($date - time())/60);
					if ($diff < 3){
						$postResult = array(1, 'Vous devez attendre '.intval(3-$diff).'min pour poster un autre commentaire');
					}
				}
				if(empty($mail) || empty($pseudo) || empty($text)){
					$postResult = array(1, 'Veuillez remplir tout les champs.<br>');
				} else if(strlen($pseudo) < 4 || strlen($pseudo) > 30){
					$postResult = array(1, 'La taille de votre pseudo doit être comprise entre 4 et 30 caractères.<br>');
				} else if(strlen($text) < 10 || strlen($text) > 300){
					$postResult = array(1, 'La taille de votre commentaire doit être comprise entre 10 et 300 caractères.<br>');
				} else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
				   	$postResult = array(1, 'Votre addresse mail est invalide.<br>');
				} else{
					$ret = $commentsModel->sendComment(array(
						'pseudo'=>$pseudo, 
						'mail'=>$mail,
						'comment'=>$text,
						'postId'=>$idPost
						));
					if($ret == 1){
						$postResult = array(1, 'Erreur lors de l\'envoi de votre commentaire.');
					}else{
						$postResult = array(0, 'Votre commentaire a été posté.');
						$_SESSION['dateComment'] = time();
					}
				}
			}
			$comments = $commentsModel->select(array(), array('conditions' => 'posts_id = '.intval($idPost.'')));
			$postsModel->close();
			$commentsModel->close();
			$this->giveVar(compact('postResult'));	
			$this->giveVar(compact('comments'));

			$this->display('view');
		}

		public function edit($idPost){
			require_once(ROOT.'models/PostsModel.php');
			require_once(ROOT.'models/CommentsModel.php');

			$postResult = null;

			$postsModel = new PostsModel();
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$postsModel->close();		

			$canEdit = 0;
			if(isset($post[0])) {
				$this->giveVar(compact('post'));
				if(isset($_SESSION['editor_id']) && $post[0]['author'] == $_SESSION['editor_id']) {
					$canEdit = 1;
				}
			}

			$this->giveVar(compact('canEdit'));
			$this->display('edit');
		}

		public function delete($idPost){
			require_once(ROOT.'models/PostsModel.php');

			$postsModel = new PostsModel();
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$postsModel->close();			

			$canEdit = 0;
			if(isset($post[0])) {
				$this->giveVar(compact('post'));
				if(isset($_SESSION['editor_id']) && $post[0]['author'] == $_SESSION['editor_id']) {
					$canEdit = 1;
				}
			}

			$this->giveVar(compact('canEdit'));
			$this->display('delete');		
		}

		public function add(){
			require_once(ROOT.'models/CategoriesModel.php');
			require_once(ROOT.'models/PostsModel.php');
			$catModel = new CategoriesModel();
			$categories = $catModel->select();
			$catModel->close();
			$catArray = array();

			$canEdit = 0;
			if(isset($_SESSION['editor_id'])) {
				$canEdit = 1;
				if(isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['content'])){
					$title = htmlspecialchars($_POST['title']);
					$summary = htmlspecialchars($_POST['summary']);
					$content = htmlspecialchars($_POST['content']);
					foreach ($categories as $value) {
						if(isset($_POST[$value['name']])){
							array_push($catArray, $value['id']);
						}
					}
					
					if(empty($title) || empty($summary) || empty($content)){
						$postResult = array(1, "Veillez remplir tout les champs.");
					}
					else if(empty($catArray)){ // Si aucune categorie n'a été sélectionnée
						$postResult = array(1, "Veillez selectionner au moins une catégorie.");
					}
					else if(strlen($title) < 5 || strlen($title) > 100){
						$postResult = array(1, "Le titre doit contenir entre 5 et 10 caractères.");
					}
					else if(strlen($summary) < 30){
						$postResult = array(1, "Le résumé doit contenir au moins 30 caractères.");
					}
					else if(strlen($content) < 100){
						$postResult = array(1, "Le contenu doit contenir au moins 100 caractères.");
					}
					else{
						$options = array(
							'title' => $title,
							'content' => $content,
							'summary' => $summary,
							'editors_id' => intval($_SESSION['editor_id']),
							'categories' => $catArray
							);
						$postModel = new PostsModel();
						if($postModel->addPost($options) == 1){
							$postResult = array(1, "Erreur lors de l'envoi du post. Veuillez réessayer plus tard.");
						}else{
							$postResult = array(0, "Le post a bien été ajouté.");
						}						
						$postModel->close();
					}
				}
				

				//if(isset($_POST['titre']))
			}
			
			$this->giveVar(compact('postResult'));
			$this->giveVar(compact('categories'));
			$this->giveVar(compact('canEdit'));
			$this->display('add');
		}
	}
?>
