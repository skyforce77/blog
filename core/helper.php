<?php

class html{

	public static function favicon($name){
		$link = ROOT."webroot/images/".$name;	
		return "<link rel=\"icon\" type=\"image/png\" href=\"".$link."\" >";
	}

	public static function image($link, $options = null){
		$link = ROOT."webroot/images/".$name;
		$string = "";
		if(is_array($options)){
			foreach ($options as $key => $value){
				$string .= $string." ".$key."=\"".$value."\"";
			}
		}
		return "<img src=\"".$link."\" ".$string.">";
	}

	public static function link($text, $link, $options = null){
		$string = '';
		if($link == null) {
			$link = WEBROOT;
		} else if(is_array($link) && array_key_exists('controller', $link) && array_key_exists('view', $link)){
			$temp = WEBROOT.$link['controller'].'/'.$link['view'];
			if(array_key_exists('params', $link)){
				$temp .= '/'.$link['params'];
			}
			$link = $temp;
		} else{
			if(strpos($link, 'http://')==false){
				$link = 'http://'.$link;
			}
		}
		if(is_array($options)){
			foreach ($options as $key => $value) {
				$string .= $string." ".$key."=\"".$value."\"";
			}
		}
		return '<a href="'.$link.'" '.$string.' >'.$text.'</a>';
	}

	public static function javascript($name){
		$link = WEBROOT."webroot/js/".$name;
		return "<script type=\"text/javascript\" src=\"".$link."\" > </script>";
	}

	public static function css($name, $options = null){
		$link = WEBROOT."webroot/css/".$name;
		$string = "";
		if(is_array($options)){
			foreach ($options as $key => $value) {
				$string .= $string." ".$key."=\"".$value."\"";
			}
		}
		return "<link href=\"".$link."\" rel=\"stylesheet\" type=\"text/css\" ".$string." />";
	}
}

?>
