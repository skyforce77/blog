<?php
	class Index extends Controller{
		public function main(){	
			$categoriesModel = new Model('categories');
			$categoriesModel->insert(array('name'=>'gastronomie'));
			//$categoriesModel->delete('name = \'gastronomie\'');
			$this->giveVar('categories', $categoriesModel->select(array('name')));
			$categoriesModel->close();
			$this->display('index');
		}
	}
?>