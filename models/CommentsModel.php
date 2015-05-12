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


		$req = $this->link->prepare('INSERT INTO comments (author, content, mail, posts_id, date_creation) VALUES (:author, :comment, :mail, :posts_id, :date_creation)');
		$req->execute(array(
			':author' => $array['pseudo'],
			':comment' => $array['comment'],
			':mail' => $array['mail'],
			':posts_id' => $array['postId'],
			':date_creation' => date("Y-m-d H:i:s")
			));
	}
}

?>