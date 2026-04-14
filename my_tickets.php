<?php
include 'auth_check.php';
include 'db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, title, priority, category, status, created_at 
        FROM tickets 
        WHERE created_by = ?
        ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL prepare error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="page-top-actions">
            <a href="create_ticket.php" class="back-link">Create New Ticket</a>
        </div>
        <h2>My Support Tickets</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            
                <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php
                            $priorityClass = '';

                            if ($row['priority'] == 'Low') {
                                $priorityClass = 'priority-low';
                            } elseif ($row['priority'] == 'Medium') {
                                $priorityClass = 'priority-medium';
                            } elseif ($row['priority'] == 'High') {
                                $priorityClass = 'priority-high';
                            }

                            $statusClass = '';

                            if ($row['status'] == 'Open') {
                                $statusClass = 'status-open';
                            } elseif ($row['status'] == 'In Progress') {
                                $statusClass = 'status-progress';
                            } elseif ($row['status'] == 'Resolved') {
                                $statusClass = 'status-resolved';
                            } elseif ($row['status'] == 'Closed') {
                                $statusClass = 'status-closed';
                            }
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td>
                                    <span class="priority-badge <?php echo $priorityClass; ?>">
                                        <?php echo $row['priority']; ?>
                                    </span>
                                </td>
                                <td><?php echo $row['category']; ?></td>
                                <td>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>You have not created any tickets yet.</p>
                <a href="create_ticket.php" class="dashboard-link">Create a new ticket</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>