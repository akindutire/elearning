<?php

	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	$name=strtolower($_FILES['file']['name']);
	$type=strtolower($_FILES['file']['type']);
	$size=(int)($_FILES['file']['size'])/1024;
	$tmp=$_FILES['file']['tmp_name'];
	
	
	
		$arraytype=array('image/png','image/jpg','image/gif','image/jpeg');
		
		if(!empty($name) && $size<=95 || $size=''){
			if(in_array($type,$arraytype)){
				
					$filename=mktime().$name;
					
					if(move_uploaded_file($tmp,'../uploads/qimg/del/'.$filename)){
						$_SESSION['valid']=1;
						$_SESSION['quname']=$filename;
						echo 101;
						}else{
							@$_SESSION['valid']=0;

							echo "<b><img src='../images/cancel.png' width='auto' height='13px'>System Error: Couldn't Complete File Submission</b>";
							}
					
					
					}else{
						@$_SESSION['valid']=0;
						
						echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;Unsupported File format, Suggest Using jpg file</b>";
				}
		}else{
			@$_SESSION['valid']=0;
			echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;No File Selected or File Too Large</b>";
			
			}
		
exit();	
?>