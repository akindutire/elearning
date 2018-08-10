<?php
	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
	
	$sbj=trim($_SESSION['stp']);
	$file='conn/update.txt';
	$var='';
	$cp=new user($file);
	$cp->validateus();
	
	
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
		@$sql10101010=mysqli_query($link,"SELECT id,pix,level_id FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$ps)."'");
		@list($uid,$pix,$slv_id)=mysqli_fetch_row($sql10101010);
		

		$sqltime=mysqli_query($link,"SELECT examstart FROM stud_exam_status WHERE stud_id='$uid' and sbj_id='$sbj'");
		list($start)=mysqli_fetch_row($sqltime);
		
		$sqltousetime=mysqli_query($link,"SELECT period FROM etest_durations WHERE sbj_id='$sbj'");
		list($expectedtime)=mysqli_fetch_row($sqltousetime);
		
		$date=date('H:i:s',mktime());
		
		$sql=mysqli_query($link,"SELECT sbj FROM subject WHERE id='$sbj'");
		list($xam)=mysqli_fetch_row($sql);
			
			sscanf($start,"%d:%d:%d",$hs,$ms,$ss);
			sscanf($date,"%d:%d:%d",$hc,$mc,$sc);
			
			$start=isset($ms)?$hs*3600+$ms*60+$ss:$hs*60+$ms;
			$now=isset($mc)?$hc*3600+$mc*60+$sc:$hc*60+$mc;
			
			$expectedtime=($expectedtime*60)+0;
			 
			$used=$now-$start;
			//echo $start.'<br>'.$used.'<br>'.$now.'<br>'.$expectedtime;	
				echo "
				<input type='hidden' value='$used' id='hiddentimeused'>
				<input type='hidden' value='$expectedtime' id='hiddentimetouse'>";
				


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/ggg.png">
<title>E Learning | Take Exam</title>

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/check.js"></script>
<script>
$(function(){
	$('#feedback2').ready(function(event){
				
				
			var used=$('#hiddentimeused').val(),
			 expected=$('#hiddentimetouse').val();			
				var timer=function(){
					
					used++;	
					var hour=parseInt(used/3600),
					minute=parseInt(used/60);
					
					var sec=parseInt((used)%60);
		
					if(minute>59){
						minute-=60;					
					}
					
					if(parseInt(used)>(expected/2) && parseInt(used)<(expected-60)){
						$('#feedback2').css({color:'rgba(69, 69, 255, 0.77)'});					
					}
					
					if((expected-used)<61){
						$('#feedback2').css({color:'red'});
					}
					
					if(parseInt(used)>parseInt(expected)){
						clearInterval(interval);
						window.location='finish.php';
					}
					
					$('#feedback2').html(hour+' : '+minute+' : '+sec);
						//timer();
						//console.log(used);
				}
			
		if(parseInt(used)<parseInt(expected)){	
			timer;
			var interval=setInterval(timer,1000);
		}else{
			console.log(used);
			}

	});
});	
</script>

</head>

<body>

<div id="container">
	
    <div id="header">
    	<div class="inheader">
        	<div id="left">
            
            	<img src=<?php echo L; ?> width=<?php echo W; ?> height=<?php echo H; ?> vspace="-2px" hspace="-2px">&nbsp;<span><?php  echo E; ?></span>
            
            </div>
            <div id="right">
            	<nav>
            		<ul>
                    	
                        
                        <li><a id="submitallqss">Submit Exam</a></li>
                        
                        
                    </ul>
            	</nav>
            
            </div>
            
          <div class="clr"></div> 
            
    	</div>
        
    </div>
       
       
       
       
	<div class="clr"></div>
    
    
    
<div class="mwrap">    
    <div class="middlebody">
    
    
    <div id="sidebar">
    	<h3>Menu</h3>
    	
        	 
    
    </div>
    
    
    <div id="mainbar">
    <h3><?php echo $xam; ?></h3>
    	
    
        
        <div class="clr"></div>
        

        <div class="clr"></div>
        
        <div id="tab_cont" style="background:white; position:relative;">
		

<div id="feedback2"></div>	
                      
                          
        <div class="clr"></div>
        
        <div id="feedback"></div>	
        
        
        <div class="clr"></div>
        
        
        
        <?php
        

		@$qval=(int)$_GET['qval'];
		$cp->qs($sbj);
		
		?>
        
        <div class="clr"></div>
        
        <p class="listids">
			<center>
        	<?php
        		$cp->getAnsweredQs($sbj);
			?>
        	</center>
        </p>
		
                    
        </div>
		

                
        <div class="clr"></div>
        
	


    </div>
    
	
   
    
    
 	</div>

<div class="clr"></div>
	</div>
<div class="clr"></div>

</div>   

<div id="footer"><p><?php echo F; ?></p></div>



</body>
</html>


<style>
@import "css/interim.css";
@import "css/forms.css";

#feedback2{
	float:right; clear:right; background:transparent; color:black; font-family:'Trebuchet MS'; font-size:35px; position:static; padding:1px; margin:3px 3px 2px 3px; height:45px; width:auto; text-align:center; border-radius:3px;
	}

#feedback{
	background:rgba(0, 0, 0, 0.82);
	color:white;
	font-family:"Trebuchet MS";
	font-size:18px; 
	padding:1px; 
	top:1%;
	left:78%; 
	height:auto; 
	width:150px; 
	text-align:center; 
	border-radius:3px; 
	float:right; 
	font-style:bold;
	display:none;
	position:absolute;
	}
p.listids{
	margin:25px;
	}
#mainbar li:hover{
	background:white;
	color:green;
	}

</style>
