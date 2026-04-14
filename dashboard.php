<?php
include 'admin_check.php';
include 'db.php';

$total_tickets = $conn->query("SELECT COUNT(*) AS total FROM tickets");
$open_tickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status = 'Open'");
$in_progress_tickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status = 'In Progress'");
$resolved_tickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status = 'Resolved'");
$closed_tickets = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE status  = 'Closed'"); 

$total_results = $total_tickets->fetch_assoc();
$open_results = $open_tickets->fetch_assoc();
$in_progress_results = $in_progress_tickets->fetch_assoc();
$resolved_results = $resolved_tickets->fetch_assoc();
$closed_results = $closed_tickets->fetch_assoc();



if (!$total_results) {
    $total_count = 0;
} else {
    $total_count = $total_results['total'];
}

if (!$open_results) {
    $open_count = 0;
} else {
    $open_count = $open_results['total'];
}

if (!$in_progress_results) {
    $in_progress_count = 0;
} else {
    $in_progress_count = $in_progress_results['total'];
}

if (!$resolved_results) {
    $resolved_count = 0;
} else {
    $resolved_count = $resolved_results['total'];
}

if (!$closed_results) {
    $closed_count = 0;
} else {
    $closed_count = $closed_results['total'];
}

?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>

</head>
<body>
    <?php include 'header.php'; ?>
    <div class="dashboard-container">
            <h1>Dashboard</h1>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3 class="dashboard-title">Total Tickets</h3>
                    <p class="dashboard-value"><?php echo $total_count; ?></p>
                </div>
                <div class="dashboard-card">
                    <h3 class="dashboard-title">Open Tickets</h3>
                    <p class="dashboard-value"><?php echo $open_count; ?></p>
                </div>
                <div class="dashboard-card">
                    <h3 class="dashboard-title">In Progress Tickets</h3>
                    <p class="dashboard-value"><?php echo $in_progress_count; ?></p>
                </div>
                <div class="dashboard-card">
                    <h3 class="dashboard-title">Resolved Tickets</h3>
                    <p class="dashboard-value"><?php echo $resolved_count; ?></p>
                </div>
                <div class="dashboard-card">
                    <h3 class="dashboard-title">Closed Tickets</h3>
                    <p class="dashboard-value"><?php echo $closed_count; ?></p>
                </div>
            </div>

            <div class="dashboard-actions">
                  <a href="list_tickets.php">All Tickets</a>
            </div>
    </div>
</body>    

</html>