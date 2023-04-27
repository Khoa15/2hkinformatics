<?php
$name = (!empty($_GET['id'])) ? $_GET['id'] : false;
if($name){
	$name = htmlspecialchars(addslashes($name));
	$name = str_replace('/', "", $name);
	$path = 'assets/file/'.$name.'.docx';
	if(file_exists($path)){
		deletefile($path);
	}
}
function deletefile($path){
	sleep(3);
	unlink($path);
	if(file_exists($path)){
		deletefile($path);
	}
}
?>