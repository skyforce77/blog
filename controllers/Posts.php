<?php
	class Posts extends Controller{
		public function view($idPost){
			$postsModel = new Model('posts_view');
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$postsModel->close();
			
			if(isset($post[0])) {
				$this->giveVar(compact('post'));
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
