<?php

	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new user($file);
	
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
		@$sql10101010=mysqli_query($link,"SELECT id,pix FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$ps)."'");
		@list($uid,$pix)=mysqli_fetch_row($sql10101010);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		
			
			
			foreach($_POST['sbjkey'] as $sbj){
				
				$sql=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE sbj_id='$sbj'");
				$sql=mysqli_query($link,"DELETE FROM exam_pro WHERE sbj_id='$sbj'");
				
				}
			header('location:../imsbj.php');
		}
		
				

	exit();
?>