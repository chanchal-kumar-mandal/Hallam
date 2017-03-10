function multiselect_selected($el) {
	var ret = true;
	$('option', $el).each(function(element) {
	  if (!!!$(this).prop('selected')) {
	    ret = false;
	  }
	});
	return ret;
}
   
  /**
   * Selects all the options
   * @param {jQuery} $el
   * @returns {undefined}
   */
function multiselect_selectAll($el) {
	$('option', $el).each(function(element) {
	  $el.multiselect('select', $(this).val());
	});
}
  /**
   * Deselects all the options
   * @param {jQuery} $el
   * @returns {undefined}
   */
function multiselect_deselectAll($el) {
	$('option', $el).each(function(element) {
	  $el.multiselect('deselect', $(this).val());
	});
}
   
  /**
   * Clears all the selected options
   * @param {jQuery} $el
   * @returns {undefined}
   */
function multiselect_toggle($el, $btn) {
	if (multiselect_selected($el)) {
	  multiselect_deselectAll($el);
	  $btn.text("Select All");
	}
	else {
	  multiselect_selectAll($el);
	  $btn.text("Deselect All");
	}
}

/*Form Message Vanish*/

function message_remove(){
	setTimeout(function(){ 
		$("#message").html('');
	}, 5000);
}
function message_remove_and_page_reload(){
	setTimeout(function(){ 
		/*$("#message").html('');*/
		location.reload(true);
	}, 5000);
}
function close_message_modal(){
	setTimeout(function(){ 
		$('#messageModal').modal('hide');
	}, 5000);
}


/* Remove Address From Individual */

function removeAddress(addressId){
	$("#deleteModal").modal();	
	$('#confirmMessage').html('<h5 class="text-danger text-center">Are you sure delete this address?</h5>');
	$('#deleteButton').html('<a class="btn btn-danger btn-sm" onclick="hideAddress('+addressId+')">Ok</a>');
}

function hideAddress(addressId){
	$('#deleteModal').modal('hide');
	$("#is-exist-address" + addressId).val(0);
	$("#addressContainer" + addressId + " :input").prop('required',null);
	$("#addressContainer" + addressId).css("display", "none");
}


/* Remove Email From Individual */

function removeEmail(emailId){
	$("#deleteModal").modal();	
	$('#confirmMessage').html('<h5 class="text-danger text-center">Are you sure delete this email?</h5>');
	$('#deleteButton').html('<a class="btn btn-danger btn-sm" onclick="hideEmail('+emailId+')">Ok</a>');
}

function hideEmail(emailId){
	$('#deleteModal').modal('hide');
	$("#is-exist-email" + emailId).val(0);
	$("#emailContainer" + emailId + " :input").prop('required',null);
	$("#emailContainer" + emailId).css("display", "none");
}


/* Remove Telephone From Individual */

function removeTelephone(telephonelId){
	$("#deleteModal").modal();	
	$('#confirmMessage').html('<h5 class="text-danger text-center">Are you sure delete this telephone?</h5>');
	$('#deleteButton').html('<a class="btn btn-danger btn-sm" onclick="hideTelephone('+telephonelId+')">Ok</a>');
}

function hideTelephone(telephonelId){
	$('#deleteModal').modal('hide');
	$("#is-exist-telephone" + telephonelId).val(0);
	$("#telephoneContainer" + telephonelId + " :input").prop('required',null);
	$("#telephoneContainer" + telephonelId).css("display", "none");
}


/* Remove Note From Individual */

function removeNote(noteId){
	$("#deleteModal").modal();	
	$('#confirmMessage').html('<h5 class="text-danger text-center">Are you sure delete this note?</h5>');
	$('#deleteButton').html('<a class="btn btn-danger btn-sm" onclick="hideNote('+noteId+')">Ok</a>');
}

function hideNote(noteId){
	$('#deleteModal').modal('hide');
	$("#is-exist-note" + noteId).val(0);
	$("#noteContainer" + noteId + " :input").prop('required',null);
	$("#noteContainer" + noteId).css("display", "none");
}


/* Remove Shareholder From Company */

