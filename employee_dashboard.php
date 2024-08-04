<?php
$id = (isset($_GET['id']) ? $_GET['id'] : '');
require_once('process/dbh.php');

// Assuming $employee_id is set to $id from the GET parameter.
$employee_id = $id;

// Fetch the WFH requests for the logged-in employee
$stmt = $conn->prepare("SELECT * FROM work_from_home WHERE employee_id = ?");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styleview.css">
    <link rel="stylesheet" type="text/css" href="styleindex3.css">
</head>
<body>
    <header>
        <nav>
            <div class="header-logo">
                <img src="https://cyberabadsecuritycouncil.org/wp-content/themes/scsc/images/scsc-logo-1.svg" alt="Company Logo">
                <h1>EMS</h1>
                <ul id="navli">
                    <li><a class="homeblack" href="employee_dashboard.php?id=<?php echo $id; ?>">Home</a></li>
                    <li><a class="homeblack" href="myprofile.php?id=<?php echo $id; ?>">My Profile</a></li>
                <li><a class="homeblack" href="empproject.php?id=<?php echo $id; ?>">My Projects</a></li>
                <li><a class="homeblack" href="employee_dashboard.php?id=<?php echo $id; ?>">WFH</a></li>
                <li><a class="homeblack" href="applyleave.php?id=<?php echo $id; ?>">Apply Leave</a></li>
                    <li><a class="homeblack" href="elogin.html">Log Out</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="divider"></div>

    <form action="submit_wfh.php" method="post">
        <label for="employee_id">Employee ID:</label>
        <input type="number" id="employee_id" name="employee_id" value="<?php echo htmlspecialchars($employee_id); ?>"><br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <label for="deliverables">Deliverables:</label>
        <textarea id="deliverables" name="deliverables" required></textarea><br><br>

        <input type="submit" name="submit_wfh" value="Submit">
    </form>

    <h2>Your Work From Home Requests</h2>
    <table border="1">
        <tr>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Deliverables</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                <td><?php echo htmlspecialchars($row['deliverables']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
