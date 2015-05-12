<?php
	class Posts extends Controller{
		public function view($idPost){
			require_once(ROOT.'models/PostsModel.php');
			$postsModel = new PostsModel('posts_view');
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$postsModel->close();

			if(isset($post[0])) {
				$this->giveVar(compact('post'));
			}

			$commentsModel = new Model('comments');
			$comments = $commentsModel->select(array(), array('conditions' => 'posts_id = '.intval($idPost.'')));
			$commentsModel->close();

			$this->giveVar(compact('comments'));

			if(isset($_POST['mail']) && isset($_POST['pseudo']) && isset($_POST['text'])) {
				//Insérer le commentaire dans la bdd
			}

			$this->display('view');

			if(isset($_POST['mail']) && isset($_POST['pseudo']) && isset($_POST['text'])){
				if(empty($_POST['mail']) && empty($_POST['pseudo']) && empty($_POST['text'])){
					return array(1, 'Veuillez remplir tout les champs');
				}
				if(strlen($_POST['pseudo']) < 5 || strlen($_POST['pseudo']) > 30){
					return array(1, 'La taille de votre pseudo doit être comprise entre 5 et 30 caractères');
				}
				if(strlen($_POST['text']) < 10 || strlen($_POST['text']) > 300){
					return array(1, 'La taille de votre commentaire doit être comprise entre 10 et 300 caractères');
				}
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
