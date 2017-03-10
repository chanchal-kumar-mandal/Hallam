<?php

header('Content-type: application/json');

/* Session Check */
session_start();
if(empty($_SESSION["username"])){
    echo json_encode(array('status'=>'fail', 'message' => 'Please login'));
}else{
	require_once('dbconnection.php');

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
	$p_passport_no=$_POST['p_passport_no'];
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


	if(empty($firstname) || empty($surname) || empty($client_id) || empty($dob)) {	
		echo json_encode(array('status'=>'fail', 'message' => 'Please insert all required fields.'));
	}else{

		/* Check duplicate Client ID */

		$resultClientId = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE client_id = '$client_id'");
		if($resultClientId->num_rows > 0){
			echo json_encode(array('status'=>'fail', 'message' => 'Duplicate client id. Please check.'));
		}else{


			/* Exact No. of Address */
			for($i=1; $i <= $no_of_address; $i++ ){
				if($_POST["is-exist-address".$i] == 0){
					$exact_no_of_address = $exact_no_of_address - 1;
				}
			}

			/* Exact No. of Email */
			for($i=1; $i <= $no_of_email; $i++ ){
				if($_POST["is-exist-email".$i] == 0){
					$exact_no_of_email = $exact_no_of_email - 1;
				}
			}

			/* Exact No. of Telephone */
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

			$result = mysqli_query($db->db_conn, "INSERT INTO  individuals(
				client_id,firstname,surname,maiden_name,no_of_address,country_id,no_of_email,no_of_telephone,dob,place_of_birth,date_of_death,nationality,passport_no,marital_status,date_of_marriage,place_of_marriage,active,on_stop,engagement_start_date,engagement_end_date,
				p_firstname,p_surname,p_maiden_name,p_address,p_postcode,p_country_id,p_email,p_telephone,p_dob,p_place_of_birth,p_date_of_death,p_nationality,p_passport_no,
				national_insurance,uk_address,uk_address_description,payroll_required,paye_reference,paye_office_code,first_tax_year_due,utr,vat_registered,business_commencement_date,other_paid_employment,first_year_p45_p60,subsequent_years_p45_p60,fee,fee_type,reference,uk_sixtyfour_eight_to_hmrc,uk_sixtyfour_eight_to_hmrc_date,
				social_security_no,siret_number,business_regime,f_business_commencement_date,f_business_end_date,f_first_tax_year_due,f_fee,f_prvious_address,fiscal_no_first,fiscal_no_second,fip_no,fd5,p85,nrl1,s1,sixtyfour_eight_to_hmrc,fd5_date,p85_date,nrl1_date,s1_date,sixtyfour_eight_to_hmrc_date,teledeclarant_number,service_impots_particulier_password,cdi_address,
				no_of_note) 

				values(
				'$client_id','$firstname','$surname','$maiden_name','$exact_no_of_address','$country_id','$exact_no_of_email','$exact_no_of_telephone','$dob','$place_of_birth','$date_of_death','$nationality','$passport_no','$marital_status','$date_of_marriage','$place_of_marriage','$active','$on_stop','$engagement_start_date','$engagement_end_date',
				'$p_firstname','$p_surname','$p_maiden_name','$p_address','$p_postcode','$p_country_id','$p_email','$p_telephone','$p_dob','$p_place_of_birth','$p_date_of_death','$p_nationality','$p_passport_no',
				'$national_insurance','$uk_address','$uk_address_description','$payroll_required','$paye_reference','$paye_office_code','$first_tax_year_due','$utr','$vat_registered','$business_commencement_date','$other_paid_employment','$first_year_p45_p60','$subsequent_years_p45_p60','$fee','$fee_type','$reference','$uk_sixtyfour_eight_to_hmrc','$uk_sixtyfour_eight_to_hmrc_date',
				'$social_security_no','$siret_number','$business_regime','$f_business_commencement_date','$f_business_end_date','$f_first_tax_year_due','$f_fee','$f_prvious_address','$fiscal_no_first','$fiscal_no_second','$fip_no','$fd5','$p85','$nrl1','$s1','$sixtyfour_eight_to_hmrc','$fd5_date','$p85_date','$nrl1_date','$s1_date','$sixtyfour_eight_to_hmrc_date','$teledeclarant_number','$service_impots_particulier_password','$cdi_address',
				'$exact_no_of_note'
				)");

			$resultOfLastIndividual = mysqli_query($db->db_conn, "SELECT max(id) AS id FROM individuals");
				while($row = $resultOfLastIndividual->fetch_array()){
					$individual_id = $row['id'];
				}

			if ($result) {	

				/* Insert in addresses table */
				for($i=1; $i <= $no_of_address; $i++ ){
					$address = $_POST["address".$i];
					$address_description = $_POST["address_description".$i];
					if($_POST["is-exist-address".$i] == 1){
						$resultAddress = mysqli_query($db->db_conn, "INSERT INTO  addresses(individual_id,address,description) values('$individual_id','$address','$address_description')");
					}
				}	

				/* Insert in emails table */
				for($i=1; $i <= $no_of_email; $i++ ){
					$email = $_POST["email".$i];
					if($_POST["is-exist-email".$i] == 1){
						$resultEmail = mysqli_query($db->db_conn, "INSERT INTO  emails(individual_id,email) values('$individual_id','$email')");
					}
				}	

				/* Insert in telephones table */
				for($i=1; $i <= $no_of_telephone; $i++ ){
					$telephone = $_POST["telephone".$i];
					$telephone_description = $_POST["telephone_description".$i];
					if($_POST["is-exist-telephone".$i] == 1){
						$resultTelephone = mysqli_query($db->db_conn, "INSERT INTO  telephones(individual_id,telephone,description) values('$individual_id','$telephone','$telephone_description')");
					}
				}

				/* Insert into companies_directors table */
				if(isset($_POST['companyIds'])){
					if(count($companies_ids_array) > 0){
						foreach ($companies_ids_array as $company_id) {
							$resultCompany = mysqli_query($db->db_conn, "INSERT INTO companies_directors(company_id, individual_id) VALUES('$company_id', '$individual_id')");
						}
					}
				}	

				/* Insert in notes table */
				for($n=1; $n <= $no_of_note; $n++ ){
					$note_title = $_POST["note_title".$n];
					$note = $_POST["note".$n];

					// prepare to store special character in note  in database
					$note = mysqli_real_escape_string($db->db_conn, $note);

					$note_creation_date = date('Y-m-d', strtotime($_POST["note_creation_date".$n]));
					if($_POST["is-exist-note".$n] == 1){
						$resultNote = mysqli_query($db->db_conn, "INSERT INTO  notes(individual_id,note_title,note,note_creation_date) values('$individual_id','$note_title','$note','$note_creation_date')");
					}
				}

				echo json_encode(array('status'=>'success', 'message' => 'Individual has been successfully added.'));
			} else {
				echo json_encode(array('status'=>'fail', 'message' => 'Individual insertion error.'));
			}
		}
	}

}/* End Session Check */

?>