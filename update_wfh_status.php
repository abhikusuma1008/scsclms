<?php
require_once('process/dbh.php');

$sql = "SELECT wfh.*, e.firstName, e.lastName FROM work_from_home wfh JOIN employee e ON wfh.employee_id = e.id WHERE wfh.status = 'Pending'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approve Work From Home Requests</title>
    <link rel="stylesheet" type="text/css" href="styleview1.css">
    <link rel="stylesheet" type="text/css" href="styleindex3.css">
</head>
<body>
    <header>
        <nav>
            <div class="header-logo">
                <img src="https://cyberabadsecuritycouncil.org/wp-content/themes/scsc/images/scsc-logo-1.svg" alt="Company Logo">
                <h1>EMS</h1>
                <ul id="navli">
                    <li><a class="homeblack" href="aloginwel.php">HOME</a></li>
                    <li><a class="homeblack" href="addemp.php">Add Employee</a></li>
                    <li><a class="homeblack" href="viewemp.php">View Employee</a></li>
                    <li><a class="homeblack" href="assign.php">Assign Project</a></li>
                    <li><a class="homeblack" href="assignproject.php">Project Status</a></li>
                    <li><a class="homeblack" href="salaryemp.php">Salary Table</a></li>
                    <li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
                    <li><a class="homered" href="update_wfh_status.php">WFH</a></li>
                    <li><a class="homeblack" href="alogin.html">Log Out</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="divider"></div>
    <div id="divimg">
        <h2>Pending Work From Home Requests</h2>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Deliverables</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['employee_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['deliverables']); ?></td>
                    <td>
                        <a href="approve_wfh.php?wfh_id=<?php echo $row['wfh_id']; ?>&action=approve" onClick="return confirm('Are you sure you want to approve this request?')">Approve</a> |
                        <a href="approve_wfh.php?wfh_id=<?php echo $row['wfh_id']; ?>&action=reject" onClick="return confirm('Are you sure you want to reject this request?')">Reject</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
