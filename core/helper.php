<?php

class html{

	public static function favicon($name){
		$link = ROOT."webroot/image/".$name;	
		return "<link rel=\"icon\" type=\"image/png\" href=\"".$link."\" >";
	}

	public static function image($link, $options = null){
		$link = ROOT."webroot/js/".$name;
		$string = "";
		if($options != null){
			foreach ($options as $key => $value){
				$string .= $string." ".$key."=\"".$value."\"";
			}
		}
		return "<img src=\"".$link."\" ".$string.">";
	}

	public static function link($text, $link, $options = null){
		$link = ROOT."webroot/js/".$name;
		$string = "";
		if($options != null){
			foreach ($options as $key => $value){
				$string .= $string." ".$key."=\"".$value."\"";
			}
		}
		return "<script type=\"text/javascript\" src=\"".$link."\" ".$string.">".$text."</script>";
	}

	public static function javascript($name){
		$link = ROOT."webroot/js/".$name;
		return "<script type=\"text/javascript\" src=\"".$link."\" > </script>";
	}

	public static function css($name, $options = null){
		$link = ROOT."webroot/css/".$name;
		$string = "";
		if($options != null){
			foreach ($options as $key => $value) {
				$string .= $string." ".$key."=\"".$value."\"";
			}
		}
		return "<link href=\"".$link."\" rel=\"stylesheet\" type=\"text/css\" ".$string." />";
	}
}

?>