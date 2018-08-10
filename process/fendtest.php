<?php	
    
    include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);
	
	$sbj=$_SESSION['sbj'];
	
	$tm=mysqli_query($link,"SELECT * FROM tm_test WHERE sbj_id='$sbj'");
	$cur_list=mysqli_num_rows($tm);
	
	$sql=mysqli_query($link,"UPDATE etest_durations SET no_q='$cur_list' WHERE sbj_id='$sbj'");
		
		if($sql)
			header('location:../admin/etest.php');
		else
			echo "Failed , Please Retry, <a href='../admin/etest.php'>Go back</a>";
?>