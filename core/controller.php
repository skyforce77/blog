<?php


class Controller{
	protected $vars = array();
	protected $view;
	protected $layout;

	/* 
	Cette fonction verifie si l'utilisateur est connecter et que sa session est valide 
	RETURN :
	0 : la session est invalide 
	1 : connecter avec une session valide
	2 : pas de session
	*/
	public static function check_session(){
		if(isset($_SESSION['editor_id']) && intval($_SESSION['editor_id']) != 0){ //Vérification id
		
			//utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
			$editorModel = new Model('editors');
			$retour = $editorModel->select(array(), array('conditions' => 'id = '.intval($_SESSION['membre_id'].'');

			//Si la requête a un résultat (c'est-à-dire si l'id existe dans la table membres)
			if(isset($retour['name']) && $retour['editor_name'] != ''){
				if($_SESSION['editor_password'] != $retour['password']){					
					return 0;	
					session_destroy();
				}	
				//Validation de la session.
				$_SESSION['editor_id'] = $retour['id'];
				$_SESSION['editor_name'] = $retour['name'];
				$_SESSION['editor_password'] = $retour['password'];
				$_SESSION['editor_mail'] = $retour['mail'];
				$_SESSION['editor_public'] = $retour['public'];
			}
			return 1;
		}
		return 2;
	}

	public function __construct(){
		$this->view = 'index';
		$this->layout = 'default';
	}

	public function display($filename){
		$layoutContent = "";
		extract($this->vars);

		ob_start();
		require_once(ROOT.'views/'.get_class($this).'/'.$filename.'.php');		
		$layoutContent = ob_get_clean();

		if($this->layout==null){
			echo $layoutContent;
		}
		else{
			require_once(ROOT.'views/layout/'.$this->layout.'.php');
		}
	}

	public function setView($value)
	{
		$this->view = $value;
	}
	public function getView()
	{
		return $this->view;
	}

	public function setLayout($value)
	{
		$this->layout = $value;
	}
	public function getLayout()
	{
		return $this->layout;
	}
	
	public function giveVar($name, $value=NULL){
		if (is_array($name)) {
			if (is_array($value)) {
				$data = array_combine($name, $value);
			} else {
				$data = $name;
			}
		} else {
			$data = array($name => $value);
		}
		$this->vars = $data + $this->vars;
	}
}
?>