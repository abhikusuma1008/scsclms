<?php
require_once ('process/dbh.php');

if (isset($_POST['submit_wfh'])) {
    $employee_id = $_POST['employee_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $deliverables = $_POST['deliverables'];

    // Check if employee_id exists
    $check_sql = "SELECT * FROM employee WHERE id = '$employee_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $sql = "INSERT INTO work_from_home (employee_id, start_date, end_date, deliverables) VALUES ('$employee_id', '$start_date', '$end_date', '$deliverables')";

        if (mysqli_query($conn, $sql)) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('WFH Request Submitted Successfully')
                window.location.href='employee_dashboard.php?id=$employee_id';
                </SCRIPT>");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Invalid Employee ID')
            window.location.href='employee_dashboard.php?id=$employee_id';
            </SCRIPT>");
    }
}
?>
