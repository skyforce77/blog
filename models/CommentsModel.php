<?php

class CommentsModel extends Model{
	public function sendComment($array)
	{
		//On verifie que tout les paramètres on été passés
		$key = array('pseudo', 'mail', 'comment', 'postId');
		foreach($key as $value){
			if(!array_key_exists($value, $array)){
				return 1;
			}
		}

		//$this->insert();
	}
}

?>