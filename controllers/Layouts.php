<?php
	class Layouts extends Controller{
		public static function getCategories(){
			require_once(ROOT.'models/CategoriesModel.php');
			$categoriesModel = new CategoriesModel('categories');
			$ret = $categoriesModel->select();
			$categoriesModel->close();
			return $ret;
		}
	}
?>
