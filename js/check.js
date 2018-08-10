// JavaScript Document
$(function(){
		
		$('#pfile').closest('div').removeClass('hidden').addClass('all');
		$('#hfile').closest('div').removeClass('hidden').addClass('all');
		$('#sptest div').removeClass('hidden').addClass('all');
		
		$('#close').click(function(){
			$('#backfade').fadeToggle('fast');
		});
		
		//clear form input
		$('#clearform').click(function(){
			
			window.location='etest.php';
			
		});
	
		//Admin login
		$('#adlogin').click(function(event){
				event.preventDefault();
				
				var em=$('#mail').val();
				var pin=$('#pin').val();
				
				$('#feedback').html('<center><img src="../images/gld.gif" width="20px"></center>');
				//alert("i");
				$.post('../process/ilogin.php',{'mail':em,'pin':pin},function(data){
					$.trim(data);
					
					if(data==101){
						window.location='cpanel.php';
					}else{
						
						$('div #feedback').html();
						$('div #feedback').html(data);
						}
					//alert(data);
					});
			});
			
		//Add school prin. passport
		$('#pfile').on('change',function() {
        	
			var fdta=new FormData($('form:file')[0]);
			$.each($('#pfile')[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../process/uaskl.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback1').html('<center><img src="../images/gld.gif" width="20px""></center>');
								
						},/*
					beforeSend:function(evt){
						
							if(evt.lengthComputable){
								var percentComplete=evt.loaded/evt.total;
								$('#feedback1').html('<b>'+percentComplete+'</b>');
								}
						}*/
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==101){
							$('#feedback1').empty().html('<b><img src="../images/gld.gif" width="20px"">&nbsp;<span style="color:green;">File Ready</span>:Waiting For Other Fields For Submission.</b>');
							
						}else{
							$('#feedback1').html(data);
							}
                		
						//$('div.all #pfile').html('<b>File Ready For Upload</b>');
                //window.location = 'view.php';
					}
        			});
					
					
        });	

		//Change Pix
		$('#phfile').on('change',function() {
        	
			var fdta=new FormData($('form:file')[0]);
			$.each($('#phfile')[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../process/uaskl.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback1').html('<center><img src="../images/gld.gif" width="20px""></center>');
								
						},/*
					beforeSend:function(evt){
						
							if(evt.lengthComputable){
								var percentComplete=evt.loaded/evt.total;
								$('#feedback1').html('<b>'+percentComplete+'</b>');
								}
						}*/
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==101){
							$('#feedback1').empty().html('<b><img src="../images/gld.gif" width="20px"">&nbsp;<span style="color:green;">Success</span>:File Uploaded</b>');
							
						}else{
							$('#feedback1').html(data);
							}
                		
					}
        			});
        });	
		
		//Request Change Pix
		$('#chpix').click(function(event){
			event.preventDefault();
			
			$.post('../process/euaskl.php',{'sb':1},function(data){
				
				if(data==101){
					window.location='cpanel.php';
					}
				});
			alert('okay');
		});
		
		//Add subject Handout PDF
		$('#hfile').on('change',function() {
        	
			var fdta=new FormData($('form:file')[0]);
			$.each($('#hfile')[0].files,function(i,file){
				fdta.append('hfile',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../process/updf.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback1').html('<center><img src="../images/gld.gif" width="20px""></center>');
								
						},
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==101){
							$('#feedback1').empty().html('<b><img src="../images/gld.gif" width="20px"">&nbsp;<span style="color:green;">PDF Ready</span>:Waiting For Other Fields For Submission.</b>');
							
						}else{
							$('#feedback1').html(data);
							}
                		
						//$('div.all #pfile').html('<b>File Ready For Upload</b>');
                //window.location = 'view.php';
					}
        			});
					
					
        });	

		
		//Create Subject
		$('#csbj').click(function(event){
				
				event.preventDefault();
				
				$('div #feedback1').html();
				
				var sbj=$('#sbj').val(),
				 aterm=$('#aterm').val(),
				 alevel=$('#alevel').val(),
				 ovw=$('#ovw').val(),
				 pri=$('#pri').val();
				
				$('#feedback').html('<center><img src="../images/gld.gif" width="20px"></center>');
				
				$.post('../process/isbj.php',{'sbval':1,'sbj':sbj,'aterm':aterm,'alevel':alevel,'ovw':ovw,'pri':pri},function(data){
					
						$('div #feedback1').empty();
						$('div #feedback').html(data);
						
					//alert(data);
					});
			});
		
		
		//Submit school
		$('#skreg').click(function(event){
				
				event.preventDefault();
				
				$('div #feedback1').html();
				var sklname=$('#sklname').val();
				var saddress=$('#saddress').val();
				var spin=$('#spin').val();
				var prin=$('#prin').val();
				var prmail=$('#prmail').val();
				var s=$('#gender').val();
				var stel=$('#stel').val();
				
				$('#feedback').html('<center><img src="../images/gld.gif" width="20px"></center>');
				
				$.post('../process/iaskl.php',{'sbval':1,'stel':stel,'sklname':sklname,'saddress':saddress,'spin':spin,'prin':prin,'prmail':prmail,'g':s},function(data){
					
						$('div #feedback1').empty();
						$('div #feedback').html(data);
						
					//alert(data);
					});
			});
			
		//Submit student
		$('#sdreg').click(function(event){
				
				event.preventDefault();
				
				var sdname=$('#sdname').val();
				var sdgender=$('#sdgender').val();
				var sdtel=$('#sdtel').val();
				var sddp=$('#sddp').val();
				var level=$('#ilv').val();
				var term=$('#itm').val();
				
				
				$('#feedback').html('<center><img src="../images/gld.gif" width="20px"></center>');
				
				$.post('../process/iaskl.php',{'sbval':2,'dp':sddp,'sdtel':sdtel,'sdname':sdname,'sdgender':sdgender,'level':level,'term':term},function(data){
					
						$('div #feedback').html(data);
						
					//alert(data);
					});
			});
			
		//Submit tutor
		$('#tutreg').click(function(event){
				
				event.preventDefault();
				
				var tutname=$('#tutname').val();
				var tutgender=$('#tutgender').val();
				var tutmail=$('#tutmail').val();
				var tutdp=$('#tutdp').val();
				
				$('#feedback').html('<center><img src="../images/gld.gif" width="20px"></center>');
				
				$.post('../process/iaskl.php',{'sbval':3,'dp':tutdp,'tutmail':tutmail,'tutname':tutname,'tutgender':tutgender},function(data){
					
						$('div #feedback').html(data);
						
					//alert(data);
					});
			});
		
		//Search School
		$('#srname').keyup(function(event){
			
			event.preventDefault();
			
			var sr=$('#srname').val();
			
			$('#tab_cont table').html('<center><img src="../images/gld.gif" width="20px" height="auto"></center>');
			
			$.post('../process/sskl.php',{'srname':sr,'sbval':0},function(data){
					$('#tab_cont table').html(data);
				});
			});
		
		//Search Student
		$('#sdname').keyup(function(event){
			
			event.preventDefault();
			
			var sd=$('#sdname').val();
			
			$('#tab_cont table').html('<center><img src="../images/gld.gif" width="20px" height="auto"></center>');
			
			$.post('../process/sskl.php',{'sdname':sd,'sbval':1},function(data){
					$('#tab_cont table').html(data);
				});
			});
		
		//Search Tutor
		$('#tutname').keyup(function(event){
			
			event.preventDefault();
			
			var sd=$('#tutname').val();
			
			$('#tab_cont table').html('<center><img src="../images/gld.gif" width="20px" height="auto"></center>');
			
			$.post('../process/sskl.php',{'tutname':sd,'sbval':6},function(data){
					$('#tab_cont table').html(data);
				});
			});
		
		//Search Score Sheet
		$('#score').keyup(function(event){
			
			event.preventDefault();
			
			var sc=$('#score').val(),
			sbjnw=$('#sbjnw').val(),
			ty=$('#ty').val(),
			fy=$('#fy').val();
			
			$('#tab_cont table').html('<center><img src="../images/gld.gif" width="20px" height="auto"></center>');
			
			$.post('../process/sskl.php',{'tyear':ty,'fyear':fy,'score':sc,'sbval':4,'sbjnw':sbjnw},function(data){
					$('#tab_cont table').html(data);
				});
			});	
			
		//iterator
		$('table input:checkbox').bind('click',function(event){
		
			$(this).toggleClass('checke');
			
			//event.stopImmediatePropagation();
			});

				
		//lock School and Prin
		$('#lock').click(function(){
			
			//event.preventDefault();
			
			var data=new Array();
			$($("input[name='check[]']:checked")).each(function(){
				data.push($(this).val());
				});
			
			
			
			//alert(data);
			$.post('../process/arrayshift.php',{'check':data,'ltype':1},function(data){
				
					$.post('../process/sskl.php',{'srname':'','sbval':0},function(data){
					$('#tab_cont table').html(data);
				
					});	
				
			});
			
			//window.location='vskl.php';
		});  
		
		
		//Unlock School and Prin
		$('#unlock').click(function(){
						
			
			var data=new Array();
			$($("input[name='check[]']:checked")).each(function(){
				data.push($(this).val());
				});
			
			
			
			//alert(data);
			$.post('../process/arrayshift.php',{'check':data,'ltype':0},function(data){
				
					$.post('../process/sskl.php',{'srname':'','sbval':0},function(data){
					$('#tab_cont table').html(data);
				
					});	
				
			});		//	window.location='vskl.php';
			
		}); 
		
		
		//Delete Students
		$('#delstud').click(function(){
			
			$('#deletestud').trigger('submit');
			
		}); 
		
		//Delete Subjects
		$('#delsbj').click(function(){
			
			
			$('#feedback').html('<img src="../images/gld.gif" width="20px" height="auto">');
			
			var data=new Array();
			$($("input[name='sbjkey[]']:checked")).each(function(){
				data.push($(this).val());
				});
			
			
			
			//alert(data);
			$.post('../process/arrayshift.php',{'sbjkey':data,'ltype':5},function(data){
					//alert(data);
					$.post('../process/sskl.php',{'sbval':3},function(data){
						$('#tab_cont table').html(data);
						$('#feedback').empty();
					});	
				
			});
			
			
		}); 
		
		
		//lock Tut
		$('#locktut').click(function(){
			
			//event.preventDefault();
			
			var data=new Array();
			$($("input[name='tutkey[]']:checked")).each(function(){
				data.push($(this).val());
				});
			
			
			
			//alert(data);
			$.post('../process/arrayshift.php',{'tutkey':data,'ltype':3},function(data){
				
					$.post('../process/sskl.php',{'sbval':2},function(data){
					$('#tab_cont table').html(data);
				
					});	
				
			});
			
			//window.location='vskl.php';
		});  
		
		
		//Unlock Tut
		$('#unlocktut').click(function(){
						
			
			var data=new Array();
			$($("input[name='tutkey[]']:checked")).each(function(){
				data.push($(this).val());
				});
			
			
			
			//alert(data);
			$.post('../process/arrayshift.php',{'tutkey':data,'ltype':4},function(data){
				
					$.post('../process/sskl.php',{'sbval':2},function(data){
					$('#tab_cont table').html(data);
				
					});	
				
			});		
			
		});
		 
		//Setup Test
		$('#setuptest').click(function(event){
			event.preventDefault();
			
			var qu=$('#qu').val(),
			op=$('#op').val(),
			time=$('#mtp').val(),
			sbj=$('#sbj').val();
			
			if(typeof(qu)!='undefined' && typeof(op)!='undefined' && typeof(time)!='undefined'){
			
				$.post('../process/setup.php',{'sbj':sbj,'qu':qu,'op':op,'mtp':time},function(data){
					if(data==101){
						window.location="etest.php";
					}else{
						alert(data);
						}
				});
						
			}else{
				alert('Empty Fields');
				}
				
		 });
		 
		//Set Question/Options
		$('#sktest').live('click',function(event){
			
			event.preventDefault();
			$('#feedback').html();
			
			var max_option = $("input#maxoption").data('maxoption');
			var q=CKEDITOR.instances["iquestion"].getData();
			

			var opt=new Array();

           for(var i=1; i<=max_option;i++){
           	
           		var option_name ="option"+i; 
 				var se=CKEDITOR.instances[option_name].getData();
			          		
           		opt.push(se);
           }
						
			
			
			//alert(q);
			$.post('../process/itest.php',{'itval':1,'option':opt,'iquestion':q},function(data){
				 	
					
					//alert(data);
					if(data==101){
						$('form')[0].reset();
						$('#backfade').css({visibility:'visible'}).fadeToggle('fast');
						
						$('#backfade .infade').html("<center><img src='../images/gld2.gif' width='45px' height='auto'><center>");
						
						$.post('../process/itest.php',{'itval':2},function(data){
							$('#backfade .infade').html(data);
							
							});
						}else{
							alert(data);
							}
				
				});
			
			
			});
		
		//Submit Answer
		$('#skans').live('click',function(event){
			
			event.preventDefault();
			
			
			var ans=$("input[name=answer]:checked").val();
				
				if(typeof(ans)!='undefined'){
					
					$('button').attr('disabled','disabled');
					
					$.post('../process/itest.php',{'itval':3,'answer':ans},function(data){
						
						if(data==101){
							$('#feedback').html();
							$.post('../process/itest.php',{'itval':4},function(data){
								$('#pix').html(data);
								});
							
							$.post('../process/itest.php',{'itval':6},function(data){
								$('#details').html(data);
								});
						
							$('#backfade .infade').html();
							$('#backfade').fadeToggle('fast');
							
						}else{
							alert(data);
						}
						
						
					});
					
					$('button').removeAttr('disabled');
				}else{
					alert('Please Select An Answer');
					}
			
			});
			
		//Delete Question
		$('#delquestion').live('click',function(){
			var id=$(this).attr('data-id');
				
				$.post('../process/itest.php',{'itval':5,'delid':id},function(data){
					
					if(data==101){
						$.post('../process/itest.php',{'itval':4},function(data){
								$('#pix').html(data);
							});
						
						
						$.post('../process/itest.php',{'itval':6},function(data){
								$('#details').html(data);
							});
						
						
						}else{
							alert(data);
							}
					
					});
				
			});
			
		//Save Test
		$('#savetest').live('click',function(event){
			var cf=confirm("Are You Sure You Want To Save, Immediately is done process can't be withdrawn except you delete all");
				if(cf==false){
					return null;
				}else{
					
					$.post('../process/itest.php',{'itval':7},function(data){
							
							if(data==101){
									alert('Saved !');
									window.close();
									
									

							}else{
								alert(data);
								event.stopPropagation();
								}
						});
						
					
					}
			});
			
		//End Test Forcefully
		$('#fend').live('click',function(event){
			var cf=confirm("Ending Test Will Automatically Stop You For Entering More Question");
				if(cf==false){
					return null;
				}else{
					
					window.location='../process/fendtest.php';	
					
					}
			});
				
		//Add More Question Test
		$('#addmoreqs').live('click',function(event){
			
			var qs=prompt("Please Type No. of Questions To be Added to previous Question Setup");
				if(qs==''){
					return null;
				}else{
					parseInt(qs);
					$.post('../process/itest.php',{'itval':8,'qs':qs},function(data){
							
							if(data==101){
							
									window.location='etest.php';
									

							}else{
								alert(data);
								event.stopPropagation();
								}
						});
						
					
					}
			});
			
		//Change Question Time
		$('#cqs').live('click',function(event){
			
			var cqs=prompt("Enter New Exam Period in Minute");
				if(cqs==''){
					return null;
				}else{
					parseInt(cqs);
					$.post('../process/itest.php',{'itval':9,'cqs':cqs},function(data){
							
							if(data==101){
							
									window.location='etest.php';
									

							}else{
								alert(data);
								event.stopPropagation();
								}
						});
						
					
					}
			});
		
		//Add Ques. Img
		$('#qfile').live('change',function() {
        	
			var fdta=new FormData($('form:file')[0]);
			$.each($('#qfile')[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../process/qimg.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback').html('<center><img src="../images/gld.gif" width="20px""></center>');
								
						},
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==101){
							$('#feedback').empty().html('<b><img src="../images/gld.gif" width="20px"">&nbsp;<span style="color:green;">File Ready</span>:Waiting For Other Fields For Submission.</b>');
							
						}else{
							$('#feedback').html(data);
							}
                		
						//$('div.all #pfile').html('<b>File Ready For Upload</b>');
                //window.location = 'view.php';
					}
        			});
					
					
        });	
		
		//Reset Setup
		$('#reset').click(function(){
			
			var conf=confirm('Resetting Test Setup May Cost You all Questions Previously On this Subject');
			
			if(conf==false){
				return null;
			}else{
				window.location='../process/reset.php';
				}
			
		});
		
		//Add Book
			$('#adlib').click(function(event){
				
				event.preventDefault();
				
				$('div #feedback1').html();
				
				var title=$('#title').val(),
				 isbn=$('#isbn').val(),
				 alevel=$('#alevel').val(),
				 cart=$('#cart').val(),
				 author=$('#author').val();
				
				$('#feedback').html('<center><img src="../images/gld.gif" width="20px"></center>');
				
				$.post('../process/ipdf.php',{'sbval':1,'title':title,'isbn':isbn,'alevel':alevel,'cart':cart,'author':author},function(data){
					
						$('div #feedback1').empty();
						$('div #feedback').html(data);
						
					//alert(data);
					});
			});
		
		//Search Book
			$('#bkname').keyup(function(event){
			
			event.preventDefault();
			
			var bk=$(this).val();
			
			$('#tab_cont table').html('<center><img src="../images/gld.gif" width="20px" height="auto"></center>');
			
			$.post('../process/sskl.php',{'bkname':bk,'sbval':5},function(data){
					$('#tab_cont table').html(data);
				});
			});
		
		//Change Pix
		$('#changepix').live('click',function(event){
			$('#backfade').css({visibility:'visible'}).fadeToggle('fast');
		});
		
		//---------------------------------------------------------------USERS-------------------------------------------------------
		//User Login
		$('#ulogin').click(function(event){
				event.preventDefault();
				
				var tel=$('#tel').val();
				var pin=$('#pin').val();
				
				$('#feedback').html('<center><img src="images/gld.gif" width="20px"></center>');
				
				$.post('uprocess/ilogin.php',{'tel':tel,'pin':pin},function(data){
					if(data==101){
						//alert(data);
						window.location='cpanel.php';
					}else{
						$('div #feedback').html();
						$('div #feedback').html(data);
						}
					//alert(data);
					});
			});
			
		//Change Pix
			$('#uphfile').on('change',function() {
        	
			var fdta=new FormData($('form:file')[0]);
			$.each($(this)[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: 'process/uaskl.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback1').html('<center><img src="../images/gld.gif" width="20px""></center>');
								
						},/*
					beforeSend:function(evt){
						
							if(evt.lengthComputable){
								var percentComplete=evt.loaded/evt.total;
								$('#feedback1').html('<b>'+percentComplete+'</b>');
								}
						}*/
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==101){
							$('#feedback1').empty().html('<b><img src="images/gld.gif" width="20px"">&nbsp;<span style="color:green;">Success</span>:File Saved</b>');
							
						}else{
							$('#feedback1').html(data);
							}
                		
					}
        			});
        });
		
		//Search
		$('#ibkname').keyup(function(event){
			
			event.preventDefault();
			
			var bk=$(this).val();
			
			$('#tab_cont table').html('<center><img src="images/gld.gif" width="20px" height="auto"></center>');
			
			$.post('uprocess/sskl.php',{'bkname':bk,'sbval':5},function(data){
					$('#tab_cont table').html(data);
				});
			});	
		
		
		//Add To My Sbj
		$('#addtosbj').click(function(){
			$('#addsbjtomysbj').trigger('submit');
			});
		//Drop Sbj
		$('#delmysbj').click(function(){
			$('#usbj').trigger('submit');
			});
		
		//Start Exam
		$('#startexam').click(function(){
			var conf=confirm("Do You Really Want To Start Test");
			if(conf==true){
				window.location='imtest.php';
				}else{
					return null;
					}
			});
		
		//Finish Test
		$('#submitallqs').click(function(){
			var conf=confirm('Are You Sure You Want To Submit');
			if(conf==true){
				window.location='finish.php';
				}else{
					return null;
					}
			});
			
		//Get Answer
		$('#uans').live('change',function(){
			
			
			var ans=$("input[name=uans]:checked").val(),
			id=$(this).data('qid');
			
				if(typeof(ans)=='undefined'){
				
					alert('No Answer Choosen');
				}else{
					//alert('Working An Answer');
				$('#feedback').css({visibility:'visible'}).fadeToggle('fast').html('<img src="images/gld.gif" width="25px" height="auto">');

					$.post('sbuqsform.php',{'qid':id,'uans':ans},function(data){

					$('#feedback').html(data).delay(500).fadeToggle(500);
					
					
							//});
						
						});
					
					}
			
			});	

		//Open Qs.
		$('a#expand_qs').click(function(){

			var sbj=$(this).data('sbj'),
			url = '../process/retrieve.php';
			
			$.post(url,{'retrieve_id':1,'sbj_id':sbj},function(data){

					$('div#pix').css({'display':'block','background':'rgba(255, 255, 255, 0.93)','border':'1px solid grey','left':'63%','top':'5%'}).html(data).show();
					$('#close_qs').css({'display':'block','position':'absolute','background':'red','left':'100%','top':'0%'}).fadeIn();
						
			});
		
		});
		
		//Close Qs.

		$('#close_qs').click(function(){

			
					$('div#pix').css({'display':'none'});
					$('#close_qs').css({'display':'none'}).fadeOut();
						
			
		});

		jQuery.fn.extend({
insertAtCaret: function(myValue, myValueE){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      sel = document.selection.createRange();
      sel.text = myValue + myValueE;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0,     startPos)+myValue+this.value.substring(startPos,endPos)+myValueE+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = ((startPos + myValue.length) + this.value.substring(startPos,endPos).length);
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  })
    }
});
			
		//Act Selected Text
		$('#ac').live('click',function(){
			
			
			var group=$(this).data('group');
			
			var boldtext=function(){
				var newContent = $('textarea').eq(group).insertAtCaret("<b>", "</b>");
				}
			var italictext=function(){
				var newContent = $('textarea').eq(group).insertAtCaret("<i>", "</i>");				
				}
			var suptext=function(){
				var newContent = $('textarea').eq(group).insertAtCaret("<sup>", "</sup>");
				}
			var subtext=function(){
				var newContent = $('textarea').eq(group).insertAtCaret("<sub>", "</sub>");
				}


			var ck=$(this).data('st');
			
			
			
			if(ck=='boldtext'){
				boldtext();
			}else if(ck=='italictext'){
				italictext();
			}else if(ck=='suptext'){
				suptext();
			}else{
				subtext();
			}
			
		});	
		
		
		$('#aci').live('click',function(){
			
			
			var tex=$("#sel").caret().text;
		
	

			var boldtext=function(){
				var newContent = $('textarea').eq(0).insertAtCaret("<b>", "</b>");
				}
			var italictext=function(){
				var newContent = $('textarea').eq(0).insertAtCaret("<i>", "</i>");				
				}
			var suptext=function(){
				var newContent = $('textarea').eq(0).insertAtCaret("<sup>", "</sup>");
				}
			var subtext=function(){
				var newContent = $('textarea').eq(0).insertAtCaret("<sub>", "</sub>");
				}

			
			var ck=$(this).data('st');
			
			if(ck=='boldtext'){
				boldtext();
			}else if(ck=='italictext'){
				italictext();
			}else if(ck=='suptext'){
				suptext();
			}else{
				subtext();
			}
			
		});	
		
		//Confirm Finishing Test
		$('#submitallqss').click(function(){
			var confV=confirm('Are You Sure You Want To Submit');
				
				if(confV==true){
					window.location='finish.php';
					}else{
						return null;
						}
				
			});	
			
			
			
});//End of Body