function removeShareholder(sharehoderId){
	$("#deleteModal").modal();	
	$('#confirmMessage').html('<h5 class="text-danger text-center">Are you sure delete this shareholder?</h5>');
	$('#deleteButton').html('<a class="btn btn-danger btn-sm" onclick="hideShareholder('+sharehoderId+')">Ok</a>');
}

function hideShareholder(sharehoderId){
	$('#deleteModal').modal('hide');
	$("#is-exist-shareholder" + sharehoderId).val(0);
	$("#shareholderContainer" + sharehoderId + " :input").prop('required',null);
	$("#shareholderContainer" + sharehoderId).css("display", "none");
}


/* Delete Content(Individual, Comany, VAT, Task, Note) */

function deleteContent(id, string){
	var additionalConfirmMessage = "";
	if(string == "individual"){
		additionalConfirmMessage = "All vat, task, address, email, telephone, note will be deleted related to this " + string + ". ";
	}else if(string == "company"){
		additionalConfirmMessage = "All vat, task, note will be deleted related to this " + string + ". ";
	}else{
		additionalConfirmMessage = "";
	}
	var str = "'"+string+"'";
	$("#deleteModal").modal();	
	$('#confirmMessage').html('<h5 class="text-danger text-center">'+additionalConfirmMessage+'Are you sure delete this '+string+' ?</h5>');
	$('#deleteButton').html('<a class="btn btn-danger btn-sm" onclick="deleteContentFromDb('+id+', '+str+')">Ok</a>');	
}

function deleteContentFromDb(id, string){
	$('#deleteModal').modal('hide');
	$.ajax({
		type: "POST",
		url: "delete-"+string+".php",
		data: {id:id},
		cache: false,
		success: function(result){
			if(result.status == 'success'){	
				$("#messageModal").modal();	
				$("#message").html('<div class="text-center"><img src="../images/loading-small.gif" alt="Loading"/></div><div class="success-message">'+result.message+'</div>');
				message_remove_and_page_reload();
			}
			if(result.status == 'fail'){
				if(result.message == 'Please login'){
					window.location.href = "login.php";
				}else{			
					$("#messageModal").modal();	
					$("#message").html('<div class="error-message">'+result.message+'</div>');
				}
			}
		}
	});
}

/* Individual Archieve To Live --> View All */

function individualLive(id){
	$.ajax({
		type: "POST",
		url: "individual-live-submit.php",
		data: {id:id},
		cache: false,
		success: function(result){
			if(result.status == 'success'){	
				$("#messageModal").modal();	
				$("#message").html('<div class="text-center"><img src="../images/loading-small.gif" alt="Loading"/></div><div class="success-message">'+result.message+'</div>');
				message_remove_and_page_reload();
			}
			if(result.status == 'fail'){
				if(result.message == 'Please login'){
					window.location.href = "login.php";
				}else{			
					$("#messageModal").modal();	
					$("#message").html('<div class="error-message">'+result.message+'</div>');
				}
			}
		}
	});
}

/* Check numeric value "2147483647" and restrict to submit form */
function checkNumberAndRestrictFormSubmit(formId){
	var formData = $('#'+formId).serializeArray();
	for (var key in formData) {
		if (formData.hasOwnProperty(key)) {
			if(formData[key].value == "2147483647"){
				$("#messageModal").modal();	
				$("#message").html('<div class="error-message">Please insert other number except "2147483647".</div>');
				return true;
			}
		}
	}
	return false;
}

