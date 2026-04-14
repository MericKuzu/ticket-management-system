<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="top-bar">
    <div class="top-bar-left">
        <?php if (isset($_SESSION['full_name'])): ?>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?></p>
        <?php endif; ?>
    </div>

    <div class="top-bar-right">
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</div>