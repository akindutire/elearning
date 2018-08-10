// JavaScript Document
document.ready(function(){
	
	$('input.checke').bind('click',function(event){
		
			$('input.checked').removeClass().addClass('check');
			alert('Unchecked');
			});
	});