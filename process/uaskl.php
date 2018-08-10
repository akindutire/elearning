<?php

	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	$name=strtolower($_FILES['file']['name']);
	$type=$_FILES['file']['type'];
	$size=(int)($_FILES['file']['size']);
	$tmp=$_FILES['file']['tmp_name'];
	
	
	
	if(@getimagesize($tmp)){
	
		$arraytype=array('image/jpeg','image/jpg','image/gif','image/png');
		
		if(!empty($name)){
			if(in_array($type,$arraytype)){
				if($size<=(800*1024) and !empty($size)){
					$filename=mktime().$name;
					if(move_uploaded_file($tmp,'../uploads/pix/del/'.$filename)){
						$_SESSION['funame']=$filename;
						echo 101;
						}else{
							echo "<b><img src='../images/cancel.png' width='auto' height='13px'>System Error: Couldn't Complete File Submission</b>";
							}
					
					
					}else{
						echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;File too large, upload below 800kb</b>";
						}
			}else{
				echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;Unsupported File format, Suggest Using jpeg,jpg or gif file</b>";
				}
		}else{
			echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;No File Selected</b>";
			}
	}else{
		echo "<b><img src='../images/cancel.png' width='15px' height='15px'>&nbsp;Please Upload A Real Image File</b>";
		}
exit();	
?>