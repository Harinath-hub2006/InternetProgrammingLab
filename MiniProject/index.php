<?php
require_once 'db.php';
$latest = $pdo->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 3")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Home - College Event Management</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="hero">
            <h1>Welcome to Campus Events Portal</h1>
            <p>Discover technical symposiums, cultural fests, workshops, and sports tournaments in one place.</p>
            <br>
            <a href="events.php" class="btn">Explore All Events</a>
        </div>

        <h2>Upcoming Featured Events</h2>
        <br>
        <div class="grid">
            <?php if(count($latest) > 0): ?>
                <?php foreach($latest as $e): ?>
                    <div class="card">
                        <span class="badge <?php echo $e['event_type']==='team'?'badge-team':'badge-single'; ?>">
                            <?php echo strtoupper($e['event_type']); ?> ENTRY
                        </span>
                        <h3 style="margin-top:10px;"><?php echo htmlspecialchars($e['title']); ?></h3>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($e['category']); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($e['event_date']); ?></p>
                        <p><strong>Venue:</strong> <?php echo htmlspecialchars($e['venue']); ?></p>
                        <br>
                        <a href="enroll.php?id=<?php echo $e['event_id']; ?>" class="btn" style="width:100%; text-align:center;">Register Now</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No upcoming events available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>