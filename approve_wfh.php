<?php
require_once ('process/dbh.php');

$wfh_id = $_GET['wfh_id'];
$action = $_GET['action'];

$status = ($action == 'approve') ? 'Approved' : 'Rejected';

$sql = "UPDATE work_from_home SET status = '$status' WHERE wfh_id = '$wfh_id'";

if (mysqli_query($conn, $sql)) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('WFH Request " . ucfirst($status) . " Successfully')
        window.location.href='aloginwel.php';
        </SCRIPT>");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
