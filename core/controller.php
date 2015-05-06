<?php
require_once(ROOT.'core/helper.php');

class Controller{
	protected $vars = array();
	protected $view = 'index';
	protected $layout = 'default';

	function display($filename){
		$layoutContent = "";
		extract($this->vars);

		ob_start();
		require_once(ROOT.'views/'.get_class($this).'/'.$filename.'.php');		
		$layoutContent = ob_get_clean();

		if($this->layout==null){
			echo $layoutContent;
		}
		else{
			require_once(ROOT.'views/layout/'.$this->layout.'.php');
		}
	}

	public function setView($value)
	{
		$this->view = $value;
	}
	public function getView()
	{
		return $this->view;
	}

	public function setLayout($value)
	{
		$this->layout = $value;
	}
	public function getLayout()
	{
		return $this->layout;
	}
	
	public function giveVar($name, $value=NULL){
		if (is_array($name)) {
			if (is_array($value)) {
				$data = array_combine($name, $value);
			} else {
				$data = $name;
			}
		} else {
			$data = array($name => $value);
		}
		$this->vars = $data + $this->vars;
	}
}
?>