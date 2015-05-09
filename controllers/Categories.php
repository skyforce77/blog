<?php
	class Categories extends Controller{
		public function view($idCategorie){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('id','name')));
			$categoriesModel->close();
			$this->display('view');
		}
	}
?>
