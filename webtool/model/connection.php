<?php 

/**
* Conection
*/
class connect
{

	// Añade la paginacion.	
	private $pages;
	
	private static $connect;
	function __construct()
	{
		self::$connect = new PDO("mysql:host=localhost;dbname=codecs","root","");
		self::$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		self::$connect->exec('SET CHARACTER SET utf8');
	}

	public function db($sql,$array,$fetch=false){

	 $prepare = self::$connect->prepare($sql);

	 if ( empty($array) ) {
	 	$prepare->execute();
	 }else{
	 	$prepare->execute($array);	 	
	 }

	 if ( $fetch ) {	 	
	 	$return = $prepare->fetch(PDO::FETCH_ASSOC);
	 	return $return;
	 }else{
	 	return $prepare;
	 }
	}

	public function limits_sql($sql,$from,$until = 10,$arrs = false){

		

		if ( is_nan($from) || is_nan($until) ) {
			return;
		}

		$firs_r = $this->db($sql,array());
		$count = $firs_r->rowCount();

		$this->pages = floor($count / $until);

		$sqlrepare = $sql . " LIMIT $from, $until";
		if (! $arrs ) {
			$consult = $this->db($sqlrepare,array());	
			
		}else if(is_array($arrs)){
			$consult = $this->db($sqlrepare,$arrs);
		}		
		return $consult;
	}

	public function get_pagination(){
		global $url;
		?>
		<ul class="pagination">	
		<?php	for ($i=1; $i < $this->pages+2 ; $i++) :?>
			<?php if ($_GET["pag"]!=$i): ?>
				
				<li class="li-pagination li-pagination-<?php echo $i; ?>"><a href="<?php echo $url ?>?pag=<?php echo $i ?>"><?php echo $i ?></a></li>
			<?php else: ?>
				<li class="li-pagination li-pagination-<?php echo $i; ?>"><?php echo $i ?></li>
			<?php endif; ?>
		<?php	endfor; ?>
		</ul>
		<?php
	}
}