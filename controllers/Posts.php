<?php
	class Posts extends Controller{
		public function view($idPost){
			$postsModel = new PostsModel();
			$post = $postsModel->selectById($idPost);
			$commentsModel = new CommentsModel();
			$comments = $commentsModel->getByPostId($idPost);

			$postResult = array();
			$canEdit = 0;
			if(!empty($post->getId())) {
				$this->giveVar(compact('post'));
				if(isset($_SESSION['editor_id']) && $post->getAuthor() == $_SESSION['editor_name']) {
					$canEdit = 1;
				}
			}

			$this->giveVar(compact('canEdit'));

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

			$postsModel->close();
			$commentsModel->close();

			$editorsModel = new EditorsModel();
			$user = $editorsModel->getUserByName($post->getAuthor());
			$editorsModel->close();

			if(!empty($user))
				$this->giveVar(compact('user'));

			$this->giveVar(compact('postResult'));	
			$this->giveVar(compact('comments'));

			$this->display('view');
		}

		public function edit($idPost){
			$catModel = new CategoriesModel();
			$categories = $catModel->getAll();
			$catModel->close();

			$postResult = null;
			$canEdit = 0;			

			if(isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['content'])){				
				$title = htmlspecialchars($_POST['title']);
				$summary = htmlspecialchars($_POST['summary']);
				$content = htmlspecialchars($_POST['content']);
				$catArray = array();
				foreach ($categories as $value) {
					if(isset($_POST[$value->getName()])){
						array_push($catArray, intval($value->getId()));
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
						'id'=>$idPost,
						'editors_id'=>$_SESSION['editor_id'],
						'title' => $title,
						'content' => $content,
						'summary' => $summary,
						'categories' => $catArray
						);
					$postModel = new PostsModel();
					$res = $postModel->updateById($options);
					if($res > 0){
						$postResult = array(1, "Echec de traitement des données. Réessayez plus tard. Code : ".$res);
					}else{
						$postResult = array(0, "Le post a bien été modifié.");
					}						
					$postModel->close();
				}
			}

			$postsModel = new PostsModel();
			$post = $postsModel->selectById($idPost);
			$postsModel->close();

			if(!empty($post->getId())) {
				$this->giveVar(compact('post'));
				$inCats = explode(', ',$post->getCategories());
				$this->giveVar(compact('inCats'));
				if(isset($_SESSION['editor_name']) && $post->getAuthor() == $_SESSION['editor_name']) {
					$canEdit = 1;
				}
			}

			$this->giveVar(compact('postResult'));
			$this->giveVar(compact('canEdit'));
			$this->giveVar(compact('categories'));
			$this->display('edit');
		}

		public function delete($idPost){
			$postsModel = new PostsModel();
			$result = $postsModel->selectById($idPost);
			$author = null;
			$postResult = array();
			if(empty($result->getId())){
				$postResult = array(1 , "Ce post n'existe pas.");
			}else{
				$author = $result->getAuthor();
			}

			$canEdit = null;
			if(isset($_SESSION['editor_id']) && $author == $_SESSION['editor_name']){
				if($postsModel->deletePost($idPost) == false){
					$postResult = array(1 , "Erreur lors de la supression du post.");
					die();
				}else{
					$postResult = array(0 , "");
				}
			}else if(empty($postResult) && $author != $_SESSION['editor_name']){
				$postResult = array(1 , "Vous devez vous connecter en temps qu'auteur du post pour le supprimer");
			}
			
			$postsModel->close();

			$this->giveVar(compact('postResult'));
			$this->display('delete');		
		}

		public function add(){
			$catModel = new CategoriesModel();
			$categories = $catModel->getAll();
			$catModel->close();
			$catArray = array();

			$canEdit = 0;
			if(isset($_SESSION['editor_id'])) {
				$canEdit = 1;
				$content = $summary = $title = "";
				if(isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['content'])){
					$title = htmlspecialchars($_POST['title']);
					$summary = htmlspecialchars($_POST['summary']);
					$content = htmlspecialchars($_POST['content']);
					foreach ($categories as $value) {
						if(isset($_POST[$value->getName()])){
							array_push($catArray, $value->getId());
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
				
			}
			
			$this->giveVar(compact('summary'));
			$this->giveVar(compact('content'));
			$this->giveVar(compact('title'));
			$this->giveVar(compact('postResult'));
			$this->giveVar(compact('categories'));
			$this->giveVar(compact('canEdit'));
			$this->display('add');
		}
	}
?>
