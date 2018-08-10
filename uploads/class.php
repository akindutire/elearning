<?php

class process
{
	protected $file;
	function __construct($file){
		file_exists($file)?'':die('App Shutdown Unexpectedly, Please Contact App Provider');
		}

	function adlogin($mail,$pass){
		global $link;
		
		@(int)$_SESSION['trial'];	
		
		$left=5-$_SESSION['trial'];
		
		if($_SESSION['trial']<6){
			
			$sql=mysqli_query($link,"SELECT * FROM users WHERE email='$mail' and password='$pin'");
			
				if(mysqli_num_rows($sql)==1){
					echo 1;
				}else{
					$_SESSION['trial']+=1;
					echo "<b><img src='../images/cancel.png' width='30px' height='auto'>Email, Password Combination Incorrect. $left trials left</b>";
					}
			}else{
				echo "<b><img src='../images/cancel.png' width='30px' height='auto'>Trials Exhausted: Retry in 30 seconds time</b>";
				sleep(30);
				}
	}
	
	
	
	function getdesignation(){
		global $link;
		$sql2=mysql_query("SELECT * FROM bearingdesignation");
		while(list($id,$designation,$application,$group,$dynamic,$static)=mysql_fetch_row($sql2)){
			echo "
                    <option value='$designation|$group|$dynamic|$static'>$designation</option>";
              }
	}
		
		
	function getapplicationaccordingtomachine(){
		global $link;
		$sql3=mysql_query("SELECT * FROM rollerbearingdesignlife");
		while(list($id,$application,$liodesignlifefrom,$liodesignlifeto)=mysql_fetch_row($sql3)){
			echo "<option value='$application|$l10designlifefrom|$l10designlifeto'>$application</option>";
			}
		}
		
			
	
	
	function getdesignlife(){
		global $link;
		$sql4=mysql_query("SELECT * FROM bearinglifeselection");
		while(list($id,$selection)=mysql_fetch_row($sql4)){
			echo "<option value='$selection'>$selection</option>";
		}
	}
		
	
	
	function calc($bearingload,$mindiameter,$rotationspeed,$operatingperiod,$designlife,$design,$group,$dynamic,$static,$loadingtomachine,$outsidediameter,$width,$apploadingcondition){
		global $link;
		if($group=='ball bearing'){
			
				
				$ratinglifehrs=(16700/$rotationspeed)*(pow(($dynamic/$bearingload),3));
				$requiredcapacity=(int)(floor($bearingload*(pow(($ratinglifehrs*$operatingperiod),(1/3))))/zballbearing);
				
				
		}else if($group=='roller bearing'){
				
				$ratinglifehrs=(16700/$rotationspeed)*(pow(($dynamic/$bearingload),3.33));
				$requiredcapacity=(int)(floor($bearingload*(pow(($ratinglifehrs*$operatingperiod),(1/3.33))))/zrollerbearing);
					
			}
			
		$ratinglifehrs=(int)($ratinglifehrs);
		$ratinglifedays=(int)($ratinglifehrs/$operatingperiod);
		
		list($mapplication,$l10from,$l10to)=explode('|',$loadingtomachine);
		
		echo "<p class='h'><b>$mapplication</b>:  <small>$apploadingcondition using <b>$design</b> selection</small></p>
                <p class='head'><u>Following results was concluded by the program in accordance to the design life and bearing selection</u></p>
				
				<p>Bore is $mindiameter mm</p>
				<p>Outside Diameter is $outsidediameter mm</p>
				<p>Width is $width mm</p>
				<p>Dynamic load Capacity (C<sub>p</sub>) $dynamic N</p>
				<p>Static load Capacity (C<sub>o</sub>) $static N</p>
				<p>Actual Rating life in hrs $ratinglifehrs  hours</p>
				<p>Actual Rating life in days $ratinglifedays days</p>
				<p>Required Capacity $requiredcapacity N</p>
				<p>Design life: $designlife</p>
				<p><button onclick='window.print()'>Print</button>&nbsp;<button id='back'>Back</button>&nbsp;<button id='close'>Close</button></p>
				";
                		
		}


}

?>