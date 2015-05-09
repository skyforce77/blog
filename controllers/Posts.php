<?php
	class Posts extends Controller{
		public function view($idPost){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();	
			//On verifie que le post existe
		}

		public function edit($idPost){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

		public function delete($idPost){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

		public function add(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que l'utilisateur est connecté
		}
	}
?>
