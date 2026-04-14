<?php
//Seçilen destek talebinin detaylarını gösterir ve durumunu güncellemek için bir form içerir.
include 'admin_check.php';
include 'db.php';
if (!isset($_GET['id'])) {
    echo "Destek talebi ID'si gereklidir.";
    exit;
}
$id = (int)$_GET['id'];

if ($id <= 0) {
    echo "Geçersiz destek talebi ID'si.";
    exit;
}

$sql = "SELECT id, title, description, priority, category, status, created_at, created_by, resolution_note 
FROM tickets 
WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {  
    exit("Sorgu hatası: " . $stmt->error);
}
$result = $stmt->get_result();

if (!$result) {
    exit("Sonuç bulunamadı " . $conn->error);
}   

$ticket = $result->fetch_assoc();

if (!$ticket) {
    echo "İstek bulunamadı.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div align="center">
        <div class="detail-box">
            <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
                <div class="success-message">
                    Ticket updated successfully.
                </div>
                <script>
                    setTimeout(function () {
                        window.location.href = "list_tickets.php";
                    }, 3000);
            </script>
            <?php endif; ?>
            <div class="page-top-actions">
                <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
            </div>
            <!-- Destek talebinin detaylarını göster -->
            <h1>ID Number: <?php echo $ticket['id']; ?></h1>
            <h2>Ticket Details</h2>

            <div class="detail-row">
                <p><strong>Title:</strong> <?php echo $ticket['title']; ?></p>
                <div>
                    
                    <div class="detail-label">Description:
                        <span class="detail-description">
                            <?php echo htmlspecialchars($ticket['description']); ?>
                        </span>
                    </div>
                </div>
                <p><strong>Priority:</strong> <?php echo $ticket['priority']; ?></p>
                <p><strong>Category:</strong> <?php echo $ticket['category']; ?></p>
                <p><strong>Status:</strong> <?php echo $ticket['status']; ?></p>
                <p><strong>Created At:</strong> <?php echo $ticket['created_at']; ?></p>
                <p><strong>Created By:</strong> <?php echo $ticket['created_by']; ?></p>
            </div>


            <!-- Destek talebinin durumunu güncellemek için form -->
            <h1>UPDATE TICKET</h1>
            <form action="update_ticket.php" method="post">  
                <input type="hidden" name="id" value="<?php echo $ticket['id']; ?>">
                <div class="detail-label">
                    <label for="status">Status:</label>
                </div>
                <select name="status" id="status"; ?>">
                    <option value="Open" <?php if ($ticket['status'] == 'Open') echo 'selected'; ?>>Open</option>
                    <option value="In Progress" <?php if ($ticket['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                    <option value="Resolved" <?php if ($ticket['status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                    <option value="Closed" <?php if ($ticket['status'] == 'Closed') echo 'selected'; ?>>Closed</option>
                </select>
                <br><br>
                <div class="detail-label">
                    <label for="resolution_note" class="">Resolution Note</label>
                </div>
                <textarea id="resolution_note" name="resolution_note" maxlength="255"><?php echo htmlspecialchars($ticket['resolution_note'] ?? ''); ?></textarea>
                <br><br>
                <button type="submit">Update Ticket</button>
            </form>
        </div>
    </div>    
</body> 
</html>