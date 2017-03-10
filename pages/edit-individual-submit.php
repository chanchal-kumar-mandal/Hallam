<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');

	$individual_id=$_POST['individual_id'];
	//General Section Values
	$firstname=$_POST['firstname'];
	$surname=$_POST['surname'];
	$maiden_name=$_POST['maiden_name'];
	$client_id=$_POST['client_id'];
	$exact_no_of_address = $no_of_address = $_POST['no_of_address'];
	/*$postcode=$_POST['postcode'];*/
	$country_id=$_POST['country_id'];
	$exact_no_of_email = $no_of_email = $_POST['no_of_email'];
	$exact_no_of_telephone = $no_of_telephone = $_POST['no_of_telephone'];
	if(isset($_POST['companyIds'])){
		$companies_ids = $_POST['companyIds'];
		if($companies_ids != ""){
			$companies_ids_array = explode(",", $companies_ids);
		}else{
			$companies_ids_array = array();
		}
	}
	if($_POST['dob'] != ""){
		$dob=date('Y-m-d', strtotime($_POST['dob']));
	}else{
		$dob = "";
	}
	$place_of_birth=$_POST['place_of_birth'];
	if($_POST['date_of_death'] != ""){
		$date_of_death=date('Y-m-d', strtotime($_POST['date_of_death']));
	}else{
		$date_of_death = "";
	}
	$nationality=$_POST['nationality'];
	$passport_no=$_POST['passport_no'];
	$marital_status=$_POST['marital_status'];
	if($_POST['date_of_marriage'] != ""){
		$date_of_marriage=date('Y-m-d', strtotime($_POST['date_of_marriage']));
	}else{
		$date_of_marriage = "";
	}
	$place_of_marriage=$_POST['place_of_marriage'];
	if(isset($_POST['active'])){
		$active = "Yes";
	}else{
		$active = "No";
	}
	if(isset($_POST['on_stop'])){
		$on_stop = "Yes";
	}else{
		$on_stop = "No";
	}
	if($_POST['engagement_start_date'] != ""){
		$engagement_start_date=date('Y-m-d', strtotime($_POST['engagement_start_date']));
	}else{
		$engagement_start_date = "";
	}
	if($_POST['engagement_end_date'] != ""){
		$engagement_end_date=date('Y-m-d', strtotime($_POST['engagement_end_date']));
	}else{
		$engagement_end_date = "";
	}

	// Partner Section Values
	$p_firstname=$_POST['p_firstname'];
	$p_surname=$_POST['p_surname'];
	$p_maiden_name=$_POST['p_maiden_name'];
	$p_address=$_POST['p_address'];
	$p_postcode=$_POST['p_postcode'];
	$p_country_id=$_POST['p_country_id'];
	$p_email=$_POST['p_email'];
	$p_telephone=$_POST['p_telephone'];
	if($_POST['p_dob'] != ""){
		$p_dob=date('Y-m-d', strtotime($_POST['p_dob']));
	}else{
		$p_dob = "";
	}
	$p_place_of_birth=$_POST['p_place_of_birth'];
	if($_POST['p_date_of_death'] != ""){
		$p_date_of_death=date('Y-m-d', strtotime($_POST['p_date_of_death']));
	}else{
		$p_date_of_death = "";
	}
	$p_nationality=$_POST['p_nationality'];
	$p_passport_no=$_POST['p_passport_no'];

	// UK Section Values
	$national_insurance=$_POST['national_insurance'];
	$uk_address=$_POST['uk_address'];
	$uk_address_description=$_POST['uk_address_description'];
	$payroll_required=$_POST['payroll_required'];
	if(isset($_POST['paye_reference'])){
		$paye_reference=$_POST['paye_reference'];
	}else{
		$paye_reference = "";
	}
	if(isset($_POST['paye_office_code'])){
		$paye_office_code=$_POST['paye_office_code'];
	}else{
		$paye_office_code = "";
	}
	$first_tax_year_due=$_POST['first_tax_year_due'];	
	if(isset($_POST['tax_return_years'])){
		$tax_return_years = $_POST['tax_return_years'];
		$tax_return_years_string = implode(",", $tax_return_years);
	}
	$requires_tax_return=$_POST['requires_tax_return'];
	$utr=$_POST['utr'];
	$vat_registered=$_POST['vat_registered'];
	if($_POST['business_commencement_date'] != ""){
		$business_commencement_date=date('Y-m-d', strtotime($_POST['business_commencement_date']));
	}else{
		$business_commencement_date = "";
	}
	$other_paid_employment=$_POST['other_paid_employment'];
	$first_year_p45_p60=$_POST['first_year_p45_p60'];
	$subsequent_years_p45_p60=$_POST['subsequent_years_p45_p60'];
	$fee=$_POST['fee'];
	$fee_type=$_POST['fee_type'];
	$reference=$_POST['reference'];
	$uk_sixtyfour_eight_to_hmrc=$_POST['uk_sixtyfour_eight_to_hmrc'];
	if($_POST['uk_sixtyfour_eight_to_hmrc_date'] != ""){
		$uk_sixtyfour_eight_to_hmrc_date=date('Y-m-d', strtotime($_POST['uk_sixtyfour_eight_to_hmrc_date']));
	}else{
		$uk_sixtyfour_eight_to_hmrc_date = "";
	}
	
	// Ferance Section Values
	$social_security_no=$_POST['social_security_no'];
	$siret_number=$_POST['siret_number'];
	$business_regime=$_POST['business_regime'];
	if($_POST['f_business_commencement_date'] != ""){
		$f_business_commencement_date=date('Y-m-d', strtotime($_POST['f_business_commencement_date']));
	}else{
		$f_business_commencement_date = "";
	}
	if($_POST['f_business_end_date'] != ""){
		$f_business_end_date=date('Y-m-d', strtotime($_POST['f_business_end_date']));
	}else{
		$f_business_end_date = "";
	}
	$f_first_tax_year_due=$_POST['f_first_tax_year_due'];	
	if(isset($_POST['french_tax_return_years'])){
		$french_tax_return_years = $_POST['french_tax_return_years'];
		$french_tax_return_years_string = implode(",", $french_tax_return_years);
	}
	$f_fee=$_POST['f_fee'];
	$f_prvious_address=$_POST['f_prvious_address'];
	$fiscal_no_first=$_POST['fiscal_no_first'];
	$fiscal_no_second=$_POST['fiscal_no_second'];
	$fip_no=$_POST['fip_no'];
	$fd5=$_POST['fd5'];
	$p85=$_POST['p85'];
	$nrl1=$_POST['nrl1'];
	$s1=$_POST['s1'];
	$sixtyfour_eight_to_hmrc=$_POST['sixtyfour_eight_to_hmrc'];
	if($_POST['fd5_date'] != ""){
		$fd5_date=date('Y-m-d', strtotime($_POST['fd5_date']));
	}else{
		$fd5_date = "";
	}	
	if($_POST['p85_date'] != ""){
		$p85_date=date('Y-m-d', strtotime($_POST['p85_date']));
	}else{
		$p85_date = "";
	}	
	if($_POST['nrl1_date'] != ""){
		$nrl1_date=date('Y-m-d', strtotime($_POST['nrl1_date']));
	}else{
		$nrl1_date = "";
	}	
	if($_POST['s1_date'] != ""){
		$s1_date=date('Y-m-d', strtotime($_POST['s1_date']));
	}else{
		$s1_date = "";
	}	
	if($_POST['sixtyfour_eight_to_hmrc_date'] != ""){
		$sixtyfour_eight_to_hmrc_date=date('Y-m-d', strtotime($_POST['sixtyfour_eight_to_hmrc_date']));
	}else{
		$sixtyfour_eight_to_hmrc_date = "";
	}
	$teledeclarant_number=$_POST['teledeclarant_number'];	
	$service_impots_particulier_password=$_POST['service_impots_particulier_password'];
	$cdi_address=$_POST['cdi_address'];

	// Notes Section Values
	$exact_no_of_note = $no_of_note = $_POST['no_of_note'];

	if(empty($individual_id) || empty($firstname) || empty($surname) || empty($client_id) || empty($dob)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{

		/* Check duplicate Client ID */

		$resultClientId = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE client_id = '$client_id' AND id != " . $individual_id);
		if($resultClientId->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate client id. Please check.'));
		}else{

			/* Exact No of Address */
			for($i=1; $i <= $no_of_address; $i++ ){
				if($_POST["is-exist-address".$i] == 0){
					$exact_no_of_address = $exact_no_of_address - 1;
				}
			}

			/* Exact No of Email */
			for($i=1; $i <= $no_of_email; $i++ ){
				if($_POST["is-exist-email".$i] == 0){
					$exact_no_of_email = $exact_no_of_email - 1;
				}
			}

			/* Exact No of Telephone */
			for($i=1; $i <= $no_of_telephone; $i++ ){
				if($_POST["is-exist-telephone".$i] == 0){
					$exact_no_of_telephone = $exact_no_of_telephone - 1;
				}
			}

			/* Exact No. of Note */
			for($i=1; $i <= $no_of_note; $i++ ){
				if($_POST["is-exist-note".$i] == 0){
					$exact_no_of_note = $exact_no_of_note - 1;
				}
			}

			$result = mysqli_query($db->db_conn, "UPDATE individuals
				SET 
				client_id = '$client_id',
				firstname = '$firstname',
				surname = '$surname',
				maiden_name = '$maiden_name',
				no_of_address = '$exact_no_of_address',
				country_id = '$country_id',
				no_of_email = '$exact_no_of_email',
				no_of_telephone = '$exact_no_of_telephone',
				dob = '$dob',
				place_of_birth = '$place_of_birth',
				date_of_death = '$date_of_death',
				nationality = '$nationality',
				passport_no = '$passport_no',
				marital_status = '$marital_status',
				date_of_marriage = '$date_of_marriage',
				place_of_marriage = '$place_of_marriage',
				active = '$active',
				on_stop = '$on_stop',
				engagement_start_date = '$engagement_start_date',
				engagement_end_date = '$engagement_end_date',

				p_firstname = '$p_firstname',
				p_surname = '$p_surname',
				p_maiden_name = '$p_maiden_name',
				p_address = '$p_address',
				p_postcode = '$p_postcode',
				p_country_id = '$p_country_id',
				p_email = '$p_email',
				p_telephone = '$p_telephone',
				p_dob = '$p_dob',
				p_place_of_birth = '$p_place_of_birth',
				p_date_of_death = '$p_date_of_death',
				p_nationality = '$p_nationality',
				p_passport_no = '$p_passport_no',

				national_insurance = '$national_insurance',
				uk_address = '$uk_address',
				uk_address_description = '$uk_address_description',
				payroll_required = '$payroll_required',
				paye_reference = '$paye_reference',
				paye_office_code = '$paye_office_code',
				first_tax_year_due = '$first_tax_year_due',
				requires_tax_return = '$requires_tax_return',
				utr = '$utr',
				vat_registered = '$vat_registered',
				business_commencement_date = '$business_commencement_date',
				other_paid_employment = '$other_paid_employment',
				first_year_p45_p60 = '$first_year_p45_p60',
				subsequent_years_p45_p60 = '$subsequent_years_p45_p60',
				fee = '$fee',
				fee_type = '$fee_type',
				reference = '$reference',
				uk_sixtyfour_eight_to_hmrc = '$uk_sixtyfour_eight_to_hmrc',
				uk_sixtyfour_eight_to_hmrc_date = '$uk_sixtyfour_eight_to_hmrc_date',

				social_security_no = '$social_security_no',
				siret_number = '$siret_number',
				business_regime = '$business_regime',
				f_business_commencement_date = '$f_business_commencement_date',
				f_business_end_date = '$f_business_end_date',
				f_first_tax_year_due ='$f_first_tax_year_due',
				f_fee = '$f_fee',
				f_prvious_address = '$f_prvious_address',
				fiscal_no_first = '$fiscal_no_first',
				fiscal_no_second = '$fiscal_no_second',
				fip_no = '$fip_no',
				fd5 = '$fd5',
				p85 = '$p85',
				nrl1 = '$nrl1',
				s1 = '$s1',
				sixtyfour_eight_to_hmrc = '$sixtyfour_eight_to_hmrc',
				fd5_date = '$fd5_date',
				p85_date = '$p85_date',
				nrl1_date = '$nrl1_date',
				s1_date = '$s1_date',
				sixtyfour_eight_to_hmrc_date = '$sixtyfour_eight_to_hmrc_date',
				teledeclarant_number = '$teledeclarant_number',
				service_impots_particulier_password = '$service_impots_particulier_password',
				cdi_address = '$cdi_address',

				no_of_note = '$exact_no_of_note'

				WHERE id =". $individual_id);	
				
				/* Update addresses table */
				for($a=1; $a <= $no_of_address; $a++ ){
					$address_exist_id = "address_id".$a;
					if(array_key_exists($address_exist_id, $_POST)){
						$address_id = $_POST["address_id".$a];
					}
					$address = $_POST["address".$a];
					$address_description = $_POST["address_description".$a];
					if(isset($_POST["address_id".$a])){
						if($_POST["is-exist-address".$a] == 1){
							$resultAddress = mysqli_query($db->db_conn, "UPDATE addresses
								SET								
									address = '$address',
									description = '$address_description'
								WHERE individual_id = '$individual_id' AND id =". $address_id);
						}else{
							$resultAddress = mysqli_query($db->db_conn, "DELETE FROM  addresses WHERE individual_id = '$individual_id' AND id = " . $address_id);
						}
					}else{
						if($_POST["is-exist-address".$a] == 1){
							$resultAddress = mysqli_query($db->db_conn, "INSERT INTO  addresses(individual_id,address,description) values('$individual_id','$address','$address_description')");
						}
					}
				}

				/* Update emails table */
				for($e=1; $e <= $no_of_email; $e++ ){
					$email_exist_id = "email_id".$e;
					if(array_key_exists($email_exist_id, $_POST)){
						$email_id = $_POST["email_id".$e];
					}
					$email = $_POST["email".$e];
					if(isset($_POST["email_id".$e])){
						if($_POST["is-exist-email".$e] == 1){
							$resultEmail = mysqli_query($db->db_conn, "UPDATE emails
								SET
									email = '$email'
								WHERE 
									individual_id = '$individual_id' AND id =". $email_id);
						}else{
							$resultEmail = mysqli_query($db->db_conn, "DELETE FROM  emails WHERE 
									individual_id = '$individual_id' AND id = " . $email_id);
						}
					}else{
						if($_POST["is-exist-email".$e] == 1){
							$resultEmail = mysqli_query($db->db_conn, "INSERT INTO  emails(individual_id,email) values('$individual_id','$email')");
						}
					}
				}

				/* Update telephones table */
				for($t=1; $t <= $no_of_telephone; $t++ ){
					$telephone_exist_id = "telephone_id".$t;
					if(array_key_exists($telephone_exist_id, $_POST)){
						$telephone_id = $_POST["telephone_id".$t];
					}
					$telephone = $_POST["telephone".$t];
					$telephone_description = $_POST["telephone_description".$t];
					if(isset($_POST["telephone_id".$t])){
						if($_POST["is-exist-telephone".$t] == 1){
							$resultTelephone = mysqli_query($db->db_conn, "UPDATE telephones
								SET
									telephone = '$telephone',
									description = '$telephone_description'
								WHERE 
									individual_id = '$individual_id' AND id =". $telephone_id);
						}else{
							$resultTelephone = mysqli_query($db->db_conn, "DELETE FROM  telephones 
								WHERE 
									individual_id = '$individual_id' AND id = " . $telephone_id);
						}
					}else{
						if($_POST["is-exist-telephone".$t] == 1){
							$resultTelephone = mysqli_query($db->db_conn, "INSERT INTO  telephones(individual_id,telephone,description) values('$individual_id','$telephone','$telephone_description')");
						}
					}
				}

				/* Update companies_directors table */
				if(isset($_POST['companyIds'])){
					if(count($companies_ids_array) > 0){						
						$resultCompanies = mysqli_query($db->db_conn, "DELETE FROM  companies_directors WHERE individual_id = " . $individual_id);
						foreach ($companies_ids_array as $company_id) {
							$resultCompanies = mysqli_query($db->db_conn, "INSERT INTO companies_directors(company_id, individual_id) VALUES('$company_id', '$individual_id')");
						}
					}else{
						$resultCompanies = mysqli_query($db->db_conn, "DELETE FROM  companies_directors WHERE individual_id = " . $individual_id);
					}
				}else{
					$resultCompanies = mysqli_query($db->db_conn, "DELETE FROM  companies_directors WHERE individual_id = " . $individual_id);
				}
				
				/* individuals_tax_return_years table data manupulation */
				$result1 = mysqli_query($db->db_conn, "SELECT * FROM  individuals_tax_return_years WHERE individual_id = ". $individual_id);
				if(mysqli_num_rows($result1) > 0){
					if(isset($_POST['tax_return_years'])){
						foreach($result1 as $result1){
	                        $previous_tax_return_years_string = $result1['tax_return_years'];
	                    }
						$tax_return_years_string = $previous_tax_return_years_string . "," . $tax_return_years_string;
						$result2 = mysqli_query($db->db_conn, "UPDATE  individuals_tax_return_years
							SET
							tax_return_years = '$tax_return_years_string'
							WHERE individual_id=".$individual_id);
					}/*else{
						$result2 = mysqli_query($db->db_conn, "DELETE  FROM individuals_tax_return_years WHERE individual_id=".$individual_id); 
					}*/

				}else{
					if(isset($tax_return_years_string)){
						$result2 = mysqli_query($db->db_conn, "INSERT INTO  individuals_tax_return_years(individual_id,tax_return_years) values($individual_id, '$tax_return_years_string')");
					}
				}
				
				/* individuals_tax_return_years_french table data manupulation */
				$result3 = mysqli_query($db->db_conn, "SELECT * FROM  individuals_tax_return_years_french WHERE individual_id = ". $individual_id);
				if(mysqli_num_rows($result3) > 0){
					if(isset($_POST['french_tax_return_years'])){
						foreach($result3 as $result3){
	                        $previous_french_tax_return_years_string = $result3['tax_return_years'];
	                    }
						$french_tax_return_years_string = $previous_french_tax_return_years_string . "," . $french_tax_return_years_string;
						$result4 = mysqli_query($db->db_conn, "UPDATE  individuals_tax_return_years_french
							SET
							tax_return_years = '$french_tax_return_years_string'
							WHERE individual_id=".$individual_id);
					}/*else{
						$result4 = mysqli_query($db->db_conn, "DELETE  FROM individuals_tax_return_years_french WHERE individual_id=".$individual_id); 
					}*/

				}else{
					if(isset($french_tax_return_years_string)){
						$result4 = mysqli_query($db->db_conn, "INSERT INTO  individuals_tax_return_years_french(individual_id,tax_return_years) values($individual_id, '$french_tax_return_years_string')");
					}
				}

				/* Update notes table */
				for($n=1; $n <= $no_of_note; $n++ ){
					$note_exist_id = "note_id".$n;
					if(array_key_exists($note_exist_id, $_POST)){
						$note_id = $_POST["note_id".$n];
					}
					$note_title = $_POST["note_title".$n];
					$note = $_POST["note".$n];
					
					// prepare to store special character in note  in database
					$note = mysqli_real_escape_string($db->db_conn, $note);

					if(isset($_POST["note_id".$n])){
						if($_POST["is-exist-note".$n] == 1){
							$resultNote = mysqli_query($db->db_conn, "UPDATE notes
								SET
									note_title = '$note_title',
									note = '$note'
								WHERE 
									individual_id = '$individual_id' AND id =". $note_id);
						}else{
							$resultNote = mysqli_query($db->db_conn, "DELETE FROM  notes 
								WHERE individual_id = $individual_id AND id = " . $note_id);
						}
					}else{
						if($_POST["is-exist-note".$n] == 1){						

							$note_creation_date = date('Y-m-d', strtotime($_POST["note_creation_date".$n]));

							$resultNote = mysqli_query($db->db_conn, "INSERT INTO  notes(individual_id,note,note_title,note_creation_date) values('$individual_id','$note_title','$note','$note_creation_date')");
						}
					}
				}

			if ($result) {
				echo json_encode(array('status'=>'success', 'message' => 'Individual has been successfully updated.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Individual updation error.'));
			}
		}
	}

}/* End Session Check */

?>