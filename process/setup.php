<?php

	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	$sbj=$_POST['sbj'];
	$ck=mysqli_query($link,"SELECT * FROM etest_durations WHERE sbj_id='$sbj'");
	if(mysqli_num_rows($ck)==0){	
		
				$sql_part=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE sbj_id='$sbj'");
				$participant=mysqli_num_rows($sql_part);
				if($participant>0){
					$sql_update=mysqli_query($link,"UPDATE stud_sbj_profile SET etest='unsaved' WHERE sbj_id='$sbj'");
					}

		
		
		$sql=mysqli_prepare($link,"INSERT INTO etest_durations(id,sbj_id,period,no_q,no_p) VALUES(?,?,?,?,?)");
		$e='';

	
		$pr=$_POST['mtp'];
		$q=$_POST['qu'];
		$p=$_POST['op'];
			
		if($pr>420){
			echo "Can't Exceed Period Limit: Set Period Below 7 hours(420 Min.)";
		}else{
	
			mysqli_stmt_bind_param($sql,'iiiii',$e,$sbj,$pr,$q,$p);
			
			if(mysqli_stmt_execute($sql)){
				
			$s_up_sbj=mysqli_query($link,"UPDATE subject SET etest='unsaved' WHERE id='$sbj'") or die('403 Forbidden');			
			$_SESSION['sbj']=$sbj;
				echo 101;
			}else{
				echo "Please Try Again ,An Error Occured";
			}
		}//Time Limit
	}else{
		$_SESSION['sbj']=$sbj;
		echo 101;
		}
	
?>