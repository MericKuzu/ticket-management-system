<?php
include 'admin_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method.";
    exit;
}

if (!isset($_POST['id'])) {
    echo "Ticket ID is required.";
    exit;
}
$id = (int)$_POST['id'];

if ($id <= 0) {
    echo "Invalid ticket ID.";
    exit;
}

if (!isset($_POST['status'])) {
    echo "Status is required.";
    exit;
}
$status = trim($_POST['status']);

if (empty($status)) {
    echo "Status cannot be empty.";
    exit;
}

$resolution_note = isset($_POST['resolution_note']) ? trim($_POST['resolution_note']) : '';

$allowed_statuses = ['Open', 'In Progress', 'Resolved', 'Closed'];

if (!in_array($status, $allowed_statuses)) {
    echo "Invalid status value.";
    exit;
}
$sql = "UPDATE tickets
        SET status = ?, resolution_note = ? 
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo("SQL prepare error: " . $conn->error);
    exit;
}
$stmt->bind_param("ssi", $status, $resolution_note, $id);

if ($stmt->execute()) {
    header("Location: ticket_detail.php?id=" . $id . "&updated=1");
    exit;
} else {
    echo "Error updating ticket: " . $stmt->error;
}
$stmt->close();
$conn->close();


?>