<?php

$resultIndividualsUtr = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE UTR = ''");
$no_of_individuals_utr = $resultIndividualsUtr->num_rows;

?>