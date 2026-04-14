<?php
// Bütün destek taleplerini listeler
include 'admin_check.php';
include 'db.php';

$sql = "SELECT id,title, priority, category, status, created_at, created_by 
FROM tickets
ORDER BY id DESC";

$result = $conn->query($sql);
if (!$result) {
    exit("Error fetching tickets: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <title>Ticket List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    
        <h1>All Tickets</h1>
        <div class="table-top-bar">
            <div class="page-top-actions">
                <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
            </div>
        </div>
   
    

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Details</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                $priorityClass = '';
                if ($row['priority'] === 'Low') {
                    $priorityClass = 'priority-low';
                } elseif ($row['priority'] === 'Medium') {
                    $priorityClass = 'priority-medium';
                } elseif ($row['priority'] === 'High') {
                    $priorityClass = 'priority-high';
                }
                ?>

                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["title"]); ?></td>
                    <td>
                        <span class="priority-badge <?php echo $priorityClass; ?>">
                            <?php echo $row["priority"]; ?>
                        </span>
                    </td>
                    <td ><?php echo $row["category"]; ?></td>
                    <td ><?php echo $row["status"]; ?></td>
                    <td><?php echo $row["created_by"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td><a href="ticket_detail.php?id=<?php echo $row["id"]; ?>" class="table-link">View Details</a></td>
                </tr>
            <?php  endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Ticket requests not found.</td>
            </tr>
        <?php endif; ?>

    </table>
</body>