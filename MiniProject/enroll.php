<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$event_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

if (!$event) {
    die("Event not found.");
}

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['user_id'];
    $reg_type = $event['event_type'];
    $team_name = $_POST['team_name'] ?? null;
    $team_members = $_POST['team_members'] ?? null;

    // Check duplicate enrollment
    $chk = $pdo->prepare("SELECT reg_id FROM registrations WHERE student_id = ? AND event_id = ?");
    $chk->execute([$student_id, $event_id]);
    if ($chk->fetch()) {
        $msg = "<div class='alert alert-danger'>You are already enrolled in this event!</div>";
    } else {
        $ins = $pdo->prepare("INSERT INTO registrations (student_id, event_id, registration_type, team_name, team_members) VALUES (?, ?, ?, ?, ?)");
        $ins->execute([$student_id, $event_id, $reg_type, $team_name, $team_members]);
        $msg = "<div class='alert alert-success'>Registration successful! <a href='student_dashboard.php'>View My Registrations</a></div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Enrollment</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let type = "<?php echo $event['event_type']; ?>";
            if (type === 'team') {
                let teamName = document.forms["regForm"]["team_name"].value.trim();
                let members = document.forms["regForm"]["team_members"].value.trim();
                if (teamName === "" || members === "") {
                    alert("Please fill in Team Name and Member details.");
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container" style="max-width:600px;">
        <div class="card">
            <h2>Enroll in <?php echo htmlspecialchars($event['title']); ?></h2>
            <p style="color:#64748b; margin-top:5px;"><?php echo htmlspecialchars($event['description']); ?></p>
            <hr style="margin: 15px 0; border: none; border-top: 1px solid #e2e8f0;">

            <?php echo $msg; ?>

            <form name="regForm" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>Participant Name:</label>
                    <input type="text" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Registration Format:</label>
                    <input type="text" value="<?php echo strtoupper($event['event_type']); ?>" disabled>
                </div>

                <?php if($event['event_type'] === 'team'): ?>
                    <div class="form-group">
                        <label>Team Name *:</label>
                        <input type="text" name="team_name" placeholder="Enter your team name">
                    </div>
                    <div class="form-group">
                        <label>Team Members Details (Names & Reg IDs) *:</label>
                        <textarea name="team_members" rows="3" placeholder="Max <?php echo $event['max_team_size']; ?> members. E.g., John (101), Jane (102)"></textarea>
                    </div>
                <?php endif; ?>

                <button type="submit" style="width:100%;">Confirm & Register</button>
            </form>
        </div>
    </div>
</body>
</html>