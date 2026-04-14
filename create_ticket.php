<?php
include 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
<!-- Yeni bir destek talebi oluşturmak için form sayfası -->
    <div class="container"> 
        <center><h1>Create Ticket</h1></center>
        <form action="store_ticket.php" method="post">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
            <br>
        <br>
        <div class="create-ticket-label">
            <label for="description">Description</label>
        </div>
            <textarea id="description" name="description" required></textarea>
        <br>
        <br>

        <label for="category">Category</label> <br>
        <select id="category" name="category">
            <option value="Hardware">Hardware</option>
            <option value="Software">Software</option>
            <option value="Network">Network</option>
            <option value="Account">Account</option>
            <option value="Other">Other</option>
        </select><br><br>
        <div class="form-group">
            <label for="priority">Priority</label>
            <select id="priority" name="priority">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <br>
        <br>
        
        <input type="hidden" name="created_by" value="<?php echo $_SESSION['user_id']; ?>">
        

        <button type="submit">Submit Ticket</button>
    </form>
    
</body>
</html>