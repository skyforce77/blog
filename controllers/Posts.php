<?php
	class Posts extends Controller{
		public function view($idPost){
			$sessionStatu = controller::statu();
			$this->giveVar(compact('sessionStatu'));
			//On verifie que le post existe
		}

		public function edit($idPost){
			$sessionStatu = controller::statu();
			$this->giveVar(compact('sessionStatu'));
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

		public function delete($idPost){
			$sessionStatu = controller::statu();
			$this->giveVar(compact('sessionStatu'));
			//On verifie que le post existe
			//On verifie que l'utilisateur est connecté
			//On verifie que c'est l'auteur
		}

		public function add(){
			$sessionStatu = controller::statu();
			$this->giveVar(compact('sessionStatu'));
			//On verifie que l'utilisateur est connecté
		}
	}
?>
