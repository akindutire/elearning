<?php

	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		if($_POST['sbval']==0){
			
			$val=$_POST['srname'];
			$cp->vskl($val);
			
		}else if($_POST['sbval']==1){
			$val=$_POST['sdname'];
			$cp->vstud($val);
		}
		else if($_POST['sbval']==2){
			$val='';
			$cp->vtutor($val);
			
		}else if($_POST['sbval']==3){
		
			$cp->sbjs();
		
		}else if($_POST['sbval']==4){
			
			$val=$_POST['score'];
			$val2=$_POST['fyear'];
			
			$sbj_id=$_POST['sbjnw'];
			
			$cp->vstudtutview($val2,$val,$sbj_id);
		
		}else if($_POST['sbval']==5){
			
			$val=$_POST['bkname'];
			
			$cp->lib($val);
		
		}else if($_POST['sbval']==6){
			
			$val=$_POST['tutname'];
			
			$cp->vtutor($val);
		
		}
		
				
	}
	
	exit();
?>