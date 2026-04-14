<?php
// Yeni bir destek talebi oluşturur ve veritabanına kaydeder
include 'auth_check.php';
include 'db.php';

$created_by = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $category = trim($_POST["category"]);
    $priority = trim($_POST["priority"]);
    $created_by = $_SESSION['user_id'];

    if (empty($title) || empty($description) || empty($category) || empty($priority)) {
        echo "All fields are required.";
        exit;
    }

    $sql = "INSERT INTO tickets (title, description, category, priority, created_by) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);  
    
    if (!$stmt) {
        die("SQL prepare error: " . $conn->error);
    } 
    $stmt->bind_param("ssssi", $title, $description, $category, $priority, $created_by);

    if ($stmt->execute()){
        if ($_SESSION['role'] === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: my_tickets.php");
        }
        exit;   
    } else {
        echo "Form is not submitted: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>