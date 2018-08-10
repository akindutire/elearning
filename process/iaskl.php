<?php
	
	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//School Reg.
		
	 	if($_POST['sbval']==1){		
				$name=htmlentities(ucwords(stripslashes(strip_tags(trim($_POST['sklname'])))));
				$saddress=stripslashes(ucwords(strip_tags(trim($_POST['saddress']))));
				$stel=trim($_POST['stel']);
				$spin=sha1(stripslashes(strip_tags($_POST['spin'])));
				$prin=htmlentities(ucwords(stripslashes(strip_tags(trim($_POST['prin'])))));
				$prmail=strtolower(trim($_POST['prmail']));
				$sex=trim($_POST['g']);
				
				if(!empty($_SESSION['funame']) && !empty($name) && !empty($saddress) && !empty($spin) && !empty($prin) && !empty($prmail) && !empty($stel)){	
						if(filter_var($prmail,FILTER_VALIDATE_EMAIL) && ($sex=='Female' || $sex=='Male')){
							
							$pfile=$_SESSION['funame'];
							
							$cp->askl($name,$saddress,$spin,$prin,$prmail,$pfile,$sex,$stel);					
							
							}else{
								echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Invalid Email or Gender</b>";
								}
	
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Please Select a file</b>";	
					}
		}else if($_POST['sbval']==2){
			
			//Student Reg.
			
				$sdname=htmlentities(ucwords(stripslashes(strip_tags(trim($_POST['sdname'])))));
				$sdtel=stripslashes(ucwords(strip_tags(trim($_POST['sdtel']))));
				$gender=trim($_POST['sdgender']);
				$sddp=trim($_POST['dp']);
				$term=trim($_POST['term']);
				$level=trim($_POST['level']);
				
				$adyr=date('Y',mktime());
				
				$level_id="$level/$term";

				
				if(!empty($sdname) && !empty($sdtel)&& !empty($gender)){
						
						if(($gender=='Female' || $gender=='Male')){
							
							$cp->astud($sdname,$sdtel,$gender,$adyr,$level_id,$sddp);					
							
							}else{
								echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Invalid Gender</b>";
								}
	
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Some fields missing</b>";	
					}
					
			}else if($_POST['sbval']==3){
				
				//Tutor Reg.
				
				$tutname=htmlentities(ucwords(stripslashes(strip_tags(trim($_POST['tutname'])))));
				$tutmail=strtolower(stripslashes(ucwords(strip_tags(trim($_POST['tutmail'])))));
				$tutgender=trim($_POST['tutgender']);
				$tutdp=trim($_POST['dp']);
				
				
				if(!empty($tutname) && !empty($tutmail)&& !empty($tutgender) && filter_var($tutmail,FILTER_VALIDATE_EMAIL)){
						
						if(($tutgender=='Female' || $tutgender=='Male')){
							
							$cp->atut($tutname,$tutmail,$tutgender,$tutdp);					
							
							}else{
								echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Invalid Gender</b>";
								}
	
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Some fields missing or E-mail Invalid</b>";	
					}
				}
			
			
			
	}//@End All Submit
	exit();
	
?>