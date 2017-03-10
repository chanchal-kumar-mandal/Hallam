<?php

$resultIndividualsPending = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE requires_tax_return = 'No' AND on_stop = 'No' AND first_tax_year_due < '$current_tax_year' AND id NOT IN (SELECT individuals.id as id FROM individuals INNER JOIN individuals_tax_return_years ON individuals.id = individuals_tax_return_years.individual_id WHERE individuals_tax_return_years.tax_return_years LIKE '%".$latest_tax_year."%')" );
$no_of_individuals_pending = $resultIndividualsPending->num_rows;

?>