<?php 
$files = [];
$i = 0;
foreach(glob('Sublime Text/TmTheme/*.tmTheme') as $file){
	$files[] = str_replace('.tmTheme','',$file);
	$files[$i] = str_replace('Sublime Text/TmTheme/','',$files[$i]);
	$i++;

}
foreach (glob('Sublime Text/Entrada/*.jpg') as $cap) {
	$captures[] = $cap;
}

$count = 0;
$each = 0;
for ($i=0; $i <count($captures) ; $i++) { 
	if ( ! empty($files[$count]) ) {
		
		$new_capts[] = rename($captures[$i],"Sublime Text/Salida/".$files[$count]."($each).jpg");

	}
	$each++;
	if ($each == 6) {
		$count++;
		$each  = 0;
	}	
}

for ($i=0; $i < count($new_capts) ; $i++){ 
	echo $i . "<br>";
}
// $i = 1;
// foreach ($files as $key) {
// 	echo "<div>$i $key</div>";
// 	$i++;
// }

