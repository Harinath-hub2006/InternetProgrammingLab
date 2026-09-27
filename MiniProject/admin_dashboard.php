<?php
require_once 'db.php';

// Access Control: Block non-admins
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$msg = "";
// Handle event creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_event'])) {
    $title = trim($_POST['title']);
    $cat = $_POST['category'];
    $desc = trim($_POST['description']);
    $date = $_POST['event_date'];
    $venue = trim($_POST['venue']);
    $type = $_POST['event_type'];
    $max_team = (int)$_POST['max_team_size'];

    $ins = $pdo->prepare("INSERT INTO events (title, category, description, event_date, venue, event_type, max_team_size) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $ins->execute([$title, $cat, $desc, $date, $venue, $type, $max_team]);
    $msg = "<div class='alert alert-success'>New event added successfully!</div>";
}

$events = $pdo->query("SELECT * FROM events ORDER BY event_date DESC")->fetchAll();

$report_stmt = $pdo->query("
    SELECT r.reg_id, u.full_name, u.email, e.title as event_title, r.registration_type, r.team_name, r.team_members, r.reg_date
    FROM registrations r
    JOIN users u ON r.student_id = u.user_id
    JOIN events e ON r.event_id = e.event_id
    ORDER BY r.reg_date DESC
");
$registrations = $report_stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Admin Control Panel</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Administrator Control Panel</h2>
        <br>
        <?php echo $msg; ?>

        <div class="grid">
            <div class="card">
                <h3>Create New Event</h3>
                <form method="POST">
                    <input type="hidden" name="create_event" value="1">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select name="category" required>
                            <option value="Technical">Technical</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Sports">Sports</option>
                            <option value="Workshop">Workshop</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" name="event_date" required>
                    </div>
                    <div class="form-group">
                        <label>Venue:</label>
                        <input type="text" name="venue" required>
                    </div>
                    <div class="form-group">
                        <label>Entry Type:</label>
                        <select name="event_type" required>
                            <option value="single">Single</option>
                            <option value="team">Team</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Max Team Members (if team):</label>
                        <input type="number" name="max_team_size" value="1">
                    </div>
                    <button type="submit" style="width:100%;">Publish Event</button>
                </form>
            </div>

            <div class="card" style="grid-column: span 2;">
                <h3>Participant Registration Report</h3>
                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Event</th>
                                <th>Type</th>
                                <th>Team Name / Members</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($registrations as $r): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($r['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($r['email']); ?></td>
                                    <td><?php echo htmlspecialchars($r['event_title']); ?></td>
                                    <td><span class="badge <?php echo $r['registration_type']==='team'?'badge-team':'badge-single'; ?>"><?php echo strtoupper($r['registration_type']); ?></span></td>
                                    <td>
                                        <?php if($r['registration_type']==='team'): ?>
                                            <strong><?php echo htmlspecialchars($r['team_name']); ?></strong><br>
                                            <small><?php echo htmlspecialchars($r['team_members']); ?></small>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>