<?php



namespace Hcode;

use Rain\Tpl;

class page{

	private $tpl;
	private $options = [ ];

	private $defaults =[

		"data"=>[]



	];

	public function__construct($opts = array()){

		$this->options = array_merge($this->defaults , $opts);


		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOt"]."views-cache/",
			"debug"         => false // set to false to improve the speed
		);

		Tpl::configure( $config );

		$tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header");

	}

	private function setData($data = array())
	{
		foreach ($data as $key => $value) {
			$this->tpl->assign($key , $value);
		}



	public function setTpl($name , $data = array() , $returnHtml = false)

	{

		$this->setData($data);
		return $this->tpl->draw($name , $returnHtml);
		}



	public function__destruct(){
		$this->tpl->draw("footer");


	}
}


?>