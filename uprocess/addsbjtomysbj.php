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
		
		
			
			$sql=mysqli_prepare($link,"INSERT INTO stud_sbj_profile(id,stud_id,level,sbj_id,score,pri,cat,etest) VALUES(?,?,?,?,?,?,?,?)");
			foreach($_POST['sbjkey'] as $sbj){
				
				$lsql=mysqli_query($link,"SELECT cat,etest FROM subject WHERE id='$sbj'");
				list($cat,$etest)=mysqli_fetch_row($lsql);
				
				
				$nsql=mysqli_query($link,"SELECT sbj_id FROM stud_sbj_profile WHERE sbj_id='$sbj' and stud_id='$uid'");
				
				
				if(mysqli_num_rows($nsql)>0){
					continue;
				}else{
					$cp->addtomysbj($sql,$sbj,$cat,$etest);
					}
				
				
				}
			header('location:../imsbj.php');
		}
		
				

	exit();
?>