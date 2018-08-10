<?php
	//@ Within this file and class  function is,
	 //deletion of students-ltype 2, 
	 //tutor-ltype,3(lock),4(unlock), 
	 //Delete subject(5) ,
	 //locking and Unlocking(ltype 0, 1 resp.) of Principal

	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	$file='../conn/update.txt';
	$cp=new process($file);

	$bk=(int)trim($_POST['ltype']);
	
		if($bk==1){
			foreach($_POST['check'] as $id){

				$cp->lockandunlock($bk,$id);

				}
		}else if($bk==0){
			foreach($_POST['check'] as $id){

				$cp->lockandunlock($bk,$id);
				
				}//Foreach End
				
		}else if($bk==2){
			
			foreach($_POST['sdkey'] as $userid){
				
				$sql_sel=mysqli_query($link,"SELECT password FROM users WHERE id='$userid'");
				list($pass)=mysqli_fetch_row($sql_sel);
				$sql_del_rec=mysqli_query($link,"DELETE FROM rec WHERE sh='$pass'") or die('System Error:Retry');
				
				$sql_del=mysqli_query($link,"DELETE FROM users WHERE id='$userid'") or die('System Error:Retry');
				$sql_del_cont=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE uid='$userid'");
				
				
				

			}//Foreach End
			header('location:../admin/vstud.php');
		}else if($bk==3){
			
			foreach($_POST['tutkey'] as $userid){
				$bk=1;
				//echo $userid;
				$cp->lockandunlocktut($bk,$userid);

			}//Foreach End
			
		}else if($bk==4){
			
			foreach($_POST['tutkey'] as $userid){
				$bk=0;
				$cp->lockandunlocktut($bk,$userid);

			}//Foreach End

		}else if($bk==5){

			foreach($_POST['sbjkey'] as $sbj){
				
				$cp->deletesbj($sbj);

			}//Foreach End			
			
		}
		
		
		
			
	exit();

?>