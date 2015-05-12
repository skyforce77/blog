<?php

class EditorsModel extends Model{
	public function checkUser($login = null,$pass){
		$ret = $this->select(array(), array('conditions' => 'name = '.intval($_POST['login'].'')));
		if(count($ret) == 0){
			return null;
		}
		if($ret[0]['password'] != $pass){
			return null;
		}

		return $ret;
	}
}
?>