/* Checking Form Field / Validation Check */
function checkFormValidatin(){
	var flagTabValidationError = true;
	if(flagTabValidationError){
		$('input:invalid').each(function () {
	        // Find the tab-pane that this element is inside, and get the id
	        var $closest = $(this).closest('.tab-pane');
	        var id = $closest.attr('id');
	        /*$("#messageModal").modal();
	        $("#message").html('<div class="error-message">Please fill up all fields correctly in '+id+' tab.</div>');
			close_message_modal();*/
			if(confirm('Please fill up all fields correctly in '+id+' tab.')){
	        	// Find the link that corresponds to the pane and have it show
	        	$('.nav a[href="#' + id + '"]').tab('show');
	        	location.hash = id;
			};
	        // Only want to do it once
	        flagTabValidationError = false;
	        return false;
	    });
	}
	if(flagTabValidationError){
	    $('select:invalid').each(function () {
	        // Find the tab-pane that this element is inside, and get the id
	        var $closest = $(this).closest('.tab-pane');
	        var id = $closest.attr('id');
	        /*$("#messageModal").modal();
	        $("#message").html('<div class="error-message">Please fill up all fields correctly in '+id+' tab.</div>');
			close_message_modal();*/
			if(confirm('Please fill up all fields correctly in '+id+' tab.')){
	        	// Find the link that corresponds to the pane and have it show
	        	$('.nav a[href="#' + id + '"]').tab('show');
	        	location.hash = id;
			};
	        // Only want to do it once
	        flagTabValidationError = false;
	        return false;
	    });
	}
	if(flagTabValidationError){
	    $('textarea:invalid').each(function () {
	        // Find the tab-pane that this element is inside, and get the id
	        var $closest = $(this).closest('.tab-pane');
	        var id = $closest.attr('id');
	        /*$("#messageModal").modal();
	        $("#message").html('<div class="error-message">Please fill up all fields correctly in '+id+' tab.</div>');
			close_message_modal();*/
			if(confirm('Please fill up all fields correctly in '+id+' tab.')){
	        	// Find the link that corresponds to the pane and have it show
	        	$('.nav a[href="#' + id + '"]').tab('show');
	        	location.hash = id;
			};
	        // Only want to do it once
	        return false;
	    });
	}
	return flagTabValidationError;

}

/* Autofill Partner tab's surname, address, country, email and telephone fields */

function changePartnerSurname(){
	var maritalStatus = $('#maritalStatus').val();
	if(maritalStatus == "Married" || maritalStatus == "Cohabiting"){
		$('#pSurname').val($('#surname').val());
	}else{
		$('#pSurname').val("");
	}
}

function changePartnerAddress(){
	var maritalStatus = $('#maritalStatus').val();
	if(maritalStatus == "Married" || maritalStatus == "Cohabiting"){
		$('#pAddress').text($('#address1').val());
	}else{
		$('#pAddress').text("");
	}
}

function changePartnerCountry(){
	var maritalStatus = $('#maritalStatus').val();
	if(maritalStatus == "Married" || maritalStatus == "Cohabiting"){
		$('#pCountryId').val($('#countryId').val());
	}else{
		$('#pCountryId').val("");
	}
}

function changePartnerEmail(){
	var maritalStatus = $('#maritalStatus').val();
	if(maritalStatus == "Married" || maritalStatus == "Cohabiting"){
		$('#pEmail').val($('#email1').val());
	}else{
		$('#pEmail').val("");
	}
}

function changePartnerTelephone(){
	var maritalStatus = $('#maritalStatus').val();
	if(maritalStatus == "Married" || maritalStatus == "Cohabiting"){
		$('#pTelephone').val($('#telephone1').val());
	}else{
		$('#pTelephone').val("");
	}
}

function changeMaritalStatus(){
	changePartnerSurname();
	changePartnerAddress();
	changePartnerCountry();
	changePartnerEmail();
	changePartnerTelephone();
}

