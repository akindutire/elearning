<?php
	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
	$file='conn/update.txt';
	$var='';
	$cp=new user($file);
	$cp->validateus();
	
	$sbj=$_SESSION['stp'];
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
		@$sql10101010=mysqli_query($link,"SELECT id,pix FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$ps)."'");
		@list($uid,$pix)=mysqli_fetch_row($sql10101010);	
	
	$sql=mysqli_query($link,"UPDATE stud_exam_status SET report='Exam Completed',status='1' WHERE sbj_id='$sbj' and stud_id='$uid'");
	
	$cp->marktest($sbj);		
	
	header('location:lfinish.php');
			
?>