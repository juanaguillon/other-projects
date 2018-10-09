<?php 

/**
* Conectar a base de datos
*/
class connect 
{
	protected $connect;
	protected function __construct()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=opencl","root","");
		$this->connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->connect->exec("SET CHARACTER SET utf8");
	}
	
}