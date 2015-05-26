<?php

class CommentsModel extends Model{

	private $id;
	private $author;
	private $content;
	private $date_creation;
	private $postId;
	private $mail;

	function __construct(){
		parent::__construct('comments');
	}

	public function getByPostId($id){
		$sql = "SELECT * FROM ".$this->table." WHERE posts_id = :id";
		$query = $this->link->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_CLASS, 'CommentsModel');
		return $query->fetchAll();
	}

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
		return 0;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($author){
		$this->author = $author;
	}

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getDateCreation(){
		return $this->date_creation;
	}

	public function setDateCreation($dateCreation){
		$this->date_creation = $dateCreation;
	}

	public function getPostId(){
		return $this->postId;
	}

	public function setPostId($postId){
		$this->postId = $postId;
	}

	public function getMail(){
		return $this->mail;
	}

	public function setMail($mail){
		$this->mail = $mail;
	} 
}

?>