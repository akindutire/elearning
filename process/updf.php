<?php
//@045061298270
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	$name=strtolower($_FILES['hfile']['name']);
	$type=strtolower($_FILES['hfile']['type']);
	$size=(int)($_FILES['hfile']['size']);
	$tmp=$_FILES['hfile']['tmp_name'];
	
	
	
		$arraytype=array('application/pdf');
		
		if(!empty($name)){
			if(in_array($type,$arraytype)){
				
					$filename=mktime().$name;
					
					if(move_uploaded_file($tmp,'../uploads/library/del/'.$filename)){
						$_SESSION['valid']=1;
						$_SESSION['funame']=$filename;
						echo 101;
						}else{
							@$_SESSION['valid']=0;

							echo "<b><img src='../images/cancel.png' width='auto' height='13px'>System Error: Couldn't Complete File Submission</b>";
							}
					
					
					}else{
						@$_SESSION['valid']=0;
						
						echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;Unsupported File format, Suggest Using PDF file</b>";
				}
		}else{
			@$_SESSION['valid']=0;
			echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;No File Selected</b>";
			
			}
		
exit();	
?>