<?php
	class Posts extends Controller{
		public function view($idPost){
			require_once(ROOT.'models/PostsModel.php');
			require_once(ROOT.'models/CommentsModel.php');
			$postsModel = new PostsModel('posts_view');
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$postsModel->close();

			if(isset($post[0])) {
				$this->giveVar(compact('post'));
			}

			$commentsModel = new CommentsModel('comments');
			$comments = $commentsModel->select(array(), array('conditions' => 'posts_id = '.intval($idPost.'')));
			$commentsModel->close();

			$this->giveVar(compact('comments'));			
			$this->display('view');

			if(isset($_POST['mail']) && isset($_POST['pseudo']) && isset($_POST['text'])){
				$message = "";
				if(empty($_POST['mail']) && empty($_POST['pseudo']) && empty($_POST['text'])){
					$message .= 'Veuillez remplir tout les champs.<br>';
				}
				if(strlen($_POST['pseudo']) < 5 || strlen($_POST['pseudo']) > 30){
					$message .= 'La taille de votre pseudo doit être comprise entre 5 et 30 caractères.<br>';
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
						return array(1, 'Erreur lors de l\'envoi de votre commentaire.');
					}

					return array(0, 'Votre commentaire a été posté.');
				}
				return array(1, $message);
			}
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
