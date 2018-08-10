<?php
//@045061298270
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	$ret_id=(int)$_POST['retrieve_id'];	

	if ($ret_id==1) {
		
		$sbj_id=(int)$_POST['sbj_id'];
		$cp->getRecentQuestions($sbj_id);

	}else{
		echo null;
	}
exit();	
?>