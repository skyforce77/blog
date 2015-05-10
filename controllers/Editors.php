<?php
	class Editors extends Controller{
		public function view(){
			
			//On verifie que le post existe
		}

		public function login(){
			session_start();
			if(isset($_POST['login']) && isset($_POST['passwd'])) {
				//ATTENTION TU NE VERIFIE PAS LA CONNECTION !!

				$_SESSION['editor_id'] = $_POST['login'];
				$_SESSION['editor_password'] = md5($_POST['passwd']);
				$_SESSION['editor_email'] = md5($_POST['passwd']);
			}
			

			//On verifie que l'utilisateur est déconnecté
			$this->display('login');
		}

		public function signIn(){
			
			//On verifie que l'utilisateur est déconnecté
		}

		public function edit(){
			
			//On verifie que l'utilisateur est connecté
			// On verifie que c'est le proprio du profil
			$this->display('edit');
		}

		public function delete(){
			
			//On verifie que l'utilisateur est connecté
		}

		public function profil(){
			
			//On verifie si c'est sont profil
		}
	}
?>
