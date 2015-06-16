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
				$editorsModel = new EditorsModel();

				$passwd = md5($_POST['passwd']);
				$login = htmlspecialchars($_POST['login']);

				$retour = $editorsModel->checkUser($_POST['login'],$passwd);
				$editorsModel->close();

				if(!empty($retour)) {
					$_SESSION['editor_id'] = $retour->getId();
					$_SESSION['editor_name'] = $retour->getName();
					$_SESSION['editor_email'] = $retour->getMail();
					$_SESSION['editor_public'] = $retour->isPublic();
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
			$editorsModel = new EditorsModel();
			//On verifie que l'utilisateur est déconnecté
			$postResult = array();

			if(isset($_SESSION['editor_id'])){
				$postResult = array(1, 'Vous êtes déjà connecté en tant qu\''.$_SESSION['editor_name'].'.');
			}
			if(isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['mail2']) && isset($_POST['passwd']) && isset($_POST['passwd2'])){
				$login = htmlspecialchars($_POST['login']);
				$passwd = md5(htmlspecialchars($_POST['passwd']));
				$passwd2 = md5(htmlspecialchars($_POST['passwd2']));
				$mail = htmlspecialchars($_POST['mail']);
				$mail2 = htmlspecialchars($_POST['mail2']);
				$public = 0;

				if(isset($_POST['public'])){
					$public = 1;
				}

				if (empty($login) || empty($passwd) || empty($passwd2) || empty($mail) || empty($mail2)) {
					$postResult = array(1, "Tout les champs doivent être remplis.");
				}
				else if(strlen($login) < 5 || strlen($login) > 30){
					$postResult = array(1, "Le login doit avoir entre 5 et 30 caractères.");
				}
				else if ($passwd != $passwd2) {
					$postResult = array(1, "Les deux mots de passes sont différents.");
				}
				else if ($mail != $mail2) {
					$postResult = array(1, "Les deux mails sont différents.");
				}
				else if(strlen(htmlspecialchars($_POST['passwd'])) < 5 || strlen(htmlspecialchars($_POST['passwd'])) > 30){
					$postResult = array(1, "Les mot de passe doit faire entre 5 et 30 caractères.");
				}
				else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
					$postResult = array(1, "Votre maile est invalide.");
				}
				else if($editorsModel->pseudoExist($login) == true){
					$postResult = array(1, "Ce pseudo est déjà pris.");
				}
				else if($editorsModel->mailExist($mail) == true){
					$postResult = array(1, "Un compte utilise déjà cette adresse mail.");
				}
				else{
					if($editorsModel->addEditor($login, $passwd, $mail, $public)==false){
						$postResult = array(1, "Erreur dans la base de donnée. Réessayez plus tard.");
					}else{
						$postResult = array(0, "Bienvue ".$login.". Vous pouvez rediger un post dès maintenant.");
					}
				}
				$editorsModel->close();
			}
			
			$sign_state = 3;
			$this->giveVar(compact('postResult'));
			$this->display('signIn');
		}

		public function profil($idEditor = 0){
			$editorsModel = new EditorsModel();
			$retour = $editorsModel->getUserById($idEditor);
			$editorsModel->close();
			
			if(!empty($retour)) {
				$this->giveVar("user",$retour);
			
				$postsModel = new PostsModel();
				$posts = $postsModel->selectByAuthor($retour->getName());
				$this->giveVar(compact('posts'));
				$postsCount = $postsModel->countByAuthor($retour->getName());
				$this->giveVar(compact('postsCount'));
				$postsModel->close();
			}
				
			$this->display('profil');
		}
	}
?>
