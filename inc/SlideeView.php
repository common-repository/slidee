<?php

class SlideeView
{
	private $_fileName;

	public function __construct($fileName)
	{
		$this->_fileName = $fileName;
	}

	public function render($data = [])
	{
		$fileName = __DIR__ . '/../views/' . $this->_fileName . '.php';

		extract($data);

		ob_start();
		include $fileName;
		$output = ob_get_clean();

		echo $output;
	}

}