<?php 

/**
* Create a class to self pages.
*/
class methods extends connect
{

	public $menu; 
	private $headers = [];
	
	public function __construct($heads = []){
		global $menu1;
		$this->menu = $menu1;
		parent::__construct();	

		$this->headers["title"] = "Codecs";
		$this->headers["body-class"] = "body";
		$this->headers["styles"] = array();
		$this->headers["scripts"] = array();

		if ( ! empty($heads) ) {
				foreach($heads as $newheads => $newval){

					switch ($newheads) {
						case 'title':
							$this->headers["title"] = $newval;
							break;
						case 'styles':
							$this->headers['styles'] = $newval;
							break;
						case 'scripts':
							$this->headers['scripts'] = $newval;
							break;
						case 'body-class':
							$this->headers['body-class'] = $newval;
							break;
					}
				}
			}
			?>
			<!DOCTYPE html>
					<html>
					<head>
						<meta charset="utf-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<title><?php echo $this->headers['title']; ?></title>
						<?php 
						for ($i=0; $i< count($this->headers['styles']); $i++) { 
							echo "<link rel='stylesheet' href='public/css/".$this->headers['styles'][$i].".css'>";
						}
						for ($i=0; $i< count($this->headers['scripts']) ; $i++) { 
							echo "<script type='text/javascript' src='public/js/".$this->headers['scripts'][$i].".js'></script>";
						}
						 ?>
					</head>
					<body class="<?php echo $this->headers['body-class']; ?>">						
			
			<?php
	}

	function __desctuct(){
		// Finalizacion de estructura html
		?>

		</body>
		</html>
		<?php
	}

	
	/**
	*Colors
	*/

	public function colors(){	

		// Inicio de Código

		echo $this->menu;
		
		$sql = "SELECT * FROM schemes ORDER BY schemes.name ASC";

		if (! isset($_GET["pag"])) {
			$_GET["pag"] = 1;
			$pag = $_GET["pag"];

		}else{
			$pag = $_GET["pag"];
		}
		$xfor = ($pag - 1) * 20;
		$whiling = $this->limits_sql($sql,$xfor,20);

		?>
		<div class="global-content">
		<?php	while($as = $whiling->fetch(PDO::FETCH_ASSOC)):	?>

			<div class="boxing">
				<img src="Sublime Text/Salida/<?php echo $as["name"]; ?>(0).jpg" alt="">
				<h3 class="title_color_scheme">						
					<?php echo $as["name"]; ?>
				</h3>
				<h4 class="author_color_scheme">
					<?php echo $as["author"]; ?>
				</h4>
				<p class="comment_color_scheme">
					<?php echo $as["comment"]; ?>
				</p>
			</div>				
			<?php endwhile; ?>	
		<div class="pagination-div">
			<style>
				.li-pagination-<?php echo $_GET["pag"];?>{
					color:red;
				}
			</style>	
			<?php $this->get_pagination(); ?>
		</div>
			
		</div>
	<?php
	}
	public function index(){

		

	}

}