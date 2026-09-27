<nav class="navbar">
    <div class="nav-brand">🎓 College Event Portal</div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="events.php">Browse Events</a></li>
        <li><a href="contact.php">Contact & Feedback</a></li>
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['role'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php" style="color: #38bdf8; font-weight: bold;">Admin Panel</a></li>
            <?php else: ?>
                <li><a href="student_dashboard.php">My Dashboard</a></li>
            <?php endif; ?>
            <li><a href="logout.php" class="btn-nav-logout">Logout (<?php echo htmlspecialchars($_SESSION['full_name']); ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php" class="btn-nav">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>