<?php
	class Editors extends Controller{
		public function view(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que le post existe
		}

		public function login(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que l'utilisateur est déconnecté
			$this->display('login');
		}

		public function signIn(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que l'utilisateur est déconnecté
		}

		public function edit(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que l'utilisateur est connecté
			// On verifie que c'est le proprio du profil
			$this->display('edit');
		}

		public function delete(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie que l'utilisateur est connecté
		}

		public function profil(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			//On verifie si c'est sont profil
		}
	}
?>
