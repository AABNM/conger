$(document).ready(function() {

	$('.accept, .refuse').on('click', function(e){
		e.preventDefault();
		
		var cid = $(this).attr('cid');
		var updt = ($(this).attr('class') === 'accept')? 2 : 0;
		$ele = $(this);
		
		function updtConge(data){
			console.log(data);
			if(data.updated === "ok"){
				$ele.parent().parent().remove();
			}
		}
		
		$.ajax({
    		url: "../updtconge/" + cid + "/" + updt,
		  	method: "POST",
  			dataType: "json",
  			success: updtConge
		});
	});

    

});
