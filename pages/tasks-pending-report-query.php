<?php

if(isset($_REQUEST['task_completion_month'])){
    $task_completion_month = $_REQUEST['task_completion_month'];
}else{
    $task_completion_month = date('m');
}

$query = "SELECT * FROM tasks WHERE is_task_completed = 'No' AND task_action_date LIKE '%-".$task_completion_month."-%'";

$resultTasksPendingPage = mysqli_query($db->db_conn, $query);

$resultTasksPendingHeader = mysqli_query($db->db_conn, $query);

$resultTasksPendingIndexPage = mysqli_query($db->db_conn, $query);

$no_of_tasks_pending = $resultTasksPendingPage->num_rows;

?> 