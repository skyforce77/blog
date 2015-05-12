<?php
	class Posts extends Controller{
		public function view($idPost){
			$postsModel = new Model('posts_view');
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
