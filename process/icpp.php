<?php
//E821465
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$old=sha1(stripslashes(strip_tags($_POST['oldpass'])));
		$new=stripslashes(strip_tags($_POST['newpass']));
		$cnew=stripslashes(strip_tags($_POST['cnewpass']));
		
		
			if(!empty($old) && !empty($new) && !empty($cnew)){	
						
						
						$cp->cpp($new,$cnew,$old);
						
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Some Field Missing</b>";	
					}
		
		
		}


?>