<?php
require_once 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT r.*, e.title, e.event_date, e.venue, e.category
    FROM registrations r
    JOIN events e ON r.event_id = e.event_id
    WHERE r.student_id = ?
    ORDER BY e.event_date ASC
");
$stmt->execute([$student_id]);
$my_events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Student Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?></h2>
        <p style="color:#64748b;">Manage your registered events and team submissions.</p>
        <br>

        <div class="card">
            <h3>My Registered Events</h3>
            <?php if(count($my_events) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Event Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Type</th>
                            <th>Team Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($my_events as $row): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($row['title']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['venue']); ?></td>
                                <td><span class="badge <?php echo $row['registration_type']==='team'?'badge-team':'badge-single'; ?>"><?php echo strtoupper($row['registration_type']); ?></span></td>
                                <td>
                                    <?php if($row['registration_type'] === 'team'): ?>
                                        <strong><?php echo htmlspecialchars($row['team_name']); ?></strong><br>
                                        <small><?php echo htmlspecialchars($row['team_members']); ?></small>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have not registered for any events yet. <a href="events.php">Browse events here</a>.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>