<?php
	class Index extends Controller{
		public function view(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			$this->display('view');
		}
	}
?>
