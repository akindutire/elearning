<?php

	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new user($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		/*if($_POST['sbval']==0){
			
			$val=$_POST['srname'];
			$cp->vskl($val);
			
		}else if($_POST['sbval']==1){
			$val=$_POST['sdname'];
			$cp->vstud($val);
		}
		else if($_POST['sbval']==2){
			
			$cp->vtutor();
			
		}else if($_POST['sbval']==3){
		
			$cp->sbjs();
		
		}else if($_POST['sbval']==4){
			
			$val=$_POST['score'];
			$sbj_id=$_POST['sbjnw'];
			
			$cp->vstudtutview($val,$sbj_id);
		
		}else*/ if($_POST['sbval']==5){
			
			$val=$_POST['bkname'];
			
			$cp->ulib($val);
		
		}
		
				
	}
	
	exit();
?>