$(document).ready(function(){

	/* Go To Particular Bootstrap Tab Of Edit Individual Page 
	$('a[href="' + window.location.hash + '"]').trigger('click');*/

	/* Go To Particular Bootstrap Tab And Change Url With Hash Depending On Tab */
	if(location.hash) {
        $('a[href=' + location.hash + ']').tab('show');
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });

	/*Form Reset*/
	$("#resetFormButton").click(function(){
		$("form")[0].reset();
		$("#message").html('');
	});

    /* Change User password */
	$("#changeUserPasswordForm").submit(function(){	

		$.ajax({
			type: "POST",
			url: "change-user-password-submit.php",
			data: $('#changeUserPasswordForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					message_remove_and_page_reload();	
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#message").html('<div class="error-message">'+result.message+'</div>');
					}	
				}
			}
		});
		return false;
	});

	/* Datepicker */
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	/* Datepicker For Individual*/
    $('#dob').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#date_of_death').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#date_of_marriage').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#engagement_start_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#engagement_end_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#p_dob').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#p_date_of_death').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#businessCommencementDate').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#uk_sixtyfour_eight_to_hmrc_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#f_business_commencement_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#f_business_end_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#fd5_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#p85_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#nrl1_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#s1_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#sixtyfour_eight_to_hmrc_date').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    /* Datepicker For Company*/
    $('#registrationDate').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#annualReturnDate').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    /* Year and Month */
    $('#yearEnd').datepicker({
        format: 'mm-yyyy',
        viewMode: "months", 
        minViewMode: "months",
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#annualReturnDue').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
    $('#sharesDisposedDate1').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })

    /* Datepicker For VAT*/
    $('#vatRegisteredDate').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    });

    /* Datepicker For Tasks*/
    $('#taskActionDate').datepicker({
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    });    

	/* Multiselect Companies Director For Individual AND for pending report for companies */

	$('#companies').multiselect({
	    selectAllValue: 'multiselect-all',
	    enableCaseInsensitiveFiltering: true,
	    enableFiltering: true,
	});

    $("#companies-toggle").click(function(e) {
      e.preventDefault();
      multiselect_toggle($("#companies"), $(this));
    });

    /* Add address in Add/Edit Indiviual */

    $("#addAddress").click(function(){

    	var noOfAddress = $("#no_of_address").val();
    	var currentNoOfAddress = parseInt(noOfAddress, 10) + 1 ;

    	$("#addresses").append('<div class="well" id="addressContainer'+currentNoOfAddress +'">'+'<div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeAddress('+ currentNoOfAddress +')">X</span></div>'+'<input type="hidden" id="is-exist-address' + currentNoOfAddress + '" name="is-exist-address'+ currentNoOfAddress +'" value="1">'+'<div class="form-group has-success">'+
            '<label class="control-label" for="inputSuccess">Address</label>'+
            '<textarea class="form-control" name="address'+currentNoOfAddress+'" rows="3" placeholder="Enter Address"></textarea>'+
        '</div>'+
        '<div class="form-group has-warning">'+
        	'<label class="control-label" for="inputWarning">Address Description</label>'+            
            '<input type="text" class="form-control" id="inputWarning" name="address_description'+currentNoOfAddress+'" placeholder="Enter Address Description">'+
        '</div></div>');

    	$("#no_of_address").val(currentNoOfAddress);
    });

    /* Add Email in Add/Edit Indiviual */

    $("#addEmail").click(function(){

    	var noOfEmail = $("#no_of_email").val();
    	var currentNoOfEmail = parseInt(noOfEmail, 10) + 1 ;

    	$("#emails").append('<div class="well" id="emailContainer'+currentNoOfEmail +'">'+'<div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeEmail('+ currentNoOfEmail +')">X</span></div>'+'<input type="hidden" id="is-exist-email' + currentNoOfEmail + '" name="is-exist-email'+ currentNoOfEmail +'" value="1">'+'<label class="control-label" for="inputSuccess">Email Id</label>'+'<div class="form-group input-group has-success">'+
            '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>'+
            '<input type="email" class="form-control" name="email'+ currentNoOfEmail +'" placeholder="Enter Email Id">'+
        '</div></div>');

    	$("#no_of_email").val(currentNoOfEmail);
    });

    /* Add Telephone in Add/Edit Indiviual */

    $("#addTelephone").click(function(){

    	var noOfTelephone = $("#no_of_telephone").val();
    	var currentNoOfTelephone = parseInt(noOfTelephone, 10) + 1 ;

    	$("#telephones").append('<div class="well" id="telephoneContainer'+currentNoOfTelephone +'">'+'<div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeTelephone('+ currentNoOfTelephone +')">X</span></div>'+'<input type="hidden" id="is-exist-telephone' + currentNoOfTelephone + '" name="is-exist-telephone'+ currentNoOfTelephone +'" value="1">'+'<label class="control-label" for="inputSuccess">Telephone</label>'+'<div class="form-group input-group has-success">'+
            '<span class="input-group-addon"><i class="fa fa-phone"></i></span>'+
            '<input type="text" class="form-control" name="telephone'+ currentNoOfTelephone +'" placeholder="Enter Telephone">'+
        '</div>'+
        '<div class="form-group has-warning">'+
        	'<label class="control-label" for="inputWarning">Telephone Description</label>'+            
            '<input type="text" class="form-control" id="inputWarning" name="telephone_description'+currentNoOfTelephone+'" placeholder="Enter Telephone Description">'+
        '</div></div>');

    	$("#no_of_telephone").val(currentNoOfTelephone);
    });


    /* Add Note in Add/Edit Indiviual or Company */

    $("#addNote").click(function(){

    	var noOfNote = $("#no_of_note").val();
    	var currentNoOfNote = parseInt(noOfNote, 10) + 1 ;

    	var d = new Date();

		var year = d.getFullYear();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var hour = d.getHours();
		var minute = d.getMinutes();
		var second = d.getSeconds();

		var dateToday = year+"-"+month+"-"+day;

    	$("#clientNotes").append('<div class="well" id="noteContainer'+currentNoOfNote +'">'+'<div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeNote('+ currentNoOfNote +')">X</span></div>'+'<input type="hidden" id="is-exist-note' + currentNoOfNote + '" name="is-exist-note'+ currentNoOfNote +'" value="1">'+'<div class="form-group"><label>Note Title</label>'+'<input type="text" class="form-control" name="note_title'+ currentNoOfNote +'" placeholder="Enter Note Title">'+'</div>'+'<div class="form-group">'+
            '<label class="control-label">Note</label> '+
            '<textarea class="form-control" name="note'+ currentNoOfNote +'" rows="15" placeholder="Enter Note"></textarea>'+
        '</div>'+
        '<input type="hidden" class="form-control" name="note_creation_date'+ currentNoOfNote +'" value="'+dateToday+'">'+
        '</div>');

    	$("#no_of_note").val(currentNoOfNote);
    });

	$('#addIndividualSubmitButton').click(function(){
		checkFormValidatin();
	});

	$("#addIndividualForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('addIndividualForm')){
			return false;
		}else{

			var companies = $('#companies').val();
			$('#companyIds').val(companies);

			$.ajax({
				type: "POST",
				url: "add-individual-submit.php",
				data: $('#addIndividualForm').serialize(),
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						$("form")[0].reset();
						message_remove_and_page_reload();	
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							close_message_modal();	
						}	
					}
				}
			});
		}
		return false;
	});

	$('#dataTables-example').DataTable({
        responsive: true
    });

	$('#editIndividualSubmitButton').click(function(){
		checkFormValidatin();
	});

	$("#editIndividualForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('editIndividualForm')){
			return false;
		}else{

			var companies = $('#companies').val();
			$('#companyIds').val(companies);

			/* Remove all disabled attribute from all input in Tax Return Submitted To HMRC section */
			/*$(".disableReturnableTaxYear").prop('required', true);*/

			$.ajax({
				type: "POST",
				url: "edit-individual-submit.php",
				async: true,
				data: $('#editIndividualForm').serialize(),
				dataType:"json",
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						message_remove_and_page_reload();
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();		
						}	
					}
				}
			});
		}
		return false;
	});

	$('#individuals').multiselect({
	    selectAllValue: 'multiselect-all',
	    enableCaseInsensitiveFiltering: true,
	    enableFiltering: true,
	});

    $("#individuals-toggle").click(function(e) {
      e.preventDefault();
      multiselect_toggle($("#individuals"), $(this));
    });

	$("#individulsEmailSubmitForm").submit(function(){

		var individuals = $('#individuals').val();
		$('#individualIds').val(individuals);

		$.ajax({
			type: "POST",
			url: "individuals-email-submit.php",
			data: $('#individulsEmailSubmitForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					$("#individuals").multiselect( 'refresh' );
					close_message_modal();			
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						close_message_modal();
					}	
				}
			}
		});
		return false;
	});


	$('#directors').multiselect({
	    selectAllValue: 'multiselect-all',
	    enableCaseInsensitiveFiltering: true,
	    enableFiltering: true,
	});

    $("#directors-toggle").click(function(e) {
      e.preventDefault();
      multiselect_toggle($("#directors"), $(this));
    });


    $("#addShareholder").click(function(){

    	var noOfShareholder = $("#no_of_shareholder").val();
    	var currentNoOfShareholder = parseInt(noOfShareholder, 10) + 1 ;

    	$("#shareholders").append('<div class="well" id="shareholderContainer'+currentNoOfShareholder +'">'+'<div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeShareholder('+ currentNoOfShareholder +')">X</span></div>'+'<input type="hidden" id="is-exist-shareholder' + currentNoOfShareholder + '" name="is-exist-shareholder'+ currentNoOfShareholder +'" value="1">'+'<div class="form-group has-success">'+
            '<label class="control-label" for="inputSuccess">Name</label>'+
            '<input type="text" class="form-control" id="inputSuccess" name="shareholder_name'+currentNoOfShareholder+'" placeholder="Enter Shareholder Name">'+
        '</div>'+
        '<div class="form-group has-warning">'+
        	'<label class="control-label" for="inputWarning">Shares Held</label>'+            
            '<input type="number" class="form-control" id="inputWarning" name="shares_held'+currentNoOfShareholder+'" placeholder="Enter Shares Held">'+
        '</div>'+                                        
        '<label class="control-label" for="inputError">Shares Disposed Date</label>'+
        '<div class="form-group input-group has-error">'+
            '<span class="input-group-addon">'+'<i class="fa fa-calendar"></i>'+
            '</span>'+
            '<input type="text" class="form-control date-picker" id="sharesDisposedDate'+currentNoOfShareholder+'" name="shares_disposed_date'+currentNoOfShareholder+'" placeholder="Enter Shares Disposed Date">'+
        '</div></div>');

    	$("#no_of_shareholder").val(currentNoOfShareholder);

    	$('#sharesDisposedDate' + currentNoOfShareholder).datepicker({
	        format: 'dd-mm-yyyy',
	        container: container,
	        todayHighlight: true,
	        autoclose: true,
	    });
    });

	/* Payroll Other Fields visible if payroll required is yes */
	$("#payrollRequired").change(function(){
		var payrollRequired = $('#payrollRequired').val();
		if(payrollRequired == "Yes"){
			$("#payeReference").prop('required', true);
			$("#payeOfficeCode").prop('required', true);
			$("#payrollOtherContainer").css("display", "block");
		}else{
			$("#payeReference").prop('required', null);
			$("#payeOfficeCode").prop('required', null);
			$("#payrollOtherContainer").css("display", "none");

		}
	});

	$('#addCompanySubmitButton').click(function(){
		checkFormValidatin();
	});

	$("#addCompanyForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('addCompanyForm')){
			return false;
		}else{		
			var directors = $('#directors').val();
			$('#directorIds').val(directors);

			$.ajax({
				type: "POST",
				url: "add-company-submit.php",
				data: $('#addCompanyForm').serialize(),
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						$("form")[0].reset();
						$("#directors").multiselect( 'refresh' );
						message_remove_and_page_reload();				
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();	
						}	
					}
				}
			});
		}
		return false;
	});

	$('#editCompanySubmitButton').click(function(){
		checkFormValidatin();
	});

	$("#editCompanyForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('editCompanyForm')){
			return false;
		}else{		
			var directors = $('#directors').val();
			$('#directorIds').val(directors);
			
			$.ajax({
				type: "POST",
				url: "edit-company-submit.php",
				async: true,
				data: $('#editCompanyForm').serialize(),
				dataType:"json",
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						message_remove_and_page_reload();	
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();		
						}	
					}
				}
			});
		}
		return false;
	});


	$("#companiesEmailSubmitForm").submit(function(){

		var companies = $('#companies').val();
		$('#companyIds').val(companies);

		$.ajax({
			type: "POST",
			url: "companies-email-submit.php",
			data: $('#companiesEmailSubmitForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					$("#companies").multiselect( 'refresh' );
					close_message_modal();				
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	/* Annual Report Generation For Companies Depending On Month */
	$("#annualReturnMonth").change(function(){
		var annualReturnMonth = $('#annualReturnMonth').val();
		window.location.href = "companies-annual-report.php?annual_return_month=" + annualReturnMonth;
	});

	$("#addIndividualVatForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('addIndividualVatForm')){
			return false;
		}else{
			$.ajax({
				type: "POST",
				url: "add-individual-vat-submit.php",
				data: $('#addIndividualVatForm').serialize(),
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						$("form")[0].reset();
						message_remove_and_page_reload();		
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();		
						}	
					}
				}
			});
		}
		return false;
	});

	$("#editIndividualVatForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('editIndividualVatForm')){
			return false;
		}else{
			$.ajax({
				type: "POST",
				url: "edit-individual-vat-submit.php",
				data: $('#editIndividualVatForm').serialize(),
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						message_remove_and_page_reload();		
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();		
						}	
					}
				}
			});
		}
		return false;
	});

	$("#individualsVatsEmailSubmitForm").submit(function(){
		
		var individuals = $('#individuals').val();
		$('#individualIds').val(individuals);

		$.ajax({
			type: "POST",
			url: "individuals-vats-email-submit.php",
			data: $('#individualsVatsEmailSubmitForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					$("#individuals").multiselect( 'refresh' );
					close_message_modal();				
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	$("#addCompanyVatForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('addCompanyVatForm')){
			return false;
		}else{
			$.ajax({
				type: "POST",
				url: "add-company-vat-submit.php",
				data: $('#addCompanyVatForm').serialize(),
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						$("form")[0].reset();
						message_remove_and_page_reload();				
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();	
						}	
					}
				}
			});
		}
		return false;
	});

	$("#editCompanyVatForm").submit(function(){

		/* Check numeric value "2147483647" and restrict to submit form */
		if(checkNumberAndRestrictFormSubmit('editCompanyVatForm')){
			return false;
		}else{
			$.ajax({
				type: "POST",
				url: "edit-company-vat-submit.php",
				data: $('#editCompanyVatForm').serialize(),
				cache: false,
				success: function(result){
					if(result.status == 'success'){
						$("#messageModal").modal();	
						$("#message").html('<div class="success-message">'+result.message+'</div>');
						message_remove_and_page_reload();		
					}
					if(result.status == 'fail'){
						if(result.message == 'Please login'){
							window.location.href = "login.php";
						}else{
							$("#messageModal").modal();	
							$("#message").html('<div class="error-message">'+result.message+'</div>');
							/*message_remove_and_page_reload();*/
							close_message_modal();		
						}	
					}
				}
			});
		}
		return false;
	});

	$("#companiesVatsEmailSubmitForm").submit(function(){

		var companies = $('#companies').val();
		$('#companyIds').val(companies);

		$.ajax({
			type: "POST",
			url: "companies-vats-email-submit.php",
			data: $('#companiesVatsEmailSubmitForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					$("#companies").multiselect( 'refresh' );
					close_message_modal();				
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	/* Individual Or Company Dropdown Visible depending on selected value in addition or updation task */
	$("#individualOrCompany").change(function(){
		var client = $('#individualOrCompany').val();
		if(client == ""){
			$("#individualId").val('');
			/* Remove required from input element*/
			$("#individualId").prop('required', null);
			$("#individualsDropdown").css("display", "none");
			$("#companyId").val('');
			/* Remove required in from input element*/
			$("#companyId").prop('required', null);
			$("#companiesDropdown").css("display", "none");
			/*alert("Please Select Individual Or Company.");*/
			$("#messageModal").modal();	
			$("#message").html('<div class="error-message">Please select individual or company.</div>');
		}else if(client == "Individual"){
			$("#companyId").val('');
			/* Remove required in from input element*/
			$("#companyId").prop('required', null);
			$("#companiesDropdown").css("display", "none");
			/* Add required in from input element*/
			$("#individualId").prop('required', true);
			$("#individualsDropdown").css("display", "block");
		}else if(client == "Company"){
			$("#individualId").val('');
			/* Remove required from input element*/
			$("#individualId").prop('required', null);
			$("#individualsDropdown").css("display", "none");
			/* Add required in from input element*/
			$("#companyId").prop('required', true);
			$("#companiesDropdown").css("display", "block");
		}else{
			$("#individualId").val('');
			/* Remove required from input element*/
			$("#individualId").prop('required', null);
			$("#individualsDropdown").css("display", "none");
			$("#companyId").val('');
			/* Remove required in from input element*/
			$("#companyId").prop('required', null);
			$("#companiesDropdown").css("display", "none");
		}
	});

	$("#addTaskForm").submit(function(){
		
		$.ajax({
			type: "POST",
			url: "add-task-submit.php",
			data: $('#addTaskForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					message_remove_and_page_reload();				
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						/*message_remove_and_page_reload();*/
						close_message_modal();			
					}	
				}
			}
		});
		return false;
	});

	$("#editTaskForm").submit(function(){
		
		$.ajax({
			type: "POST",
			url: "edit-task-submit.php",
			data: $('#editTaskForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					message_remove_and_page_reload();			
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						/*message_remove_and_page_reload();*/
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	/* Pending Task Report Generation Depending On Month */
	$("#taskCompletionMonthInPending").change(function(){
		var taskCompletionMonthInPending = $('#taskCompletionMonthInPending').val();
		window.location.href = "tasks-pending-report.php?task_completion_month=" + taskCompletionMonthInPending;
	});

	/* Completed Task Report Generation Depending On Month */
	$("#taskCompletionMonthInCompleted").change(function(){
		var taskCompletionMonthInCompleted = $('#taskCompletionMonthInCompleted').val();
		window.location.href = "tasks-completed-report.php?task_completion_month=" + taskCompletionMonthInCompleted;
	});

	$("#addNoteForm").submit(function(){
		
		$.ajax({
			type: "POST",
			url: "add-note-submit.php",
			data: $('#addNoteForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					message_remove_and_page_reload();		
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						/*message_remove_and_page_reload();*/
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	$("#editNoteForm").submit(function(){
		
		$.ajax({
			type: "POST",
			url: "edit-note-submit.php",
			data: $('#editNoteForm').serialize(),
			cache: false,
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					message_remove_and_page_reload();				
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						/*message_remove_and_page_reload();*/
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	/* Notes For Particular Individual */
	$("#notesForIndividual").change(function(){
		var notesForIndividual = $('#notesForIndividual').val();
		window.location.href = "individuals-notes.php?individual_id=" + notesForIndividual;
	});

	/* Notes For Particular Company */
	$("#notesForCompany").change(function(){
		var notesForCompany = $('#notesForCompany').val();
		window.location.href = "companies-notes.php?company_id=" + notesForCompany;
	});

	$("#addCountryForm").submit(function(){
		
		$.ajax({
			type: "POST",
			url: "add-country-submit.php",
			data: $('#addCountryForm').serialize(),
			cache: false,
			dataType: "json",
			success: function(result){
				if(result.status === 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					$("form")[0].reset();
					message_remove_and_page_reload();				
				}
				if(result.status === 'fail'){
					if(result.message === 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						/*message_remove_and_page_reload();*/
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

	$("#editCountryForm").submit(function(){
		
		$.ajax({
			type: "POST",
			url: "edit-country-submit.php",
			data: $('#editCountryForm').serialize(),
			cache: false,
			dataType: "json",
			success: function(result){
				if(result.status == 'success'){
					$("#messageModal").modal();	
					$("#message").html('<div class="success-message">'+result.message+'</div>');
					message_remove_and_page_reload();				
				}
				if(result.status == 'fail'){
					if(result.message == 'Please login'){
						window.location.href = "login.php";
					}else{
						$("#messageModal").modal();	
						$("#message").html('<div class="error-message">'+result.message+'</div>');
						/*message_remove_and_page_reload();*/
						close_message_modal();	
					}	
				}
			}
		});
		return false;
	});

});

/* Show Particular Bootstrap Tab */
$(window).on('popstate', function() {
    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
    $('a[href=' + anchor + ']').tab('show');
});
