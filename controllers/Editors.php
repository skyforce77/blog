<?php
	class Editors extends Controller{
		public function view(){
			
			//On verifie que le post existe
		}

		/* login_state
			3. Nothing special
			2. Déconnection
			1. Connection réussie
			0. Connection échouée
		*/
		public function login(){
			$login_state = 3;
			if(isset($_POST['login']) && isset($_POST['passwd'])) {
				$editorModel = new Model('editors');
				$retour = $editorModel->select(array(), array('conditions' => 'name = '.intval($_POST['login'].'')));
				$editorModel->close();

				$passwd = md5($_POST['passwd']);
				if(isset($retour[0]['password']) && $passwd == $retour[0]['password']) {
					$_SESSION['editor_id'] = $_POST['login'];
					$_SESSION['editor_password'] = $passwd;
					$_SESSION['editor_name'] = $retour[0]['name'];
					$_SESSION['editor_email'] = $retour[0]['mail'];
					$_SESSION['editor_public'] = $retour[0]['public'];
					$login_state = 0;
				} else {
					$login_state = 1;
				}
			} else if(isset($_POST['logout'])) {
				session_unset();
				session_destroy();
				session_start();
				$login_state = 2;
			}
			
			$this->giveVar(compact('login_state'));
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
