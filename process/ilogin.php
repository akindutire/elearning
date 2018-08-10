<?php
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	$file='../conn/update.txt';
	$login=new process($file);

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$mail=(strtolower(trim($_POST['mail'])));
		$pin=(stripslashes(strip_tags($_POST['pin'])));
			$pin=sha1($pin);
		if(filter_var($mail,FILTER_VALIDATE_EMAIL)==true && is_string($pin)){
			$login->adlogin($mail,$pin);
		}else{
			echo "<b><img src='../images/cancel.png' width='auto' height='13px'>&nbsp;Incorrect Field Format</a></b>";
		}
	}
	exit();
?>