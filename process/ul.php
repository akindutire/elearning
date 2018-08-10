<?php
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
		$val=$_POST['ltype'];
	
	
		$school=array();
		$school=$_POST['check'];

		$cp->lockandunlock($school,$val);
	
exit();
?>
