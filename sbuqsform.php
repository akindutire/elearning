<?php


	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
	$file='conn/update.txt';
	$var='';
	$cp=new user($file);
	$cp->validateus();
	
	
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
		@$sql10101010=mysqli_query($link,"SELECT id,pix FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$ps)."'");
		@list($uid,$pix)=mysqli_fetch_row($sql10101010);
		
	
	
	$sbj=$_SESSION['stp'];
		
	$question_id=trim($_POST['qid']);
	$answer=trim($_POST['uans']);
	$idate=date('H:i:s',mktime());

	
	$sql_check=mysqli_query($link,"UPDATE exam_pro SET choosen_ans='$answer' WHERE stud_id='$uid' and id='$question_id'");
	$sql_update_time=mysqli_query($link,"UPDATE stud_exam_status SET lastmin='$idate' WHERE sbj_id='$sbj'");
	if($sql_check){
		
		echo "Answer Saved!";
		
	}else{
		echo "System Error: 403 Forbidden";
		}	
	


?>