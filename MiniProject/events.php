<?php
require_once 'db.php';
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$query = "SELECT * FROM events WHERE 1=1";
$params = [];

if ($search !== '') {
    $query .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($category !== '') {
    $query .= " AND category = ?";
    $params[] = $category;
}
$query .= " ORDER BY event_date ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Browse Events</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>All College Events</h2>
        <br>
        <form method="GET" class="card" style="display:flex; gap:15px; align-items:flex-end;">
            <div class="form-group" style="flex:2; margin:0;">
                <label>Search Event:</label>
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search title or description...">
            </div>
            <div class="form-group" style="flex:1; margin:0;">
                <label>Category:</label>
                <select name="category">
                    <option value="">All Categories</option>
                    <option value="Technical" <?php echo $category==='Technical'?'selected':''; ?>>Technical</option>
                    <option value="Cultural" <?php echo $category==='Cultural'?'selected':''; ?>>Cultural</option>
                    <option value="Sports" <?php echo $category==='Sports'?'selected':''; ?>>Sports</option>
                    <option value="Workshop" <?php echo $category==='Workshop'?'selected':''; ?>>Workshop</option>
                </select>
            </div>
            <button type="submit">Filter</button>
        </form>

        <br>
        <div class="grid">
            <?php foreach($events as $e): ?>
                <div class="card">
                    <span class="badge <?php echo $e['event_type']==='team'?'badge-team':'badge-single'; ?>">
                        <?php echo strtoupper($e['event_type']); ?>
                    </span>
                    <h3 style="margin-top:10px;"><?php echo htmlspecialchars($e['title']); ?></h3>
                    <p style="color:#64748b; font-size:0.9rem; margin-bottom:10px;"><?php echo htmlspecialchars($e['description']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($e['event_date']); ?></p>
                    <p><strong>Venue:</strong> <?php echo htmlspecialchars($e['venue']); ?></p>
                    <br>
                    <a href="enroll.php?id=<?php echo $e['event_id']; ?>" class="btn" style="width:100%; text-align:center;">Enroll</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>