<?php
	class Layouts extends Controller{
		public static function getCategories(){
			$categoriesModel = new Model('categories');
			$ret = $categoriesModel->select();
			$categoriesModel->close();
			return $ret;
		}
	}
?>
