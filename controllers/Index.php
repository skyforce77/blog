<?php
	class Index extends Controller{
		public function view(){
			$categoriesModel = new Model('categories');
			$this->giveVar('categories', $categoriesModel->select());
			$categoriesModel->close();
			$this->display('view');
		}
	}
?>
