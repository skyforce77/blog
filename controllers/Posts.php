<?php
	class Posts extends Controller{
<<<<<<< HEAD
		public function view($idPost){
			$postsModel = new Model('posts');
			$post = $postsModel->select(array(), array('conditions' => 'id = '.intval($idPost.'')));
			$postsModel->close();
			
			if(isset($post[0])) {
				$this->giveVar(compact('post'));
			}

			$this->display('view');
		}

		public function edit($idPost){
=======
		public function view($idPost){			
			//On verifie que le post existe
		}

		public function edit($idPost){			
>>>>>>> 380f8e98acacba8ddbadceb70ccdd692de4fd409
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

<<<<<<< HEAD
		public function delete($idPost){
=======
		public function delete($idPost){			
>>>>>>> 380f8e98acacba8ddbadceb70ccdd692de4fd409
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

<<<<<<< HEAD
		public function add(){
=======
		public function add(){			
>>>>>>> 380f8e98acacba8ddbadceb70ccdd692de4fd409
			//On verifie que l'utilisateur est connecté
		}
	}
?>
