<?php	
    
    include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);
	
	$sbj=$_SESSION['sbj'];
	
	$stmt1=mysqli_prepare($link,"DELETE FROM tm_test WHERE sbj_id=?");
	mysqli_stmt_bind_param($stmt1,'i',$sbj);
	$sql1=mysqli_stmt_execute($stmt1);
	mysqli_stmt_close($stmt1);


	$stmt1=mysqli_prepare($link,"DELETE FROM etest WHERE sbj_id=?");
	mysqli_stmt_bind_param($stmt1,'i',$sbj);
	$sql2=mysqli_stmt_execute($stmt1);
	mysqli_stmt_close($stmt1);

	$sql3=mysqli_query($link,"DELETE FROM etest_durations WHERE sbj_id='$sbj'");
	$s_up_sbj=mysqli_query($link,"UPDATE subject SET etest='' WHERE id='$sbj'") or die('403 Forbidden');			

		
		if($sql1==true && $sql2==true && $sql3==true)
			header("location:../admin/ctest.php?sbj=$sbj");
		else
			echo "Unable To Delete, <a href='../admin/etest.php'>Go back</a> and Try Again";


?>