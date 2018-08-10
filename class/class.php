<?php
//ADMINISTRATORS

class process
{
	protected $file;
	private $left;
	
	//Constructor
	public function __construct($file){
		file_exists($file)?'':die('App Shutdown Unexpectedly, Please Contact App Provider');
		file_exists(SKIT)?'':die('App Shutdown Unexpectedly, Contact App Provider');
		}
		
	//Input Validator		
	public function check($item){
		trim(stripslashes(strip_tags($item)));
		}
	
	//min. Updater	
	public function lastminupdater(){
		
		}

	public function loadlevels(){
		global $link;

		$sql = mysqli_query($link,"SELECT id,level FROM level");
		while (list($id,$lv)=mysqli_fetch_row($sql)) {
			echo "<option value='$id'>$lv</option>";
		}
	}	

	public function loadterms(){
		global $link;

		$sql = mysqli_query($link,"SELECT id,term FROM term");
		while (list($id,$term)=mysqli_fetch_row($sql)) {
			echo "<option value='$id'>$term</option>";
		}
	}

	//login Admin	
	public function adlogin($mail,$pass){
		global $link;
		
		@(int)$_SESSION['trial'] += 1;
		
		$this->left=5-($_SESSION['trial']);
			
			$sql=mysqli_query($link,"SELECT role,bk FROM users WHERE email='".mysqli_real_escape_string($link,$mail)."' and password='".mysqli_real_escape_string($link,$pass)."'");
			
				if(mysqli_num_rows($sql)==1 && $_SESSION['trial']<5){
					list($role,$bk)=mysqli_fetch_row($sql);
					
					if($bk==1){
						echo "<b><img src='../images/cancel.png' width='auto' height='13px'>&nbsp;You have been <span style='color:red;'>BLOCKED</span></b>";
						}else{
							$_SESSION['em']=$mail;
							$_SESSION['ps']=$pass;
							$_SESSION['role']=$role;
							unset($_SESSION['trial']);
							echo 101;
						}
				}else{
					
					if((int)$this->left<=-1){
						
						echo "<b><img src='../images/cancel.png' width='auto' height='13px'>&nbsp;Trials Exhausted: <a href='lgt.php'>Refresh</a></b>";
						
					}else{
						echo "<b><img src='../images/cancel.png' width='auto' height='13px'>&nbsp;Email, Password Combination Incorrect. $this->left trials left</b>";
					}
				}
	}
	
	//Ad Profile
	public function adprof($a,$b){
		global $link;
		
		$sql=mysqli_query($link,"SELECT id,role,name,pix,sex,school,cat FROM users WHERE email='$a' and password='$b'");
			if(mysqli_num_rows($sql)==1){
				list($id,$role,$name,$pix,$sex,$skl,$mdp)=mysqli_fetch_row($sql);
				
				ucfirst($role);
				ucwords($name);
				strtoupper($sex);
				ucfirst($mdp);
				
					
			echo "<div id='details'>
       		 
			 <p class='webdata'>
        		<span id='left' style='float:left;'>School</span>
        		<span id='right' style='float:right; color:green;'>$skl</span>
        	</p>

       		 <p class='webdata'>
        		<span id='left' style='float:left;'>Name</span>
        		<span id='right' style='float:right;'>$name</span>
        	</p>
       
        	<p class='webdata'>
        		<span id='left' style='float:left;'>Role</span>
        		<span id='right' style='float:right;'>$role</span>
       	 	</p>

        	<p class='webdata'>
        		<span id='left' style='float:left;'>Department</span>
        		<span id='right' style='float:right;'>$mdp</span>
       	 	</p>

       
        	<p class='webdata'>
        		<span id='left' style='float:left;'>Gender</span>
        		<span id='right' style='float:right;'>$sex</span>
       	 	</p>
       
        	</div>";
        
				if($pix=='favater.jpg' || $pix=='mavater.jpg'){
					echo "<div id='pix'>
							<img src='../uploads/pix/$pix' width='auto' height='160px'>
								<br>
							<span style='margin-left:98px;'>
								<a id='changepix' title='Change Picture'><img src='../images/edit.png' width='auto' height='10px'></a>
							</span>
						</div>";
					}else{
						
						echo "<div id='pix'>
									<img src='../uploads/pix/$pix' width='auto' height='160px'>
								</div>";
						
						}
		
	
				}else{
					echo "<center><p><b>No Profile</b></p><center>";
					}
	}
		
	//load menu
		public function loadmenu($a,$b){
		global $link;
		//<a href='tset.php'><li>Settings</li></a>;
		$sql=mysqli_query($link,"SELECT id,role,name,pix,sex FROM users WHERE email='$a' and password='$b'");
			if(mysqli_num_rows($sql)==1){
				list($id,$role,$name,$pix,$sex)=mysqli_fetch_row($sql);
				
				if($role=='Registrar'){
					echo "
					<a href='cpanel.php'><li>Home</li></a>
					<a href='askl.php'><li>Add School</li></a>
					<a href='vskl.php'><li>View School</li></a>
					";
				}else if($role=='Principal'){
					echo "
					<a href='cpanel.php'><li>Home</li></a>
					<a href='vstud.php'><li>My Students</li></a>
					<a href='vteach.php'><li>My Tutors</li></a>
					
					";
				}else if($role=='Tutor'){
					echo "
					<a href='cpanel.php'><li>Home</li></a>
					<a href='sbj.php'><li>Subject</li></a>
					<a href='alib.php'><li>Library</li></a>
					<a href='cpp.php'><li>Change Passkey</li></a>
					";
				}else if($role=='Student'){
					echo "
					<a href='cpanel.php'><li>Home</li></a>
					<a href='alib.php'><li>Library</li></a>
					<a href='imsbj.php'><li>My Subjects</li></a>
					<a href='searchterm.php'><li>Results</li></a>
					<a href='cpp.php'><li>Change Passkey</li></a>
					";
				}
			}
	}
	
	//Check Admin and Page Authentication
	public function validatead($a,$b,$c){
		
		global $link;
		
		trim($a);
		trim($b);
		trim($c);
		
		$sql_ch=mysqli_query($link,"SELECT * FROM users WHERE email='$a' and password='$b' and role='$c' and bk='0'");
			if(mysqli_num_rows($sql_ch)==0){
				header('location:lgt2.php');
				}	
		}
	
	//Vskl
	public function vskl($val){
		global $link;
		
		ucwords($val);
		
		if(empty($val)){
			$sql=mysqli_query($link,"SELECT * FROM school AS s ORDER BY id");
		}else{
			$sql=mysqli_query($link,"SELECT * FROM school WHERE name LIKE ('%$val%')");
			}
			
				
			echo "<tr>
                	
	                <th>Principal</th>
                    <th>School Name</th>
                    <th>Current term</th>
                    <th>Address</th>
                    <th>School Tel.</th>
                    <th>Contact Email</th>
					 
                </tr>";
				
		while(list($id,$sklname,$saddr,$stel,$prname,$prmail,$cur,$duration,$bk)=mysqli_fetch_row($sql)){
					
					$isaddr=strlen($saddr)<18?$saddr:substr($saddr,0,16).'...';
					$isklname=strlen($sklname)<18?$sklname:substr($sklname,0,16).'...';
					$iprname=strlen($prname)<18?$prname:substr($prname,0,16).'...';
					
					
					$color=$bk==1?'red':'black';
						echo "
					
						<tr style='color:$color'>
								
								<td>
								
								<input type='checkbox' class='' name='check[]' value='$id'>
								&nbsp;
								
								<a title='$prname'>$iprname</a>
								
								</td>
								
								<td><a title='$sklname'>$isklname</a></td>
								<td>$cur term</td>
								<td><a title='$saddr'>$isaddr</a></td>
								<td>$stel</td>
								<td>$prmail</td>
								
							</tr>";
			}
			
	}
	
	//lOCK UNLOCK tut.
	public function lockandunlocktut($bk,$id){
		global $link;
		
		mysqli_query($link,"UPDATE users SET bk='$bk' WHERE id='$id'");
					
		}

	//lOCK UNLOCK Prin.
	public function lockandunlock($bk,$id){
		global $link;

		$sql=mysqli_query($link,"UPDATE school SET bk='$bk' WHERE id='$id'");
		
		$sql_get_skl=mysqli_query($link,"SELECT name FROM school WHERE id='$id'");
		list($skname)=mysqli_fetch_row($sql_get_skl);
		
		mysqli_query($link,"UPDATE users SET bk='$bk' WHERE school='$skname'");
					
		}
	
