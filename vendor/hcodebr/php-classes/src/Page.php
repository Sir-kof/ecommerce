<?php 

namespace Hcode;

use Rain\Tpl;

class Page { //classe de construção da página

	private $tpl; //atributo do template
	private $options = []; //atributo que recebe e exibe os dados
	private $defaults = [ //atributo que é vázio por padrão, utilizado para o padrão
		"data" => []
	];

	public function __construct($opts = array()) //função construtora da página
	{
		/* atribuindo a junção de valores o padrão, que é um parâmetro, que também é um array de dados colocados pelo usuário */
		$this->options = array_merge($this->defaults, $opts);

		//configurando a rota do template
		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
		);

		$this->tpl = new Tpl; //instanciando a classe Tpl
		
		//"chamando" a classe estática configure para configurar as rotas
		Tpl::configure($config);

		//chamando o método data com os dados encontrados
		$this->setData($this->options["data"]);

		//colocando os dados e assinando os valores para serem exibidos

		$this->tpl->draw("header");

	}
	private function setData($data = array())
	{
		//colocando os dados e assinando os valores para serem exibidos
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}

	public function setTpl($name, $data = array(), $returnHtml = false)
	{
		//chamando o método data com os dados encontradose colocando nos parâmetros
		$this->setData($data);

		return $this->tpl->draw($name, $returnHtml);
	}

	public function __destruct()
	{
		$this->tpl->draw("footer");

	}
}

 ?>