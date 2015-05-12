<?php
	class Posts extends Controller{
		public function view($idPost){
			require_once(ROOT.'models/PostsModel.php');
			require_once(ROOT.'models/CommentsModel.php');

			$postResult = null;

			$postsModel = new PostsModel('posts_view');
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			

			if(isset($post[0])) {
				$this->giveVar(compact('post'));
			}

			$commentsModel = new CommentsModel('comments');
			$comments = $commentsModel->select(array(), array('conditions' => 'posts_id = '.intval($idPost.'')));
			

			if(isset($_POST['mail']) && isset($_POST['pseudo']) && isset($_POST['text'])){
				$message = "";
				
				if(isset($_SESSION['dateComment'])){
					$date = $_SESSION['dateComment'];
					$diff = abs(floor($date - time())/60);
					if ($diff < 3){
						$message .= 'Vous devez attendre '.variant_int(3-$diff).'min pour poster un autre commentaire';
					}
				}
				if(empty($_POST['mail']) && empty($_POST['pseudo']) && empty($_POST['text'])){
					$message .= 'Veuillez remplir tout les champs.<br>';
				}
				if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 30){
					$message .= 'La taille de votre pseudo doit être comprise entre 4 et 30 caractères.<br>';
				}
				if(strlen($_POST['text']) < 10 || strlen($_POST['text']) > 300){
					$message .= 'La taille de votre commentaire doit être comprise entre 10 et 300 caractères.<br>';
				}
				if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				   	$message .= 'Votre addresse mail est invalide.<br>';
				}
				if(empty($message)){
					$ret = $commentsModel->sendComment(array(
						'pseudo'=>$_POST['pseudo'], 
						'mail'=>$_POST['mail'],
						'comment'=>$_POST['text'],
						'postId'=>$idPost
						));
					if($ret == 1){
						$postResult = array(1, 'Erreur lors de l\'envoi de votre commentaire.');
					}else{
						$postResult = array(0, 'Votre commentaire a été posté.');
						$_SESSION['dateComment'] = time();
					}

				}else{
					$postResult = array(1, $message);
				}
			}
			$postsModel->close();
			$commentsModel->close();
			$this->giveVar(compact('postResult'));	
			$this->giveVar(compact('comments'));

			$this->display('view');
		}

		public function edit($idPost){
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

		public function delete($idPost){			
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

		public function add(){
			//On verifie que l'utilisateur est connecté
		}
	}
?>
