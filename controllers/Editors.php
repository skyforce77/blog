<?php
	class Editors extends Controller{
		public function view(){
			$this->init();
			//On verifie que le post existe
		}

		public function login(){
			session_start();
			if(isset($_POST['login']) && isset($_POST['passwd'])) {
				$_SESSION['editor_id'] = $_POST['login'];
				$_SESSION['editor_password'] = md5($_POST['passwd']);
			}
			$this->init();
			//On verifie que l'utilisateur est déconnecté
			$this->display('login');
		}

		public function signIn(){
			$this->init();
			//On verifie que l'utilisateur est déconnecté
		}

		public function edit(){
			$this->init();
			//On verifie que l'utilisateur est connecté
			// On verifie que c'est le proprio du profil
			$this->display('edit');
		}

		public function delete(){
			$this->init();
			//On verifie que l'utilisateur est connecté
		}

		public function profil(){
			$this->init();
			//On verifie si c'est sont profil
		}
	}
?>
