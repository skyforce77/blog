<?php
	class Categories extends Controller{
		public function view($idCategorie){
			$categoriesModel = new Model('categories');
			$categories = $categoriesModel->select(null, array('conditions' => 'id='.$idCategorie));
			$categoriesModel->close();
			$this->giveVar(compact('categories'));
			$this->display('view');
		}
	}
?>