	//Add School
	public function askl($name,$saddress,$spin,$prin,$prmail,$pfile,$sex,$stel){
		global $link;
		
		$q=mysqli_query($link,"SELECT * FROM school WHERE name='".mysqli_real_escape_string($link,$name)."' and email='".mysqli_real_escape_string($link,$prmail)."'");
		
		if(mysqli_num_rows($q)==0){	
			
			$x_sql=mysqli_prepare($link,"INSERT INTO school(id,name,address,stel,pr_name,pr_email,current_term,term_duration) VALUES(?,?,?,?,?,?,?,?)");
		
			//@bind param
			$days=90*24*60*60;
			$term='1st';
			$role='Principal';
			$empty='';
			$cat='General';
			$bk=0;
		
			mysqli_stmt_bind_param($x_sql,'issssssi',$empty,$name,$saddress,$stel,$prin,mysqli_real_escape_string($link,$prmail),$term,$days);
			
			$rsql=mysqli_stmt_execute($x_sql);
				
				if($rsql){
					
				//@Close last query
				mysqli_stmt_close($x_sql);
				
					$co_sql=mysqli_prepare($link,"INSERT INTO users(id,role,name,email,password,pix,admissionyear,school,level_id,score,sex,bk,cat) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
				
					//@bind param
					$bc_sql=mysqli_stmt_bind_param($co_sql,'isssssssiisss',$empty,$role,$prin,mysqli_real_escape_string($link,$prmail),mysqli_real_escape_string($link,$spin),$pfile,$empty,$name,$empty,$empty,$sex,$bk,$cat);
				
					if(mysqli_stmt_execute($co_sql)){
						
					}else{
						echo mysqli_error($link);
						}
					
					//@Close last query
					mysqli_stmt_close($co_sql);
					
					@rename('../uploads/pix/del/'.$pfile,'../uploads/pix/'.$pfile);
					unset($_SESSION['name']);
					echo "<b><img src='../images/accept.png' width='auto' height='13px'>Successfully Added An Instituttion</b>";
				
				}
		
		}else{
			echo "<b><img src='../images/cancel.png' width='auto' height='13px'>School/Mail Already Exist.</b>";
			}

	}
	
	//A Stud	
	public function astud($sdname,$sdtel,$gender,$adyr,$level_id,$dp){
	global $link;
	
			$sql_ck=mysqli_query($link,"SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$sdtel)."' and role='Student'");
			if(mysqli_num_rows($sql_ck)==0){
					
			$f_sql=mysqli_query($link,"SELECT school FROM users WHERE email='".mysqli_real_escape_string($link,$_SESSION['em'])."' and role='Principal'");
			list($school)=mysqli_fetch_row($f_sql);
			
			$l_sql=mysqli_query($link,"SELECT MAX(id) FROM users");
			list($lid)=mysqli_fetch_row($l_sql);
			
			$x_sql=mysqli_prepare($link,"INSERT INTO users(id,role,name,email,password,pix,admissionyear,school,level_id,score,sex,bk,cat) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		
			//@bind param
			$lid+=1;
			$regpass='EDP'.$lid;
			
			$encodedpass=base64_encode($regpass);
			
			$score=0;
			$e='';
			
			$dpix=$gender=='Male'?'mavater.jpg':'favater.jpg';
			
			$bki='0';
			$term='1st';
			$role='Student';
			$empty='';
			$regpass=trim(sha1($regpass));	
			mysqli_stmt_bind_param($x_sql,'issssssssisss',$e,$role,$sdname,$sdtel,$regpass,$dpix,$adyr,$school,$level_id,$score,$gender,$bki,$dp);
			
			mysqli_stmt_execute($x_sql);
			$xlid=mysqli_stmt_insert_id($x_sql);
				
			mysqli_stmt_close($x_sql);
					
				mysqli_query($link,"INSERT INTO rec(id,uid,sh,encoded) VALUES('NULL','$xlid','$regpass','$encodedpass')");
					
					echo "<b><img src='../images/accept.png' width='auto' height='13px'>Successfully Added A Student</b>";
				
		}else{
					echo "<b><img src='../images/accept.png' width='auto' height='13px'>Telephone ID Already Exist</b>";
			
			}
	}
	
	
	//Add Tutor
	public function atut($tutname,$tutmail,$tutgender,$dp){
			global $link;
		
		$v_sql=mysqli_query($link,"SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$tutmail)."'");
		
		if(mysqli_num_rows($v_sql)==0){
				
			
			$ft_sql=mysqli_query($link,"SELECT id,name FROM school WHERE pr_email='".mysqli_real_escape_string($link,$_SESSION['em'])."'");
			list($sk_id,$fschool)=mysqli_fetch_row($ft_sql);
			
			
			
			$lt_sql=mysqli_query($link,"SELECT MAX(id) FROM users");
			list($lid)=mysqli_fetch_row($lt_sql);
			
			
			$xt_sql=mysqli_prepare($link,"INSERT INTO users(id,role,name,email,password,pix,admissionyear,school,level_id,score,sex,bk,cat) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		
			//@bind param
			$lid+=1;
			$regpass='E'.mt_rand(1000,9999).$lid;
			$encodedpass=base64_encode($regpass);
			$score=0;
			$e='';
			
			$dpix=$tutgender=='Male'?'mavater.jpg':'favater.jpg';
			
			$bki='0';
			$term='First Term';
			$role='Tutor';
			$empty='';
			$regpass=sha1($regpass);
		
		
			mysqli_stmt_bind_param($xt_sql,'isssssssiisss',$e,$role,$tutname,$tutmail,$regpass,$dpix,$empty,$fschool,$empty,$score,$tutgender,$bki,$dp);
			
			mysqli_stmt_execute($xt_sql);
			
			$last_insert=mysqli_stmt_insert_id($xt_sql);	
			
			mysqli_stmt_close($xt_sql);
					

					mysqli_query($link,"INSERT INTO rec(id,uid,sh,encoded) VALUES('NULL','$last_insert','$regpass','$encodedpass')");

					$tut_sql=mysqli_query($link,"INSERT INTO tutor(id,uid,sk_id) VALUES('NULL','$last_insert','$sk_id')");
					
					if($tut_sql){
						unset($_SESSION['funame'],$_SESSION['valid']);
						echo "<b><img src='../images/accept.png' width='auto' height='13px'>Successfully Added A $role</b>";
					
					}else{
						
						echo "<b>Try Again, System Error</b>";
					
						}
					
			}else{
				echo "<b>Error! Email Already Used</b>";
				}

		}

	//Vstud
	public function vstud($val){
		global $link;
		
		ucwords($val);
		$mail=$_SESSION['em'];
		
		$sql_skl=mysqli_query($link,"SELECT school,cat FROM users WHERE email='$mail'");
		list($sklname,$mdp)=mysqli_fetch_row($sql_skl);
		
			if($mdp=='General'){
				if(empty($val)){
					$sql=mysqli_query($link,"SELECT * FROM users WHERE role='Student' and school='$sklname' ORDER BY id");
				}else{
					$sql=mysqli_query($link,"SELECT * FROM users WHERE email LIKE ('%$val%') AND role='Student' and school='$sklname'");
				}
		 	}else{
				if(empty($val)){
					$sql=mysqli_query($link,"SELECT * FROM users WHERE role='Student' and school='$sklname' and cat='$mdp' ORDER BY id");
				}else{
					$sql=mysqli_query($link,"SELECT * FROM users WHERE name LIKE ('%$val%') AND role='Student' and school='$sklname' and cat='$mdp'");
			}
			 
		}
				
			echo "<tr>
                	
	                <th>Name</th>
                    <th>Sex</th>
					<th>Level</th>
                    <th>Department</th>
					<th>Adminssion Year.</th>
                    <th>Reg. No.</th>
					<th>Switch Category</th>
					<th>Result</th>
                </tr>";
				
		while(list($idr,$role,$name,$email,$reg,$pix,$adminyr,$school,$level_id,$score,$sex,$bk,$dp)=mysqli_fetch_row($sql)){
					
				list($rl,$sl)=explode("/", $level_id);
				$lv_sql=mysqli_query($link,"SELECT level FROM level WHERE id='$rl'");
				list($rl)=mysqli_fetch_row($lv_sql);
					
				$sql_get_regkey=mysqli_query($link,"SELECT encoded FROM rec WHERE uid='$idr'");
				list($ec)=mysqli_fetch_row($sql_get_regkey);
				
					$iname=strlen($name)<18?$name:substr($name,0,16).'...';
					$ec=base64_decode($ec);
						echo "
					
						<tr style='color:black'>
								
								<td>
								<input type='checkbox' name='sdkey[]' value='$idr'>&nbsp;&nbsp;			
								<a title='$name'>$iname</a>
								
								</td>
								
								<td>$sex</td>
								<td>$rl</td>
								<td>$dp</td>
								<td>$adminyr</td>
								<td>$ec</td>
								<td><a href='switch.php?stud=$idr' target='_new'>Switch</a></td>
								<td><a href='sresult.php?stud=$idr' target='_new'>Check Result</a></td>
								
							</tr>";
					
			}
			
	}	
	
	//Vtutor
	public function vtutor($val){
		global $link;
		
		ucwords($val);
		
		$mail=$_SESSION['em'];
		
		$sql_skl=mysqli_query($link,"SELECT school FROM users WHERE role='Principal' and email='$mail'");
		list($sklname)=mysqli_fetch_row($sql_skl);
		
		
		
		if(empty($val)){
			$sql=mysqli_query($link,"SELECT * FROM users WHERE role='Tutor' and school='$sklname' ORDER BY id");
		}else{
			$sql=mysqli_query($link,"SELECT * FROM users WHERE email LIKE ('%$val%') AND role='Tutor'");
			}
			
				
			echo "<tr>
                	
	                <th>Name</th>
                    <th>Sex</th>
                    <th>Created</th>
                    <th>Department</th>
                    <th>Library</th>
					<th>Reg ID</th>
					
                </tr>";
				
		while(list($idr,$role,$name,$email,$reg,$pix,$adminyr,$school,$level_id,$score,$sex,$bk,$dp)=mysqli_fetch_row($sql)){
					
				
					$sql_incr=mysqli_query($link,"SELECT * FROM subject WHERE uid='$idr'");
					(int)$created=mysqli_num_rows($sql_incr);

					$sql_infor=mysqli_query($link,"SELECT * FROM library WHERE uid='$idr'");
					(int)$collection=mysqli_num_rows($sql_infor);

					$sql_get_regkey=mysqli_query($link,"SELECT encoded FROM rec WHERE uid='$idr'");
					list($ec)=mysqli_fetch_row($sql_get_regkey);


					
					$iname=strlen($name)<18?$name:substr($name,0,16).'...';
					$ec=base64_decode($ec);
					
					$color=$bk==0?'black':'red';
						echo "
					
						<tr style='color:$color'>
								
								<td>
								<input type='checkbox' name='tutkey[]' value='$idr'>&nbsp;&nbsp;			
								<a title='$name'>$iname</a>
								
								</td>
								
								<td>$sex</td>
								<td>$created Subject</td>
								<td>$dp</td>
								<td>Has $collection Collection(s)</td>
								<td>$ec</td>
								
							</tr>";
			
			}
			
	}	
	
		
	//Delete User
	public function deleteuser($bk,$userid){
		global $link;

				$sql_sel=mysqli_query($link,"SELECT pix FROM users WHERE id='$userid'");
				list($pix)=mysqli_fetch_row($sql_sel);
				rename("upload/pix/$pix","upload/pix/del/$pix");
								
				$sql_del=mysqli_query($link,"DELETE FROM users WHERE id='$userid'") or die('System Error:Retry');
					
	}
	
	//V. Subjects
	public function sbjs(){
		global $link;
		
		$mail=$_SESSION['em'];
		
		$sql_get_admin_id=mysqli_query($link,"SELECT id FROM users WHERE email='$mail'");
		list($uid)=mysqli_fetch_row($sql_get_admin_id);
		
		$sql_get_sbj=mysqli_query($link,"SELECT * FROM subject WHERE uid='$uid'");
		
		//<th>Term</th><td>$sl</td>;
		
			echo "<tr>
                	
	                <th>Subject</th>
                    <th>Level</th>
					
                    <th>For</th>
                    <th>Cur. Students</th>
					<th>Handout</th>
					<th>E-test</th>
					<th>Records</th>
					
                </tr>";
				
		while(list($id,$sbj,$level,$recom,$material,$uid,$cat,$etest,$pri)=mysqli_fetch_row($sql_get_sbj)){
					
				$sql_part=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE sbj_id='$id'");
				$participant=mysqli_num_rows($sql_part);
				$idr=urlencode($id);


//saved
				if($etest=='saved'){
					$etest="<a href='ctest.php?sbj=$idr' tabindex='3' target='_new' title='View'><img src='../images/list.png' height='15px' width='auto'></a>
		
				&nbsp;|&nbsp;
				
				<a href='../process/dteststudbox.php?sbj=$idr' tabindex='3' title='Remove From Student Box'><img src='../images/remv.png' height='15px' width='auto'></a>";
				
				
				}else if($etest=='unsaved'){
//Unsaved		
			
					$etest="<a href='ctest.php?sbj=$idr' tabindex='3' target='_new' title='View'><img src='../images/list.png' height='15px' width='auto'></a>
				";
				
					
				}else{
//Empty
					$etest="<a href='ctest.php?sbj=$idr' tabindex='2' target='_new' title='Create A E-test'><img src='../images/edit.png' height='15px' width='auto'></a>";	
					}
				
				$material=empty($material)?"No":"Yes";
				
				$sql_level=mysqli_query($link,"SELECT * FROM level WHERE id='$level'");
				list($idl,$rl,$sl)=mysqli_fetch_row($sql_level);
					
					$isbj=strlen($sbj)<18?$sbj:substr($sbj,0,16).'...';
					$color=$pri==1?'rgba(61, 61, 255, 0.88)':'black';
						echo "
					
						<tr style='color:$color'>
								
								<td>
								<input type='radio' name='sbjkey[]' value='$id'>&nbsp;&nbsp;
								<a title='$sbj'>$isbj</a>
								
								</td>
								
								<td>$rl</td>
								
								<td>$cat</td>
								<td>$participant Students</td>
								<td>$material</td>
								<td><center>$etest</center></td>
								<td><center><a href='scoresheet.php?sbj=$id' target='_new' title='View Scoresheet'><img src='../images/datalist.png' width='20px' height='auto'></a></center></td>
						
						</tr>";
			}
		}
	
	//D. Subjects
	public function deletesbj($sbj){
		global $link;
								
				$sql_del=mysqli_query($link,"DELETE FROM subject WHERE id='$sbj'") or die('System Error:Retry');
				$sql_del_test=mysqli_query($link,"DELETE FROM etest WHERE sbj_id='$sbj'") or die('System Error:Retry');
				$sql_del_profile_stud=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE sbj='$sbj'") or die('System Error:Retry');
				$sql_del_test_duration=mysqli_query($link,"DELETE FROM etest_durations WHERE sbj_id='$sbj'") or die('System Error:Retry');
				$sql_exam=mysqli_query($link,"DELETE FROM exam_pro WHERE sbj_id='$sbj'");
				$sql_sel=mysqli_query($link,"SELECT material FROM subject WHERE id='$sbj'");
				list($mat)=mysqli_fetch_row($sql_sel);
				rename("upload/library/$mat","upload/pix/del/$mat");
					
	
	}
		
		
	//V. Student: Tutors View
	public function vstudtutview($val2,$val,$sbj){
		global $link;
		
		ucwords($val);
		$mail=$_SESSION['em'];
		
			(int)$val;		
			
				if(empty($val) && empty($val2)){
					$sql=mysqli_query($link,"SELECT * FROM sc WHERE sbj_id='$sbj' ORDER BY stud_id") or die(mysqli_error($link));
				}else if(!empty($val) && !empty($val2)){
					$sql=mysqli_query($link,"SELECT * FROM sc WHERE sbj_id='$sbj' and score>'$val' and (date='$val2') ORDER BY stud_id") or die(mysqli_error($link));
				}else if(!empty($val2)){
					$sql=mysqli_query($link,"SELECT * FROM sc WHERE sbj_id='$sbj' and (date='$val2') ORDER BY stud_id") or die(mysqli_error($link));
					}else if(!empty($val)){
					$sql=mysqli_query($link,"SELECT * FROM sc WHERE sbj_id='$sbj' and score>'$val' ORDER BY stud_id") or die(mysqli_error($link));
				}
			 
		
				
			echo "<tr>
                	
	                <th>Name</th>
                    <th>Sex</th> 
                    <th>Department</th>
					<th>Score</th>
                   <th>Year</th>
					
                </tr>";
				
		while(list($idr,$db_stud_id,$db_level,$db_sbj_id,$dbscore,$ipri,$icat,$ietest,$y)=mysqli_fetch_row($sql)){
					
				$sql_get_stud_data=mysqli_query($link,"SELECT name,cat,sex FROM users WHERE id='$db_stud_id'") or die(mysqli_error());
				list($name,$cat,$sex)=mysqli_fetch_row($sql_get_stud_data);
					
				/*$sql_get_regkey=mysqli_query($link,"SELECT encoded FROM rec WHERE uid='$idr'");
				list($ec)=mysqli_fetch_row($sql_get_regkey);
				*/
					$iname=strlen($name)<18?$name:substr($name,0,16).'...';
					
					if($dbscore>49){
						echo "
					
						<tr>
								
								<td>
								<a title='$name'>$iname</a>
								
								</td>
								
								<td>$sex</td>
								<td>$cat</td>
								<td><b style='color:black;'>$dbscore</b></td>
								<td><b>$y</b></td>
								
							</tr>";
					}else{
						
						echo "
					
						<tr>
								
								<td>
								<a title='$name'>$iname</a>
								
								</td>
								
								<td>$sex</td>
								<td>$cat</td>
								<td><b style='color:red;'>$dbscore</b></td>
								<td><b>$y</b></td>
								
							</tr>";

						
						}
					
			}
			
	}		


	
//CBT SECTION----------------------------------------------------------------------------------------------------
	
	//Create Subject
	public function csbj($sbj,$level_id,$ovw,$hfile,$pri){
		global $link;
		
		
		$mail=$_SESSION['em'];

			list($alevel,$aterm) = explode("/", $level_id);

			$chk_a=mysqli_query($link,"SELECT * FROM subject WHERE sbj='".mysqli_real_escape_string($link,$sbj)."' and level='$alevel'");
			$chk_q=mysqli_query($link,"SELECT name,id,cat FROM users WHERE email='".mysqli_real_escape_string($link,$mail)."'");
			list($uname,$uid,$mdp)=mysqli_fetch_row($chk_q);
			
			
		if(mysqli_num_rows($chk_a)==0){	
		
			
			$x_sql=mysqli_prepare($link,"INSERT INTO subject(id,sbj,level,overview,material,uid,cat,etest,pri) VALUES(?,?,?,?,?,?,?,?,?)");
		
			//@bind param
			$empty='';
			
		
			mysqli_stmt_bind_param($x_sql,'isississi',$empty,$sbj,$alevel,$ovw,$hfile,$uid,$mdp,$empty,$pri);
			
			$rsql=mysqli_stmt_execute($x_sql);
				$sbj_id=mysqli_stmt_insert_id($x_sql);
				if($rsql){
					
				//@Close last query
				mysqli_stmt_close($x_sql);
				
				
						@rename('../uploads/library/del/'.$hfile,'../uploads/library/'.$hfile);
						echo "<b><img src='../images/accept.png' width='auto' height='13px'>Successfully Added $sbj</b>";
				
				}
		
		}else{
			echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Subject Already Exist: Suggest Using Another Name.</b>";
			}			
		}	
	

	//Get Local Store Content
	public function getAllStoreContent(){
		
		global $link;

		$path="../uploads/qimg";
		$dh=opendir($path);
		while (false != ($filename=readdir($dh))) {
				
				$files[] = $filename;
			}	

		$images=preg_grep("/\.(jpg|jpeg|png|gif)(?:[\?\#].*)?\$/i", $files);

		echo "<ul style='margin:5%; margin-top:1%; padding:1.5%; width:98%; list-style:none;'>";
		foreach ( $images as $img ) {
			
			echo "<li style='margin:1%; padding:auto; display:inline;'>
						<a href='$path/$img'><img src='$path/$img' height='100px' width='auto'>&nbsp;&nbsp;</a>
					</li>";
					//echo $img;
		}

		echo "</ul>";

	}

	//Create Question Form
	public function getQuestionForm($sbj_id_for_etest){
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM etest_durations WHERE sbj_id='".mysqli_real_escape_string($link,$sbj_id_for_etest)."'");
		list($id,$sbj_id_for_db,$db_time,$db_noq,$nop)=mysqli_fetch_row($sql);
		
		
		$sql_ck_qu_list=mysqli_query($link,"SELECT * FROM tm_test WHERE sbj_id='$sbj_id_for_db'");
		$noq=mysqli_num_rows($sql_ck_qu_list);
		
		
		
		if($db_noq>$noq){
			
			echo "
			
			 <div id='feedback'>Don't use this character(|) in any option field</div>
        
			<br>
			";		
			echo "
				<form action='' method='post' id='form' enctype='multipart/form-data' style='margin-left:2px; width:98%;'>
            		
            		<div style='border:1px solid rgba(0, 193, 188, 0.77);'>
					<label style='font-family:bel; font-size:15px; color:indigo;'>Question</label><br><textarea class='ckeditor' name='iquestion' id='iquestion'></textarea>

	              	<script type='text/javascript'>
	          
	          			CKEDITOR.replace('iquestion');

			  	  	</script>
			  	  	</div>
					
					<hr>
			  	  	<br>
			  	  	<center style='font-family:bel; font-size:16px;'>Options</center>

			";

			echo "<div style='height:20px; clear:both;'></div>";
            for($i=1;$i<$nop+1;$i++){
					echo "
					
					<label style='font-family:bel; font-size:15px; color:indigo;'>$i</label><br><textarea class='ckeditor' name='option$i' id='option$i'></textarea>
	              	
	              	<script type='text/javascript'>
	          
	          			CKEDITOR.replace('option$i');

			  	  	</script><br><br>
			
					";
				}
             
			$max_option = $nop++;

           	echo "<div class='all'>
           	<input type='hidden' data-maxoption='$max_option' id='maxoption' name='maxoption'>
			<label></label><button type='submit' id='sktest'>Continue</button></div>";
             
			echo " </form>";

			}else{
					echo "
					<p style='text-align:center; font-family:trebuchet MS; font-size:15px; color:green;'>
					
						You Have Successfully Completed Your Test Setup.<br>
						
					</p>
					";
					
					$sql_ck_io=mysqli_query($link,"SELECT etest FROM subject WHERE id='$sbj_id_for_etest'");
					list($p)=mysqli_fetch_row($sql_ck_io);
					if($p=='unsaved'){
						echo "
							<p style='text-align:center; font-family:trebuchet MS; font-size:15px; color:green;'>
								<button title='Release Question For Exam On Student Use' id='savetest'>Save To Student Box</button>
							</p>
							";
					}else{
						echo "";
						}
								
				}
				
		}
		
	//Get Recently Set Question For A subject
	public function getRecentQuestions($sbj_id){
		global $link;
		
		$sql_ck_q_no=mysqli_query($link,"SELECT no_q,period FROM etest_durations WHERE sbj_id='$sbj_id'");
		list($proposed,$time)=mysqli_fetch_row($sql_ck_q_no);
		
		$sql=mysqli_query($link,"SELECT id,question,answer FROM tm_test WHERE sbj_id='$sbj_id'");
		$no_of_q_set=mysqli_num_rows($sql);
		
		 echo "<p class='reviews' style='color:white; font-family:Trebuchet MS;'>Questions ($no_of_q_set/$proposed)&nbsp;><b>$time min</b></p>";
		
		if(mysqli_num_rows($sql)==0){
			echo  "
				<p class='list' style='text-align:center;'><img src='../images/gld.gif' width='25px' height='auto'>&nbsp;Waiting For an input</p>
			";
			
			}else{
				
				$ck_test=mysqli_query($link,"SELECT etest FROM subject WHERE id='$sbj_id'");
				list($test)=mysqli_fetch_row($ck_test);
				
				while(list($id,$question,$ans)=mysqli_fetch_row($sql)){
					
					$array_search = array('<p>','</p>','<br />');
					$array_replace = array(' ',' ','&nbsp;');

					$question = str_replace($array_search, $array_replace, $question);
					$question=strlen($question)<32?$question:substr($question,0,28).'...';

					$bgcolor=$ans==null?'red':'transparent'; $title=$ans==null?'Answer Not Set, Delete and Reset':null;

					if($test=='unsaved'){
					echo "
						<p class='list' style='border-bottom:1px solid grey;'>
				
						<a id='delquestion' data-id='$id' style='cursor:pointer;'><img src='../images/cancel.png' height='10px' width='auto' title='Delete Question'></a>&nbsp;
				
						<span style='white-space:nowrap; background:$bgcolor;'><a href='viewqs.php?qs=$id' title='$title' target='_blank' style='color:rgb(0, 65, 65); cursor:pointer'>$question</a></span>
						
						</p>";
					}else{
						
						echo "
						<p class='list' style='border-bottom:1px solid grey; font-family:Browallia New; font-size:18px;'>
				
						&nbsp;
				
						<span><a href='viewqs.php?qs=$id' target='_blank' style='color:rgb(0, 65, 65); cursor:pointer'>$question</a></span>
						
						</p>

						";
						
						}


				}//loop
				
						echo "
						<p class='list' style='border-bottom:0px solid grey; text-align:right; font-family:Browallia New; font-size:23px;'>
				
						<a href='viewallqs.php' title='View All Question'><img src='../images/book.png' height='25px' width='auto'></a>
						
						</p>";
				
				
		}//end condition
	}
	
	
	//Transport Question
	public function setq($qimage,$question,$option){
	
		global $link;
		$sbj_id=$_SESSION['sbj'];
		
		
		$mail=$_SESSION['em'];
		$sqln=mysqli_query($link,"SELECT id FROM users WHERE email='$mail'");
		list($uid)=mysqli_fetch_row($sqln);
		
		
		$sql_question=mysqli_query($link,"SELECT no_q FROM etest_durations WHERE sbj_id='$sbj_id'");
		list($idb_qu)=mysqli_fetch_row($sql_question);
			
			$isql_get_row=mysqli_query($link,"SELECT * FROM tm_test WHERE sbj_id='$sbj_id'");
			list($iqrow)=mysqli_num_rows($isql_get_row);
			
				if($idb_qu>=$iqrow){
		
					$sql=mysqli_prepare($link,"INSERT INTO tm_test(id,sid,uid,question,options,answer,sbj_id,qimage) VALUES(?,?,?,?,?,?,?,?)");
		$e='';
		
		
				mysqli_stmt_bind_param($sql,'iiisssis',$e,$e,$uid,$question,$option,$e,$sbj_id,$qimage);
		
					if(mysqli_stmt_execute($sql)){
					
					unset($_SESSION['quname'],$_SESSION['valid']);
		

					echo 101;
				
					}else{
						die('403 Forbidden');
					}
			
			
				$qlid=mysqli_stmt_insert_id($sql);
				mysqli_stmt_close($sql);
		
				@rename("../uploads/qimg/del/$qimage","../uploads/qimg/$qimage");
		
				$_SESSION['lastid']=$qlid;
				session_write_close();	
		
					
				}else{
						echo "<p style='font-family:; font-size:14px;'>Sorry, You Have Successfully Completed Your Test Setup, Click On Save For Student Usage</p>";
					}
		}

	//Update Answers	
	public function updateans($ans){
		global $link;
		$lsbj=$_SESSION['lastid'];
		

		$sql=mysqli_query($link,"UPDATE tm_test SET answer='$ans' WHERE id='$lsbj'") or die('403 Forbidden');
		if($sql){
			echo 101;
			}
	}


	//Loader Sectional Question	
	public function getq(){
		global $link;
		$lsbj=$_SESSION['lastid'];
		
		$sql=mysqli_query($link,"SELECT * FROM tm_test WHERE id='$lsbj'");
		list($id,$x1,$x2,$q,$op,$ans,$x3,$qimg)=mysqli_fetch_row($sql);

			$qimg=empty($qimg)?"":"<img src='../uploads/qimg/$qimg' width='auto' height='120px'>";
			
			$array_search = array('<br />');
			$array_replace = array(' ',' ','&nbsp;');

				$q = str_replace($array_search, $array_replace, $q);
				

			echo "
					
				 <p class='letters'>$q</p>
            
            <form method='post' id='getanswers' style='margin-top:15px;'>
            	
                
			";
			
			$opt=explode('|',$op);
			
			foreach($opt as $opkey => $option){
				
				$array_search = array('<p>','</p>','<br />');
				$array_replace = array('&nbsp;','.',',');

				$option = str_replace($array_search, $array_replace, $option);
				
				echo "<div class='all'><input type='radio' id='answer' name='answer' value='$opkey'><span>$option</span></div>";
				}
				
           	echo "<div class='all'><label></label><button type='submit' id='skans'>Save and Continue</button></div>
            </form>";
		}
	
	//Save Questions
	public function saveq($sbj_id){
		global $link;
		
				$sql_move=mysqli_query($link,"SELECT * FROM tm_test WHERE sbj_id='$sbj_id'");
				
				$pre_ins=mysqli_prepare($link,"INSERT INTO etest(id,sid,uid,question,options,answer,sbj_id,qimage) VALUES(?,?,?,?,?,?,?,?)");
				
				while(list($id,$x1,$uid,$question,$options,$ans,$sbj,$qimgz)=mysqli_fetch_row($sql_move)){
					$e='';
					mysqli_stmt_bind_param($pre_ins,'iiissiis',$e,$x1,$uid,$question,$options,$ans,$sbj,$qimgz);
					mysqli_stmt_execute($pre_ins);	
				}
				mysqli_stmt_close($pre_ins);
				
				mysqli_query($link,"UPDATE subject SET etest='saved' WHERE id='$sbj_id'") or die('403 Forbidden');
				
				echo 101;
		}
		
	//View All Question
	public function allqs(){
		global $link;
		
		$sbj_id=$_SESSION['sbj'];
		
		
		$sqln=mysqli_query($link,"SELECT * FROM tm_test WHERE sbj_id='$sbj_id'");
		if(mysqli_num_rows($sqln)>0){
		$i=0;
		while(list($id,$x1,$uid,$q,$op,$ans,$sbjd,$qimg)=mysqli_fetch_row($sqln)){
		$i++;
		
		
		$qimg=empty($qimg)?"":"<img src='../uploads/qimg/$qimg' width='auto' height='120px'>";
			
			$array_search = array('<br />');
			$array_replace = array('<p>','</p>','&nbsp;');

			$q = str_replace($array_search, $array_replace, $q);

			echo "<p class='letters' style='font-family:Times New Roman; margin-bottom:3px;'> $i)&nbsp; $q</p>
            
            <form method='post' id='getanswers' style='margin-top:15px; margin-bottom:5px;'>
            	
                
			";
			
			$opt=explode('|',$op);
			
			foreach($opt as $opkey => $option){
				
				$array_search = array('<p>','</p>','<br />');
				$array_replace = array('&nbsp;','.',',');


				$option = str_replace($array_search, $array_replace, $option);
				
				if($opkey == $ans){

					echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option' checked disabled><span style='font-family:Times New Roman; margin-bottom:3px; margin-top:3px;'>$option</span></div>";	
				
				}else{
				
					echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option' disabled><span style='font-family:Times New Roman; margin-bottom:3px;  margin-top:3px;'>$option</span></div>";	
				
				}
			}
				
           	echo "</form><br>
			
			
			";
			
			}//loop
			}else{
				echo "<p class='letters' style='text-align:center;'>NO QUESTION</p>";
				}
			
		}
	
//END CBT SECTION---------------------------------------------------------------------------------------------------------
	
	
//PROFILE-------------------------------------------------------------------------------------------------------
	//Update Photo
	public function hfp($ipfile){
		global $link;
				$mail=$_SESSION['em'];
				$get_id=mysqli_query($link,"SELECT id,pix FROM users WHERE email='$mail'");
				list($uid,$pix)=mysqli_fetch_row($get_id);
				
						$sql=mysqli_query($link,"UPDATE users SET pix='$ipfile' WHERE id='$uid'");
						
						@rename("../uploads/pix/del/$ipfile","../uploads/pix/$ipfile");
						echo 101;
						
	}


	//Update Password
	public function cpp($new,$cnew,$old){
		global $link;
		
		if($_SESSION['ps']==$old){
				$mail=$_SESSION['em'];
				$get_id=mysqli_query($link,"SELECT id,pix FROM users WHERE email='$mail'");
				list($uid,$pix)=mysqli_fetch_row($get_id);
				
				if($cnew==$new){
					$new=sha1($new);
					$cnew=base64_encode($cnew);
						$sql=mysqli_query($link,"UPDATE users SET password='".mysqli_real_escape_string($link,$new)."' WHERE id='$uid'");
						$sql_c=mysqli_query($link,"UPDATE rec SET sh='".mysqli_real_escape_string($link,$new)."',encoded='$cnew' WHERE uid='$uid'");	
						
						header("location:../admin/lgt2.php");
						
					}else{
						echo "Please Confirm New Passkey";
						}
			}else{
				echo "Please Enter A Correct Old Passkey";
				}
	}

//END PROFILE UPDATE-----------------------------------------------------------------------------------------------------

//Conditional Ranking
	protected function condrank($agg,$reallevel){
		
		if($reallevel>9){
			$grades=array(1=> 'A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9');
		}else{
			$grades=array(1=> 'A', 'B', 'C', 'D', 'E', 'F');	
		}
		
		
		if($agg>=0 && $agg<=39 && $reallevel>=9){
					$sgrade=$grades[9];
				}else if($agg>=40 && $agg<45 && $reallevel>9){
					$sgrade=$grades[8];
				}else if($agg>=45 && $agg<50 && $reallevel>9){
					$sgrade=$grades[7];
				}else if($agg>=50 && $agg<55 && $reallevel>9){
					$sgrade=$grades[6];
				}else if($agg>=55 && $agg<60 && $reallevel>9){
					$sgrade=$grades[5];
				}else if($agg>=60 && $agg<65 && $reallevel>9){
					$sgrade=$grades[4];
				}else if($agg>=65 && $agg<70 && $reallevel>9){
					$sgrade=$grades[3];
				}else if($agg>=70 && $agg<75 && $reallevel>9){
					$sgrade=$grades[2];
				}else if($agg>=75 && $agg<=100 && $reallevel>9){
					$sgrade=$grades[1];
				}else if($agg>=0 && $agg<=39 && $reallevel<=9){
					$sgrade=$grades[6];
				}else if($agg>=40 && $agg<45 && $reallevel<=9){
					$sgrade=$grades[5];
				}else if($agg>=45 && $agg<50 && $reallevel<=9){
					$sgrade=$grades[4];
				}else if($agg>=50 && $agg<60 && $reallevel<=9){
					$sgrade=$grades[3];
				}else if($agg>=60 && $agg<75 && $reallevel<=9){
					$sgrade=$grades[2];
				}else if($agg>=75 && $agg<=100 && $reallevel<9){
					$sgrade=$grades[1];
				}
		return $sgrade;
		}

	//Stud Result
	public function curterm($val,$level,$term){
		global $link;
		intval($val);
		
		$sql_rt=mysqli_query($link,"SELECT name,level_id FROM users WHERE id='$val'");
		list($name,$reallevel)=mysqli_fetch_row($sql_rt);
		
		$sql_ilev=mysqli_query($link,"SELECT * FROM level WHERE level='$level' and slevel='$term'");
		list($ilid,$irl,$isl)=mysqli_fetch_row($sql_ilev);


		$sql=mysqli_query($link,"SELECT sbj_id,score,etest,level FROM stud_repository WHERE stud_id='$val' and level='$ilid' ORDER BY level");
		
		
			echo "<tr>
	                <th>Subject</th>
                    <th>Level</th>
					<th>Term</th>
					<th>Exam Score</th>
                    <th>Grade</th>
					<th>Tutor</th>
                </tr>";
			
		
		
		while(list($sbj,$score,$et,$li)=mysqli_fetch_row($sql)){
			
			$sql_sb=mysqli_query($link,"SELECT sbj,uid FROM subject WHERE id='$sbj'");
			list($sbjname,$tut)=mysqli_fetch_row($sql_sb);
			
			$sql_t=mysqli_query($link,"SELECT name FROM users WHERE id='$tut'");
			list($tutor)=mysqli_fetch_row($sql_t);
			
			$sql_lev=mysqli_query($link,"SELECT * FROM level WHERE id='$li'");
			list($lid,$rl,$sl)=mysqli_fetch_row($sql_lev);
			
			//Conditional Ranking
				$sgrade=$this->condrank($score,$lid);
			//End Ranking
			
			
			$color=$score<=39?'red':'black';
			$score=empty($et)?'ABS':$score;
			$sgrade=empty($et)?'ABS':$sgrade;
			
			if($reallevel==$li){
				$rl="<b>$rl</b>";
				$sl="<b>$sl</b>";
				}
			
					echo "
			
						<tr >
								<td>
								<a>$sbjname</a>
								
								</td>
								<td><center>$rl</center></td>
								<td><center>$sl</center></td>
								<td style='color:$color'><center>$score</center></td>
								<td style='color:$color'><center>$sgrade</center></td>
								<td>$tutor</td>
							</tr>";
			
			}
		$lsc=0;$no_row=0;	
		if($isl=='Third term'){
				$i=$ilid-2;
				while($i<=$reallevel){
					
					$rsql=mysqli_query($link,"SELECT score FROM stud_repository WHERE stud_id='$val' AND level='$i' AND (etest='saved' OR etest='unsaved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
					}
					
					$no_row+=mysqli_num_rows($rsql);
				
					$i++;
					}
				
			}else if($isl=='Second term'){
				$i=$ilid-1;
				while($i<=$reallevel){
					
					$rsql=mysqli_query($link,"SELECT score FROM stud_repository WHERE stud_id='$val' AND level='$i' and (etest='saved' OR etest='unsaved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
						}
					
					$no_row+=mysqli_num_rows($rsql);
					
					$i++;
					}
				
			}else{
				
				$i=$ilid;
				
				$rsql=mysqli_query($link,"SELECT score FROM stud_repository WHERE stud_id='$val' AND level='$i' and (etest='saved' OR etest='unsaved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
						}
					$no_row+=mysqli_num_rows($rsql);
					
				}
				
				
				$agg=round(($lsc/$no_row),2);
				
			//Conditional Ranking
				$sgrade=$this->condrank($agg,$ilids);
			//End Ranking
			if(!empty($agg)){
					echo "
						<tr >
								<td></td>
								<td></td>
								<td></td>
								<td><center>Overall Aggregate: <b>$agg</b></center></td>
								<td><center><b>$sgrade</b></center></td>
								<td></td>
							</tr>";
			}	
			
		}
	
	
//E-Library	-----------------------------------------------------------------------------------------------
	
	//View Library	
	public function lib($val){
		
		global $link;
		
		ucwords($val);
		$mail=$_SESSION['em'];
		
		$sql_skl=mysqli_query($link,"SELECT school,cat FROM users WHERE email='$mail'");
		list($sklname,$mdp)=mysqli_fetch_row($sql_skl);
		
		 
				if(empty($val)){
					$sql=mysqli_query($link,"SELECT * FROM library WHERE cat='$mdp' or cat='General' ORDER BY id");
				}else{
					$sql=mysqli_query($link,"SELECT * FROM library WHERE title LIKE ('%$val%') and cat='$mdp' or cat='General'");	 
				}
				
			echo "<tr>
	                <th>Title</th>
					<th>Author</th>
                    <th>Catalogue</th>
                    <th>Recommended For</th>
					<th>ISBN</th>
					<th>Uploaded By</th>
					<th>PDF</th>
                </tr>";
				
		while(list($id,$sbj_id,$title,$isbn,$level,$uploader,$pdf,$date,$cat,$author)=mysqli_fetch_row($sql)){
					
				if($level>0){
						$get_lv=mysqli_query($link,"SELECT level FROM level WHERE id='$level'");
						list($level)=mysqli_fetch_row($get_lv);
					}
					
				if($author>0){
						$get_au=mysqli_query($link,"SELECT name FROM users WHERE id='$author'");
						list($author)=mysqli_fetch_row($get_au);
					}

					
					$itl=strlen($title)<18?$title:substr($title,0,16).'...';
					trim($pdf);
					
						echo "
						<tr style='color:black'>
								
								<td>
									
								<a title='$title'>$itl</a>
								
								</td>
								
								<td>$author</td>
								<td>$cat</td>
								<td><center>$level</center></td>
								<td>$isbn</td>
								<td>$uploader</td>
								<td><center><a href='../uploads/library/$pdf' download title='Download'><img src='../images/dld.png' width='auto' height='20px'></a>&nbsp;|&nbsp;<a href='../uploads/library/$pdf' target='_new' title='View'><img src='../images/list.png' width='auto' height='20px'></a></center></td>
							</tr>";
			}
		}
		
	//Add to Library
	public function adlib($title,$alevel,$author,$isbn,$hfile,$cart){
		
		global $link;
		
		(string)trim($alevel);
		(string)trim($cart);
		(string)trim($isbn);
		
		
		$mail=$_SESSION['em'];
		
			$chk_q=mysqli_query($link,"SELECT name,id,cat FROM users WHERE email='".mysqli_real_escape_string($link,$mail)."'");
			list($uname,$uid,$mdp)=mysqli_fetch_row($chk_q);
			

			$chk_a=mysqli_query($link,"SELECT * FROM library WHERE title='".mysqli_real_escape_string($link,$title)."'");

			if(mysqli_num_rows($chk_a)==0){	
		
			$x_sql=mysqli_prepare($link,"INSERT INTO library(id,sbj_id,title,isbn,level_id,uid,pdf,date,cat,author) VALUES(?,?,?,?,?,?,?,?,?,?)");
		
			//@bind param
			$empty='';
			$date=date('D, M Y: H:i A');
		
			mysqli_stmt_bind_param($x_sql,'iissssssss',$empty,$empty,$title,$isbn,$alevel,$uname,$hfile,$date,$cart,$author);
			
			$rsql=mysqli_stmt_execute($x_sql);
				$sbj_id=mysqli_stmt_insert_id($x_sql);
				if($rsql){
					
				//@Close last query
				mysqli_stmt_close($x_sql);
				
				@rename("../uploads/library/del/$hfile","../uploads/library/$hfile");
				
				echo "<b><img src='../images/accept.png' width='auto' height='13px'>Book Successfully Added.</b>";
				}
		
		}else{
			echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Book Already Exist: Suggest Using Another Title.</b>";
			}	
	}//End OF Function
	
//END OF E-LIBRARY---------------------------------------------------------------------------------------------
	


}

//End of Class PROCESS -ADMINISTRATOR CLASS

//USERS
class user extends process
{
	
	
	protected  $file;
	private $left;
	
	
	//Constructor
	public function __construct($file){
		file_exists($file)?'':die('App Shutdown Unexpectedly, Please Contact App Provider');
		}	
	
	//load menu

	
	//Users Login
	public function ulogin($tel,$pin){
		global $link;
		$pin=sha1(strtoupper($pin));
		
		
		
		@(int)$_SESSION['utrial']+=1;
		
		$this->left=5-($_SESSION['utrial']);
			
			$sql=mysqli_query($link,"SELECT role,bk FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$pin)."'");
			
				if(mysqli_num_rows($sql)==1 && $_SESSION['utrial']<5){
					list($role,$bk)=mysqli_fetch_row($sql);
					
					if($bk==1){
						echo "<b><img src='images/cancel.png' width='auto' height='13px'>&nbsp;You have been <span style='color:red;'>BLOCKED</span></b>";
						}else{
							$_SESSION['tel']=$tel;
							$_SESSION['ups']=$pin;
							$_SESSION['urole']=$role;
							unset($_SESSION['utrial']);
							echo 101;
						}
				}else{
					
					if((int)$this->left<=-1){
						
						echo "<b><img src='images/cancel.png' width='auto' height='13px'>&nbsp;Trials Exhausted: <a href='lgt.php'>Refresh</a></b>";
						
					}else{
						echo "<b><img src='images/cancel.png' width='auto' height='13px'>&nbsp;Tel. No or Password Incorrect. $this->left trials left</b>";
					}
				}
	}
	
	//Check User and Page Authentication
	public function validateus(){
		
		global $link;
		
		$a=$_SESSION['tel'];
		$b=$_SESSION['ups'];
		$c=$_SESSION['urole'];
		
		$sql_ch=mysqli_query($link,"SELECT * FROM users WHERE email='$a' and password='$b' and role='$c' and bk='0'");
			if(mysqli_num_rows($sql_ch)==0){
				header('location:lgt.php');
				}	
		}
	
	//Uprof
	public function uprof($a,$b){
		global $link;
		
		$sql=mysqli_query($link,"SELECT id,role,name,pix,sex,school,cat,level_id FROM users WHERE email='$a' and password='$b'");
			if(mysqli_num_rows($sql)==1){
				list($id,$role,$name,$pix,$sex,$skl,$mdp,$level)=mysqli_fetch_row($sql);


				$sql_level=mysqli_query($link,"SELECT * FROM level WHERE id='$level'");
				list($idl,$rl,$sl)=mysqli_fetch_row($sql_level);

				
				ucfirst($role);
				ucwords($name);
				strtoupper($sex);
				ucfirst($mdp);
				
					
			echo "<div id='details'>
       		 
			 <p class='webdata'>
        		<span id='left' style='float:left;'>School</span>
        		<span id='right' style='float:right; color:green;'>$skl</span>
        	</p>

       		 <p class='webdata'>
        		<span id='left' style='float:left;'>Name</span>
        		<span id='right' style='float:right;'>$name</span>
        	</p>
       
        	<p class='webdata'>
        		<span id='left' style='float:left;'>Role</span>
        		<span id='right' style='float:right;'>$role</span>
       	 	</p>

        	<p class='webdata'>
        		<span id='left' style='float:left;'>Department</span>
        		<span id='right' style='float:right;'>$mdp</span>
       	 	</p>

			
			<p class='webdata'>
        		<span id='left' style='float:left;'>Level</span>
        		<span id='right' style='float:right;'>$rl</span>
       	 	</p>
	
	       <p class='webdata'>
        		<span id='left' style='float:left;'>Term</span>
        		<span id='right' style='float:right;'>$sl</span>
       	 	</p>

	   
        	<p class='webdata'>
        		<span id='left' style='float:left;'>Gender</span>
        		<span id='right' style='float:right;'>$sex</span>
       	 	</p>
       
        	</div>";
        
				if($pix=='favater.jpg' || $pix=='mavater.jpg'){
					echo "<div id='pix'>
							<img src='uploads/pix/$pix' width='auto' height='160px'>
								<br>
							<span style='margin-left:98px;'>
								<a id='changepix' title='Change Picture'><img src='images/edit.png' width='auto' height='10px'></a>
							</span>
						</div>";
					}else{
						
						echo "<div id='pix'>
									<img src='uploads/pix/$pix' width='auto' height='160px'>
								</div>";
						
						}
		
	
				}else{
					echo "<center><p><b>No Profile</b></p><center>";
					}
	}
	
	//Change passkey
	public function cpp($new,$cnew,$old){
		global $link;
		//echo $_SESSION['ups'];
		if($_SESSION['ups']==$old){
				$tel=$_SESSION['tel'];
				$get_id=mysqli_query($link,"SELECT id,pix FROM users WHERE email='$tel'");
				list($uid,$pix)=mysqli_fetch_row($get_id);
				
				if($cnew==$new){
					$new=sha1($new);
					$cnew=base64_encode($cnew);
						
						
						$sql=mysqli_query($link,"UPDATE users SET password='".mysqli_real_escape_string($link,$new)."' WHERE id='$uid'") or die('er1');
						$sql_c=mysqli_query($link,"UPDATE rec SET sh='".mysqli_real_escape_string($link,$new)."',encoded='$cnew' WHERE uid='$uid'") or die('er2');	
						if($sql_c){
							header("location:../lgt.php");							
							}
						
					}else{
						echo "Please Confirm New Passkey";
						}
			}else{
				echo "Please Enter A Correct Old Passkey";
				}
	}
	
	//Update Pix	
	public function hfp($ipfile){
		global $link;
				$mail=$_SESSION['tel'];
				$get_id=mysqli_query($link,"SELECT id,pix FROM users WHERE email='$mail'");
				list($uid,$pix)=mysqli_fetch_row($get_id);
				
						$sql=mysqli_query($link,"UPDATE users SET pix='$ipfile' WHERE id='$uid'");
						
						@rename("../uploads/pix/del/$ipfile","../uploads/pix/$ipfile");
						header('location:../cpanel.php');
						
	}
	
	//library
	public function ulib($val){
		
		global $link;
		
		ucwords($val);
		$mail=$_SESSION['tel'];
		
		$sql_skl=mysqli_query($link,"SELECT school,cat FROM users WHERE email='$mail'");
		list($sklname,$mdp)=mysqli_fetch_row($sql_skl);
		
		 
				if(empty($val)){
					$sql=mysqli_query($link,"SELECT * FROM library WHERE cat='$mdp' or cat='General' ORDER BY id");
				}else{
					$sql=mysqli_query($link,"SELECT * FROM library WHERE title LIKE ('%$val%') AND cat='$mdp' or cat='General'");	 
				}
				
			echo "<tr>
                	
	                <th>Title</th>
					<th>Author</th>
                    <th>Catalogue</th>
                    <th>Recommended For</th>
					<th>ISBN</th>
					<th>Uploaded By</th>
					<th>PDF</th>
					
                </tr>";
				
		while(list($id,$sbj_id,$title,$isbn,$level,$uploader,$pdf,$date,$cat,$author)=mysqli_fetch_row($sql)){
					
				if($level>0){
						$get_lv=mysqli_query($link,"SELECT level FROM level WHERE id='$level'");
						list($level)=mysqli_fetch_row($get_lv);
					}
					
				if($author>0){
						$get_au=mysqli_query($link,"SELECT name FROM users WHERE id='$author'");
						list($author)=mysqli_fetch_row($get_au);
					}

					
					$itl=strlen($title)<18?$title:substr($title,0,16).'...';
					trim($pdf);
					
						echo "
					
						<tr style='color:black'>
								
								<td>
									
								<a title='$title'>$itl</a>
								
								</td>
								
								<td>$author</td>
								<td>$cat</td>
								<td><center>$level</center></td>
								<td>$isbn</td>
								<td>$uploader</td>
								<td><center><a href='uploads/library/$pdf' download title='Download'><img src='images/dld.png' width='auto' height='20px'></a>&nbsp;|&nbsp;<a href='uploads/library/$pdf' target='_new' title='View'><img src='images/list.png' width='auto' height='20px'></a></center></td>
									
							</tr>";
			}
		}
	
	//COPY COMPULSORY AND GENERAL SUBJECT
	public function getcompsbj(){
		global $link;
		global $uid;
			
			$sql_get_id=mysqli_query($link,"SELECT level_id,cat FROM users WHERE id='$uid'");
			list($lvid,$mdp)=mysqli_fetch_row($sql_get_id);			
			
			//@sql

			$level_array = explode('/', $lvid);
			$lvid = $level_array[0];

			$sql=mysqli_query($link,"SELECT id,pri,cat,etest FROM subject WHERE level='$lvid' and pri=1 and cat='$mdp'");			
				
				$stmt=mysqli_prepare($link,"INSERT INTO stud_sbj_profile(id,stud_id,level,sbj_id,score,pri,cat,etest) VALUES(?,?,?,?,?,?,?,?)");
					
				$e='';
					
					while(list($sbj_id,$pri,$cat,$etest)=mysqli_fetch_row($sql)){
						
						$sbj_profile=mysqli_query($link,"SELECT sbj_id FROM stud_sbj_profile WHERE level='$lvid' and stud_id='$uid' and pri=1 and sbj_id='$sbj_id'");
						
						if(mysqli_num_rows($sbj_profile)>0){
							continue;
						}else{
							mysqli_stmt_bind_param($stmt,'iiiiiiss',$e,$uid,$lvid,$sbj_id,$e,$pri,$cat,$etest);
							mysqli_stmt_execute($stmt);
						
						}
				}		
		}
		
	//V. Subjects
	public function msbjs(){
		global $link;
		global $uid;
		
		$sql_usr=mysqli_query($link,"SELECT level_id FROM users WHERE id='$uid'");
		list($cur_lev)=mysqli_fetch_row($sql_usr);
		
		$cur_level_array = explode('/', $cur_lev);
		$cur_lev = $cur_level_array[0];
		$cur_term = $cur_level_array[1];

		$sql_get_sbj=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid'");
		
			echo "<tr>
                	
	                <th>Subject</th>
					<th>Level</th>
                    <th>Tutor</th>
					<th>Handout</th>
					<th>E-test</th>
					
                </tr>";
				
		while(list($id,$stud_id,$level,$sbj_id,$score,$pri,$cat,$ietest)=mysqli_fetch_row($sql_get_sbj)){
					
				$my_subject=mysqli_query($link,"SELECT * FROM subject WHERE id='$sbj_id'");
				list($idr,$sbj,$ilevel,$overview,$pdf,$tutor_id,$category,$etest,$ipri)=mysqli_fetch_row($my_subject);
				
				$chk_sbj_status=mysqli_query($link,"SELECT status FROM stud_exam_status WHERE sbj_id='$sbj_id' and stud_id='$uid'");
				list($test_status)=mysqli_fetch_row($chk_sbj_status);

				$my_tutor=mysqli_query($link,"SELECT name FROM users WHERE id='$tutor_id'");
				list($tutor_name)=mysqli_fetch_row($my_tutor);
				$tutor_name=ucwords($tutor_name);

			if($ilevel==$cur_lev){

//saved			
				if($etest=='saved' && mysqli_num_rows($chk_sbj_status)==0 && empty($test_status)){
					
					$etest="<a href='taketest.php?sbj=$sbj_id' tabindex='3' target='_new' title='Take Test'><img src='images/edit1.png' height='15px' width='auto'></a>";
		
					
				}else if($etest=='unsaved'){
//Unsaved		
					$ck=0;
					$etest="Not Ready";

				}else if(empty($etest)){
//Empty				
					$ck=0;
					$etest="No Test";
						
				}else if($etest=='saved' && mysqli_num_rows($chk_sbj_status)==1 && $test_status==0){
					$etest="<a href='taketest.php?sbj=$sbj_id' tabindex='3' target='_new' title='Continue Test'>Continue Test</a>
					";
					$ck=1;
					
				}else if(!empty($etest) && mysqli_num_rows($chk_sbj_status)==1 && $test_status==1){
					$ck=1;
					$etest="Exam Completed";
					
				}
				
			}else if($ilevel!=$cur_lev){
				$ck=1;
				$etest="Term Completed";
			}
				
				if($cur_term == 1){
					$sl = "First Term";
				}else if ($cur_term == 2) {
					$sl = "Second Term";
				}else{
					$sl = "Third Term";
				}
					
				$sql_level=mysqli_query($link,"SELECT * FROM level WHERE id='$level'");
				list($idl,$rl)=mysqli_fetch_row($sql_level);
					
					$isbj=strlen($sbj)<18?$sbj:substr($sbj,0,16).'...';
				
					$color=$pri==1?'rgba(61, 61, 255, 0.88)':'black';
						echo "
					
						<tr style='color:$color'>";
								
								if($ipri==1 || $ck==1){
									echo "
									<td>
									<input type='checkbox' name='sbjkey[]' value='$sbj_id' disabled='disabled'>&nbsp;&nbsp;
									<a title='$sbj'>$isbj</a>
									</td>
									";
								}else{
									echo "<td>
										<input type='checkbox' name='sbjkey[]' value='$sbj_id'>&nbsp;&nbsp;
										<a title='$sbj'>$isbj</a>
										</td>";
								}
								echo "
								<td><center><b>$rl > $sl</b></center></td>
								
								<td><center>$tutor_name</center></td>
								
								<td><center>

<a href='uploads/library/$pdf' download title='Download'><img src='images/dld.png' width='auto' height='20px'></a>

&nbsp;|&nbsp;

<a href='uploads/library/$pdf' target='_new' title='View'><img src='images/list.png' width='auto' height='20px'></a>

</center>			</td>
								
								<td><center>$etest</center></td>

						
						</tr>";
			}
		}
	
	//All subject
	public function asbjs(){
		global $link;
		global $uid;
		
		$sql_level=mysqli_query($link,"SELECT level_id,cat FROM users WHERE id='$uid'");
		list($lvid,$mdp)=mysqli_fetch_row($sql_level);
		
		
		$sql_get_sbj=mysqli_query($link,"SELECT * FROM subject WHERE level='$lvid' and pri=0 and cat='$mdp' UNION SELECT * FROM subject WHERE level='$lvid' and cat='General'");
		
		/*$sql_gen=mysqli_query($link,"SELECT * FROM subject WHERE level='$lvid' and cat='General'");*/
		
			echo "<tr>
                	
	                <th>Subject</th>
                    <th>Level</th>
					<th>Term</th>
                    <th>For</th>
					<th>Tutor</th>
                    <th>Participatant</th>
					<th>Handout</th>
					<th>E-test</th>
					
                </tr>";
				
		while(list($id,$sbj,$level,$recom,$material,$tutid,$cat,$etest,$pri)=mysqli_fetch_row($sql_get_sbj)){
					
				$sql_part=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE sbj_id='$id'");
				$participant=mysqli_num_rows($sql_part);
				$idr=urlencode($id);


//saved
				if($etest=='saved'){
					
					$cketest=1;
					$etest="Available";
				
				
				}else if($etest=='unsaved'){
//Unsaved		
					$cketest=0;
					$etest="Not Ready";
				
					
				}else{
//Empty
					$cketest=0;
					$etest="Not Available";	
					}
				
				$material=empty($material)?"No":"Yes";
				
				$sql_tut=mysqli_query($link,"SELECT name FROM users WHERE id='$tutid'");
				list($tname)=mysqli_fetch_row($sql_tut);
					
					
				$sql_lev=mysqli_query($link,"SELECT level,slevel FROM level WHERE id='$lvid'");
				list($rl,$sl)=mysqli_fetch_row($sql_lev);
				
				
					$isbj=strlen($sbj)<18?$sbj:substr($sbj,0,16).'...';
					$color=$pri==1?'rgba(61, 61, 255, 0.88)':'black';
						
						echo "
					
						<tr style='color:$color'>";
								if($cketest==1){
									echo "<td>
										<input type='checkbox' name='sbjkey[]' value='$id' disabled='disabled'>&nbsp;&nbsp;
										<a title='$sbj'>$isbj</a>
								
									</td>";
								}else{
									echo "<td>
										<input type='checkbox' name='sbjkey[]' value='$id'>&nbsp;&nbsp;
										<a title='$sbj'>$isbj</a>
									</td>";
									}
							echo "		
								<td>$rl</td>
								<td>$sl</td>
								<td>$cat</td>
								<td>$tname</td>
								<td>$participant Students</td>
								<td>$material</td>
								<td><center>$etest</center></td>
						
						</tr>";
			}
		}
		
	//Add To My sbj
	public function addtomysbj($sql,$sbj,$cat,$etest){
		global $link;
		global $uid;
		
		$sm=mysqli_query($link,"SELECT level,pri FROM subject WHERE id='$sbj'");
		list($lvid,$pri)=mysqli_fetch_row($sm);
		
		$e='';
		mysqli_stmt_bind_param($sql,'iiiiiiss',$e,$uid,$lvid,$sbj,$e,$pri,$cat,$etest);
		
		mysqli_stmt_execute($sql);
		
		} 
		
	//Exam Starts
	public function examhint($a){
		global $link;
		global $uid;
		
		$stud=mysqli_query($link,"SELECT pix FROM users WHERE id='$uid'");
		list($pix)=mysqli_fetch_row($stud);
		
		$_SESSION['stp']=$a;
		
		$sql=mysqli_query($link,"SELECT * FROM etest_durations WHERE sbj_id='$a'");
			if(mysqli_num_rows($sql)==1){
				list($id,$isbj,$period,$no_q,$no_p)=mysqli_fetch_row($sql);


				$sql_sb=mysqli_query($link,"SELECT sbj,uid FROM subject WHERE id='$a'");
				list($sbj,$tut)=mysqli_fetch_row($sql_sb);


				$sql_tut=mysqli_query($link,"SELECT name FROM users WHERE id='$tut'");
				list($tutor)=mysqli_fetch_row($sql_tut);

				
			echo "<div id='details'>
       		 
			 <p class='webdata'>
        		<span id='left' style='float:left;'>Subject</span>
        		<span id='right' style='float:right; color:green;'>$sbj</span>
        	</p>

       		 <p class='webdata'>
        		<span id='left' style='float:left;'>Exam Period</span>
        		<span id='right' style='float:right;'>$period Minutes</span>
        	</p>
       
        	<p class='webdata'>
        		<span id='left' style='float:left;'>No Of Questions</span>
        		<span id='right' style='float:right;'>$no_q Question(s)</span>
       	 	</p>

        	<p class='webdata'>
        		<span id='left' style='float:left;'>Tutor</span>
        		<span id='right' style='float:right;'>$tutor</span>
       	 	</p>
       
        	</div>";
        
					if($pix=='favater.jpg' || $pix=='mavater.jpg'){
					echo "<div id='pix'>
							<img src='uploads/pix/$pix' width='auto' height='140px'>
						</div>";
					}else{
						
						echo "<div id='pix'>
									<img src='uploads/pix/$pix' width='auto' height='140px'>
								</div>";
						
						}
			}
		}
	
	//Questions
	public function qs($sbj){
		global $link;
		global $uid;
		global $qval;
		
		
				//Get Max And Min Id Qs
				$sql1=mysqli_query($link,"SELECT MIN(id),MAX(id) FROM exam_pro WHERE sbj_id='$sbj'");
				list($fqs,$lqs)=mysqli_fetch_row($sql1);
				
				//Sql ,Select Qs
				if(empty($qval) || $qval==0){
					$sql=mysqli_query($link,"SELECT * FROM exam_pro WHERE sbj_id='$sbj' and id='$fqs'");					

				}else{
					$sql=mysqli_query($link,"SELECT * FROM exam_pro WHERE sbj_id='$sbj' and id='$qval'");
					}
				
				
				
				if(mysqli_num_rows($sql)!=0){
				
					list($id,$stud_id,$tuid,$question,$options,$answer,$sbj_id,$qimg,$choosen)=mysqli_fetch_row($sql);
					
					
				
					$next=$id+1;
					$prev=$id-1;
					
					//Question Image
					$qimg=empty($qimg)?"":"<img src='uploads/qimg/$qimg' width='auto' height='120px'>";
					ucwords($answer);
					
					
					//Question and Option
					echo "
						$qimg
				 		<p class='letters' style='font-family:Times New Roman;'>$question</p>
            
			            <form method='post' id='getanswers' style='margin-top:15px;'>
						";
			
					$opt=explode('|',$options);
			
					foreach($opt as $option){
								strip_tags($option,'<b><i><sup><sub><u>');
						if(strcasecmp($choosen,$option)==0){
							echo "<div class='all'><input type='radio' data-qid='$id' id='uans' name='uans' value='$option' checked><span style='font-family:Times New Roman;'>$option</span></div>";	
							}
							
						else{
							echo "<div class='all' style='font-family:Times New Roman;'><input type='radio' data-qid='$id' id='uans' name='uans' value='$option'><span style='font-family:Times New Roman;'>$option</span></div>";	
				}
								
							//echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option'><span>$option</span></div>";	
							
							}//End Foreach
				
				           	echo "</form>
							
							<br>
							
							<div class'clr'></div>
							
							";
							
			//Navigators
			
			         echo  "<center>";
					 
					 if($id==$fqs && $id!=$lqs){
        	            
						//$_SESSION['qval']=$next;
						echo "<a id='nexttest' href='cbt.php?qval=$next'><img src='images/next.jpg' width='75px' height='auto'></a>";
						
					}else if($id>$lqs){
						
						header('location:cbt.php');
					
					}else if($id>$fqs && $id!=$lqs  && $id==$qval){
    	            	
						
					    echo "<a href='cbt.php?qval=$prev' id='prevtest'><img src='images/pre.jpg' width='75px' height='auto'></a>
       
	   &nbsp;&nbsp;&nbsp;
        	        
					    <a id='nexttest' href='cbt.php?qval=$next'><img src='images/next.jpg' width='75px' height='auto'></a>";
		
					}else if($id==$lqs){
    	                
						$_SESSION['qval']=$prev;
						echo "<a href='cbt.php?qval=$prev' id='prevtest'><img src='images/pre.jpg' width='75px' height='auto'></a>";		
						}
                    
                    echo "</center>";	
					
			}else{
				echo "<p class='letters' style='text-align:center;'>NO QUESTION</p>";
				}		
		}
	
	//Inline List Of Answered And Non-Answered Questions	
	public function getAnsweredQs($sbj){
		global $link;
		global $uid;
		global $qval;
		
		$sql=mysqli_query($link,"SELECT id,choosen_ans FROM exam_pro WHERE sbj_id='$sbj' and stud_id='$uid'");
		
		
		$flist=mysqli_num_rows($sql);
		
		echo "<ul class='inlinelist' style='border:1px solid white; border-radius:5px; box-shadow:0px 0px 4px lightgrey inset; display:inline-block; height:auto; margin:0; padding:0;'>";
		
		for($i=1;$i<=$flist;$i++){
			
			list($id,$chs)=mysqli_fetch_row($sql);
			
			if(!empty($chs) && $id!=$qval){
				$bg='rgba(0, 185, 0, 0.79)';
				$cl='white';	
			}else if((!empty($chs) && $id==$qval) || (empty($chs)  && $id==$qval)){
				
				$bg='rgba(0, 0, 212, 0.71)';
				$cl='white';	
			
			}else{
				$bg='white';
				$cl='rgba(0, 185, 0, 0.79)';	
			}


			echo "<a href='cbt.php?qval=$id'><li style='color:$cl; display:inline-block; font-family:Calibri; font-size:15px; background:$bg; padding:10px 10px 10px 10px; margin:0px; border-right:1px solid white;'>$i</li></a>";
			
		}
		echo "</ul>";
		}
	
	//Mark Test
	public function marktest($sbj){
		global $link;
		global $uid;
		$score=0;
		
		$sql=mysqli_query($link,"SELECT choosen_ans,answer FROM exam_pro WHERE stud_id='$uid' and sbj_id='$sbj'");
		while(list($stans,$tutans)=mysqli_fetch_row($sql)){
			
			if(strcasecmp($stans,$tutans)==0){
				$score++;
				//echo $score;
			}		
		}
		
		$all=mysqli_num_rows($sql);
			$score=($score*100)/$all;
			$score=round(
							$score
						,2);
			
			$lsql=mysqli_query($link,"UPDATE stud_sbj_profile SET score='$score' WHERE stud_id='$uid' and sbj_id='$sbj'");
		
			$del=mysqli_query($link,"DELETE FROM exam_pro WHERE stud_id='$uid' and sbj_id='$sbj'");
			
			$sql_rt=mysqli_query($link,"SELECT name,level_id FROM users WHERE id='$uid'") or die(mysqli_error);
			list($name,$reallevel)=mysqli_fetch_row($sql_rt);
		
			$stmt=mysqli_prepare($link,"INSERT INTO sc(id,stud_id,level,sbj_id,score,pri,cat,etest,date) VALUES(?,?,?,?,?,?,?,?,?)");
			
			$sql_dump=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' and level='$reallevel' and sbj_id='$sbj'") or die(mysqli_error);
			
			$e='';
			list($id,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest)=mysqli_fetch_row($sql_dump);
				$year=date('Y',mktime());
				mysqli_stmt_bind_param($stmt,'iiiisisss',$e,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest,$year);
				mysqli_stmt_execute($stmt);
				
		}
	
	//Run Promotion
	public function PromoteMe(){
		global $link;
		global $uid;
		$aggregate=0;
		
		$sql_rt=mysqli_query($link,"SELECT name,level_id FROM users WHERE id='$uid'") or die(mysqli_error);
		list($name,$reallevel)=mysqli_fetch_row($sql_rt);
		
		$sql_rt=mysqli_query($link,"SELECT MAX(id) FROM level") or die(mysqli_error);
		list($Highest)=mysqli_fetch_row($sql_rt);
		
		$sql_ag=mysqli_query($link,"SELECT score FROM stud_sbj_profile WHERE stud_id='$uid' and (etest='saved' OR etest='unsaved')") or die(mysqli_error);
		while(list($score)=mysqli_fetch_row($sql_ag)){
			
				$aggregate+=$score;
			
			}
	
	$no_sbj=mysqli_num_rows($sql_ag);
	round(($aggregate/=$no_sbj),2);
	
	
	if($reallevel!=$Highest){
		if($reallevel!=0 && $aggregate>39){
			
			$stmt=mysqli_prepare($link,"INSERT INTO stud_repository(id,stud_id,level,sbj_id,score,pri,cat,etest) VALUES(?,?,?,?,?,?,?,?)");
			
			$sql_dump=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' and level='$reallevel'") or die(mysqli_error);
			
			while(list($id,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest)=mysqli_fetch_row($sql_dump)){
			$e='';
				
				mysqli_stmt_bind_param($stmt,'iiiiiiss',$e,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest);
				mysqli_stmt_execute($stmt);
				
			}

					$reallevel++;
					
			
				$sql=mysqli_query($link,"UPDATE users SET level_id='$reallevel' WHERE id='$uid'") or die(mysqli_error);
				$sql_del_sbjs=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE stud_id='$uid'") or die(mysqli_error);
				$sql_del_exam_stat=mysqli_query($link,"DELETE FROM stud_exam_status WHERE stud_id='$uid'") or die(mysqli_error);
				header('location:../imsbj.php');
		
		}else{
				$reallevel-=2;
				$isql=mysqli_query($link,"UPDATE users SET level_id='$reallevel' WHERE id='$uid'") or die(mysqli_error);
				$sql_del_exam_stat=mysqli_query($link,"DELETE FROM stud_exam_status WHERE stud_id='$uid'") or die(mysqli_error);
				$sql_del_sbjs=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE stud_id='$uid'") or die(mysqli_error);
				$sql_del_sbj_repository=mysqli_query($link,"DELETE FROM stud_repository WHERE stud_id='$uid'") or die(mysqli_error);
				echo "Aggregate Score: <span style='color:red;'>$aggregate</span>, You Failed. <a href='../imsbj.php'>Retake Class</a>";
			}
			
		}else{
			
			if($aggregate>39){
			
			$stmt=mysqli_prepare($link,"INSERT INTO stud_repository(id,stud_id,level,sbj_id,score,pri,cat,etest) VALUES(?,?,?,?,?,?,?,?)");
			
			$sql_dump=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' and level='$reallevel'") or die(mysqli_error);
			
			while(list($id,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest)=mysqli_fetch_row($sql_dump)){
			$e='';
				
				mysqli_stmt_bind_param($stmt,'iiiiiiss',$e,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest);
				mysqli_stmt_execute($stmt);
				
			}

				$sql=mysqli_query($link,"UPDATE users SET level_id='$reallevel' WHERE id='$uid'") or die(mysqli_error);
				$sql_del_sbjs=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE stud_id='$uid'") or die(mysqli_error);
				$sql_del_exam_stat=mysqli_query($link,"DELETE FROM stud_exam_status WHERE stud_id='$uid'") or die(mysqli_error);
				echo "Aggregate Score: <span style='color:green;'>$aggregate</span>, Congratulations, Happy Graduation Ahead. <a href='../cpanel.php'>Home</a>";
				
			}else{
				$reallevel-=2;
				$sql=mysqli_query($link,"UPDATE users SET level_id='$reallevel' WHERE id='$uid'") or die(mysqli_error);
				$sql_del_exam_stat=mysqli_query($link,"DELETE FROM stud_exam_status WHERE stud_id='$uid'") or die(mysqli_error);
				$sql_del_sbjs=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE stud_id='$uid'") or die(mysqli_error);
				$sql_del_sbj_repository=mysqli_query($link,"DELETE FROM stud_repository WHERE stud_id='$uid'") or die(mysqli_error);
				echo "Aggregate Score: <span style='color:red;'>$aggregate</span>, You Failed. <a href='../imsbj.php'>Retake Class</a>";
				}
		}
	}
	
	//Extended Menu
	public function SelectMoreMenu(){
		global $link;
		global $uid;
		

		$sq_usr=mysqli_query($link,"SELECT level_id FROM users WHERE id='$uid'");
		list($slv_id)=mysqli_fetch_row($sq_usr);
	
		
		$sql_user=mysqli_query($link,"SELECT MAX(id),slevel FROM level WHERE id='$slv_id'");
		list($lmid,$term)=mysqli_fetch_row($sql_user);
		
		$sql_h=mysqli_query($link,"SELECT MAX(id) FROM level");
		list($mid)=mysqli_fetch_row($sql_h);
		
		$sql_pro=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' AND etest='saved' AND level='$slv_id' UNION SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' AND etest='unsaved' AND level='$slv_id'");
		
		$sql_ipro=mysqli_query($link,"SELECT * FROM stud_exam_status WHERE stud_id='$uid' AND status='1' AND level='$slv_id'") or die(mysqli_error());
		
		
		if(mysqli_num_rows($sql_pro)==mysqli_num_rows($sql_ipro) && mysqli_num_rows($sql_pro)!=0 && mysqli_num_rows($sql_ipro)!=0){
			
			if($term=='Third term' && $slv_id!=$mid){
				
				echo "<a href='uprocess/runpromotion.php'><img src='images/runpromo.png' height='auto' width='75px'></a>&nbsp;&nbsp;&nbsp;";
       			echo "<a href='checkstudresult.php' target='_new'><img src='images/result.png' height='auto' width='75px'></a>&nbsp;&nbsp;&nbsp;";

			}else if($term=='Third term' && $slv_id==$mid){
				echo "<a href='uprocess/runpromotion.php'><img src='images/finalize.png' height='auto' width='75px'></a>&nbsp;&nbsp;&nbsp;";
				echo "<a href='checkstudresult.php' target='_new'><img src='images/result.png' height='auto' width='75px'></a>&nbsp;&nbsp;&nbsp;";
				
			}else{
				echo "<a href='uprocess/gotonextterm.php'><img src='images/nextterm.png' height='auto' width='75px'></a>&nbsp;&nbsp;&nbsp;";	
				echo "<a href='checkstudresult.php' target='_new'><img src='images/result.png' height='auto' width='75px'></a>&nbsp;&nbsp;&nbsp;";
				}				
					
		}else{
			echo "";
			}
	}

	//Next Term
	public function nextterm(){
		global $link;
		global $uid;
		
		$sql_rt=mysqli_query($link,"SELECT name,level_id FROM users WHERE id='$uid'") or die(mysqli_error);
		list($name,$reallevel)=mysqli_fetch_row($sql_rt);
		
		if($reallevel!=0){
			
			$stmt=mysqli_prepare($link,"INSERT INTO stud_repository(id,stud_id,level,sbj_id,score,pri,cat,etest) VALUES(?,?,?,?,?,?,?,?)");
			
			$sql_dump=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' and level='$reallevel'") or die(mysqli_error);
			
			$e='';
			while(list($id,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest)=mysqli_fetch_row($sql_dump)){
				
				mysqli_stmt_bind_param($stmt,'iiiiiiss',$e,$stud,$stud_level,$stud_sbj,$score,$pri,$cat,$etest);
				mysqli_stmt_execute($stmt);
				}

			$reallevel++;
			
			$sql=mysqli_query($link,"UPDATE users SET level_id='$reallevel' WHERE id='$uid'") or die(mysqli_error);
			header('location:../imsbj.php');
		
		}else{
			echo "System_Error:Move Failed";
			}
	}

	//Stud Result Current Level
	public function curterm(){
		global $link;
		global $uid;
		
		$sql_rt=mysqli_query($link,"SELECT name,level_id FROM users WHERE id='$uid'");
		list($name,$reallevel)=mysqli_fetch_row($sql_rt);
		
		$sql_lv=mysqli_query($link,"SELECT slevel FROM level WHERE id='$reallevel'");
		list($cterm)=mysqli_fetch_row($sql_lv);
		
		$sql=mysqli_query($link,"SELECT level,sbj_id,score,etest FROM stud_sbj_profile WHERE stud_id='$uid' ORDER BY level");		
		
		
			echo "<tr>
	                <th>Subject</th>
                    <th>Level</th>
                    <th>Term</th>
					<th>Exam Score</th>
                    <th>Grade</th>
					<th>Tutor</th>
                </tr>";
			
		
		$lsc=0;$no_row=0;
		while(list($slid,$sbj,$score,$et)=mysqli_fetch_row($sql)){
			
			$sql_sb=mysqli_query($link,"SELECT sbj,uid FROM subject WHERE id='$sbj'");
			list($sbjname,$tut)=mysqli_fetch_row($sql_sb);
			
			$sql_t=mysqli_query($link,"SELECT name FROM users WHERE id='$tut'");
			list($tutor)=mysqli_fetch_row($sql_t);
			
			$sql_lev=mysqli_query($link,"SELECT * FROM level WHERE id='$slid'");
			list($lid,$rl,$sl)=mysqli_fetch_row($sql_lev);

			//Conditional Ranking
				$sgrade=$this->condrank($score,$reallevel);
			//End Ranking
			
			
			$color=$score<=39?'red':'black';
			$score=empty($et)?'ABS':$score;
			$sgrade=empty($et)?'ABS':$sgrade;
					
					if($reallevel==$lid){
						$rl="<b>$rl</b>";
						$sl="<b>$sl</b>";
						}
					echo "
					
						<tr >
								
								<td>
								<a>$sbjname</a>
								
								</td>
								<td><center>$rl</center></td>
								<td><center>$sl</center></td>
								<td style='color:$color'><center>$score</center></td>
								<td style='color:$color'><center>$sgrade</center></td>
								<td>$tutor</td>
								
								
							</tr>";
			
			}
			
			if($cterm=='Third term'){
				$i=$reallevel-2;
				while($i<=$reallevel){
					
					$rsql=mysqli_query($link,"SELECT score FROM stud_sbj_profile WHERE stud_id='$uid' AND level='$i' AND (etest='saved' OR etest='unsaved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
					}
					
					$no_row+=mysqli_num_rows($rsql);
				
					$i++;
					}
				
			}else if($cterm=='Second term'){
				$i=$reallevel-1;
				while($i<=$reallevel){
					
					$rsql=mysqli_query($link,"SELECT score FROM stud_sbj_profile WHERE stud_id='$uid' AND level='$i' and (etest='saved' OR etest='unsaved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
						}
					
					$no_row+=mysqli_num_rows($rsql);
					
					$i++;
					}
				
			}else{
				
				$i=$reallevel;
				
				$rsql=mysqli_query($link,"SELECT score FROM stud_sbj_profile WHERE stud_id='$uid' AND level='$i' and (etest='saved' OR etest='unsaved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
						}
					$no_row+=mysqli_num_rows($rsql);
					
				}
				
				
				$agg=round(($lsc/$no_row),2);
				
			//Conditional Ranking
				$sgrade=$this->condrank($agg,$reallevel);
			//End Ranking
			if(!empty($agg)){
					echo "
						<tr >
								<td></td>
								<td></td>
								<td></td>
								<td><center>Overall Aggregate: <b>$agg</b></center></td>
								<td><center><b>$sgrade</b></center></td>
								<td></td>
							</tr>";
			}
		}
	
	//Expo
	public function ExpoForStud(){
		global $link;
		
		$sbj_id=$_SESSION['stp'];

		$sqln=mysqli_query($link,"SELECT * FROM tm_test WHERE sbj_id='$sbj_id'");
		if(mysqli_num_rows($sqln)>0){
		$i=0;
		while(list($id,$x1,$uid,$q,$op,$ans,$sbjd,$qimg)=mysqli_fetch_row($sqln)){
		$i++;
		
		echo '<span>'.$i.')&nbsp;</span>';
		$qimg=empty($qimg)?"":"<img src='uploads/qimg/$qimg' width='auto' height='120px'>";
			ucwords($ans);
			echo "
					$qimg
				 <p class='letters' style='font-family:Times New Roman; margin-bottom:3px;'>$q</p>
            
            <form method='post' id='getanswers' style='margin-top:15px; margin-bottom:5px;'>
            	
                
			";
			
			$opt=explode('|',$op);
			
			foreach($opt as $option){
				
				
				if(strcasecmp($ans,$option)==0){
					echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option' disabled><span style='font-family:Times New Roman; margin-bottom:3px; margin-top:3px;'>$option&nbsp;<img src='images/accept.png' width='15px' height='auto'></span></div>";	}
				else{
					echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option' disabled><span style='font-family:Times New Roman; margin-bottom:3px;  margin-top:3px;'>$option</span></div>";	
				}
			}
				
           	echo "</form><br>
			
			
			";
			
			}//loop
			}else{
				echo "<p class='letters' style='text-align:center;'>NO QUESTION</p>";
				}
		
		}
	
	//Search Result
	public function sinceterm($term,$level){
		global $link;
		global $uid;
		
		$sql_lev=mysqli_query($link,"SELECT id FROM level WHERE level='$level' and slevel='$term'");
		list($lid)=mysqli_fetch_row($sql_lev);

		$sql_rt=mysqli_query($link,"SELECT name,level_id FROM users WHERE id='$uid'");
		list($name,$reallevel)=mysqli_fetch_row($sql_rt);
		
			echo "<tr>
	                <th>Subject</th>
                    <th>Level</th>
                    <th>Term</th>
					<th>Exam Score</th>
                    <th>Grade</th>
					<th>Tutor</th>
                </tr>";

		
		
		if($term=='Third term'){
				
				$i=$lid-2;
				while($i<=$lid){
					
					$sql=mysqli_query($link,"SELECT level,sbj_id,score,etest FROM stud_repository WHERE stud_id='$uid' and level='$i' ORDER BY level");
					
					while(list($slid,$sbj,$score,$et)=mysqli_fetch_row($sql)){
		
					
					$sql_ilev=mysqli_query($link,"SELECT level,slevel FROM level WHERE id='$slid'");
					list($level,$term)=mysqli_fetch_row($sql_ilev);
					
					$sql_sb=mysqli_query($link,"SELECT sbj,uid FROM subject WHERE id='$sbj'");
					list($sbjname,$tut)=mysqli_fetch_row($sql_sb);
			
					$sql_t=mysqli_query($link,"SELECT name FROM users WHERE id='$tut'");

					list($tutor)=mysqli_fetch_row($sql_t);
			
			

			//Conditional Ranking
						$sgrade=$this->condrank($score,$lid);
			//End Ranking
			
			
					$color=$score<=39?'red':'black';
					$score=empty($et)?'ABS':$score;
					$sgrade=empty($et)?'ABS':$sgrade;
					
					
					echo "
					
						<tr >
								
								<td>
								<a>$sbjname</a>
								
								</td>
								<td><center>$level</center></td>
								<td><center>$term</center></td>
								<td style='color:$color'><center>$score</center></td>
								<td style='color:$color'><center>$sgrade</center></td>
								<td>$tutor</td>
								
								
							</tr>";
			
				}
					
					$i++;
				}
				
			}else if($term=='Second term'){
				
				$i=$lid-1;
				while($i<=$lid){
					
					$sql=mysqli_query($link,"SELECT level,sbj_id,score,etest FROM stud_repository WHERE stud_id='$uid' and level='$i' ORDER BY level");
					
					while(list($slid,$sbj,$score,$et)=mysqli_fetch_row($sql)){
		
					$sql_ilev=mysqli_query($link,"SELECT level,slevel FROM level WHERE id='$slid'");
					list($level,$term)=mysqli_fetch_row($sql_ilev);
					
					$sql_sb=mysqli_query($link,"SELECT sbj,uid FROM subject WHERE id='$sbj'");
					list($sbjname,$tut)=mysqli_fetch_row($sql_sb);
			
					$sql_t=mysqli_query($link,"SELECT name FROM users WHERE id='$tut'");
					list($tutor)=mysqli_fetch_row($sql_t);
			
			

			//Conditional Ranking
						$sgrade=$this->condrank($score,$lid);
			//End Ranking
			
			
					$color=$score<=39?'red':'black';
					$score=empty($et)?'ABS':$score;
					$sgrade=empty($et)?'ABS':$sgrade;
					
					
					echo "
					
						<tr >
								
								<td>
								<a>$sbjname</a>
								
								</td>
								<td><center>$level</center></td>
								<td><center>$term</center></td>
								<td style='color:$color'><center>$score</center></td>
								<td style='color:$color'><center>$sgrade</center></td>
								<td>$tutor</td>
								
								
							</tr>";
			
				}
					
					$i++;
				}
				
			}else{
				
				$i=$lid-0;
				
					
					$sql=mysqli_query($link,"SELECT level,sbj_id,score,etest FROM stud_repository WHERE stud_id='$uid' and level='$i' ORDER BY level");
					while(list($slid,$sbj,$score,$et)=mysqli_fetch_row($sql)){
		
					$sql_ilev=mysqli_query($link,"SELECT level,slevel FROM level WHERE id='$slid'");
					list($level,$term)=mysqli_fetch_row($sql_ilev);
					
					$sql_sb=mysqli_query($link,"SELECT sbj,uid FROM subject WHERE id='$sbj'");
					list($sbjname,$tut)=mysqli_fetch_row($sql_sb);
			
					$sql_t=mysqli_query($link,"SELECT name FROM users WHERE id='$tut'");
					list($tutor)=mysqli_fetch_row($sql_t);
			
			

			//Conditional Ranking
						$sgrade=$this->condrank($score,$lid);
			//End Ranking
			
			
					$color=$score<=39?'red':'black';
					$score=empty($et)?'ABS':$score;
					$sgrade=empty($et)?'ABS':$sgrade;
					
					
					echo "
					
						<tr >
								
								<td>
								<a>$sbjname</a>
								
								</td>
								<td><center>$level</center></td>
								<td><center>$term</center></td>
								<td style='color:$color'><center>$score</center></td>
								<td style='color:$color'><center>$sgrade</center></td>
								<td>$tutor</td>
								
								
							</tr>";
			
				}
			}
					
		
		$lsc=0;$no_row=0;
		
		if($term=='Third term'){
				$i=$lid-2;
				while($i<=$lid){
					
					$rsql=mysqli_query($link,"SELECT score FROM stud_repository WHERE stud_id='$uid' AND level='$i' AND (etest='unsaved' OR etest='saved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
					}
					
					$no_row+=mysqli_num_rows($rsql);
				
					$i++;
					}
				
			}else if($term=='Second term'){
				$i=$lid-1;
				while($i<=$lid){
					
					$rsql=mysqli_query($link,"SELECT score FROM stud_repository WHERE stud_id='$uid' AND level='$i' and (etest='unsaved' OR etest='saved')");
					while(list($svc)=mysqli_fetch_row($rsql)){
						$lsc+=$svc;
						}
					

					$no_row+=mysqli_num_rows($rsql);
					
					$i++;
					}
				
			}else{
				
							$i=$lid+0;
				
				$rsql=mysqli_query($link,"SELECT score,stud_id FROM stud_repository WHERE stud_id='$uid' AND level='$i' and (etest='unsaved' OR etest='saved')");
					$no_row=mysqli_num_rows($rsql);
					
					while(list($svc,$vc)=mysqli_fetch_row($rsql)){
						
						$lsc+=$svc;
						}
					
					
					
				}
			
				$agg=round(($lsc/$no_row),2);
				
			//Conditional Ranking
				$sgrade=$this->condrank($agg,$lid);
			//End Ranking
			
			
			if(!empty($agg)){
					echo "
						<tr >
								<td></td>
								<td></td>
								<td></td>
								<td><center>Overall Aggregate: <b>$agg</b></center></td>
								<td><center><b>$sgrade</b></center></td>
								<td></td>
							</tr>";
			}
		}
	
	
	}//end of class -users || students
?>