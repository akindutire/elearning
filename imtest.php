<?php


	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
	$file='conn/update.txt';
	$var='';
	$cp=new user($file);
	$cp->validateus();
	
	
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
		@$sql10101010=mysqli_query($link,"SELECT id,pix,level_id FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$ps)."'");
		@list($uid,$pix,$slv_id)=mysqli_fetch_row($sql10101010);
		
	//1='Has Took Exam'
	//0=Exam In Progress'
	//Empty=Has Not Attempted Exam 
 
	
	$sbj=$_SESSION['stp'];
		
	$sql_check_st=mysqli_query($link,"SELECT status,sbj_id FROM stud_exam_status WHERE stud_id='$uid' and sbj_id='$sbj'");
	list($status,$sbj_id)=mysqli_fetch_row($sql_check_st);
	
	if(mysqli_num_rows($sql_check_st)==0 && empty($status)){
	
		$idate=date('H:i:s',mktime());
		$sql_ins_st=mysqli_query($link,"INSERT INTO stud_exam_status(id,stud_id,sbj_id,status,report,examstart,lastmin,level) 				VALUES('NULL','$uid','$sbj','0','ExamInProgress','$idate','NULL','$slv_id')");
		
		$sql=mysqli_query($link,"SELECT * FROM etest WHERE sbj_id='$sbj'");
			
			$sql_ins=mysqli_prepare($link,"INSERT INTO exam_pro(id,stud_id,uid,question,options,answer,sbj_id,qimage,choosen_ans) VALUES(?,?,?,?,?,?,?,?,?)");
			while(list($id,$sid,$tuid,$question,$options,$answer,$sbj_id,$qimg)=mysqli_fetch_row($sql)){
				
				$e='';	
				mysqli_stmt_bind_param($sql_ins,'iiisssiss',$e,$uid,$tuid,$question,$options,$answer,$sbj,$qimg,$e);
				mysqli_stmt_execute($sql_ins);
			
			}
			mysqli_stmt_close($sql_ins);
			
			header('location:cbt.php');

	
	}else if(mysqli_num_rows($sql_check_st)==1 && $status==0 && $sbj!=$sbj_id){
		echo "<body onload='closewindow()'></body>";
		//header('location:imsbj.php');
		
	}else if(mysqli_num_rows($sql_check_st)==1 && $status==0 && $sbj==$sbj_id){
		
			header('location:cbt.php');
		
		}
//End inn
		
		


?>
<script>
function closewindow(){
	alert("You Are Currently On An Exam Try To Finish Exam");
	window.close();
	window.location='imsbj.php';
	}
</script>