<?php
	
	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$login=new user($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$tel=(trim($_POST['tel']));
		$pinn=stripslashes(strip_tags($_POST['pin']));
		
			
					
	
	
		if(is_numeric($tel) && is_string($pinn)){
			
			$login->ulogin($tel,$pinn);
			
		}else{
			echo "<b><img src='images/cancel.png' width='auto' height='13px'>&nbsp;Incorrect Field Format</a></b>";
		}
	}
	exit();
?>