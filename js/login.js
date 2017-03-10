$(document).ready(function(){
	
	/*Login Form Submit*/
	$("#submitLoginForm").submit(function(){
		$.ajax({
			type: "POST",
			url: "login-check.php",
			data: $('#submitLoginForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();					
					window.location.href = "index.php";		
				}
				if(result.status == 'fail'){
					$("#message").html('<div class="error-message">'+result.message+'</div>');
				}
			}
		});
		return false;
	});
    
});
