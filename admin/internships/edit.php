<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';

if (!is_admin()) {
    redirect('/admin/login.php');
}

$internship_id = (int)$_GET['id'];
$query = "SELECT * FROM internships WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $internship_id);
$stmt->execute();
$internship = $stmt->get_result()->fetch_assoc();

if (!$internship) {
    redirect('/admin/internships/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $description = sanitize_input($_POST['description']);
    $requirements = sanitize_input($_POST['requirements']);
    $duration = sanitize_input($_POST['duration']);
    $type = sanitize_input($_POST['type']);
    $status = sanitize_input($_POST['status']);
    
    $query = "UPDATE internships SET title = ?, description = ?, requirements = ?, duration = ?, type = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $title, $description, $requirements, $duration, $type, $status, $internship_id);
    
    if ($stmt->execute()) {
        redirect('/admin/internships/');
    } else {
        $error = "Failed to update internship listing";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Internship - TechBao Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/jobs/">
                                Manage Jobs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/internships/">
                                Manage Internships
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/applications/">
                                View Applications
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Internship</h1>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="title" class="form-label">Internship Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($internship['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($internship['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="requirements" class="form-label">Requirements</label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="5" required><?php echo htmlspecialchars($internship['requirements']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="<?php echo htmlspecialchars($internship['duration']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="online" <?php echo $internship['type'] === 'online' ? 'selected' : ''; ?>>Online</option>
                            <option value="offline" <?php echo $internship['type'] === 'offline' ? 'selected' : ''; ?>>Offline</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="open" <?php echo $internship['status'] === 'open' ? 'selected' : ''; ?>>Open</option>
                            <option value="closed" <?php echo $internship['status'] === 'closed' ? 'selected' : ''; ?>>Closed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Internship</button>
                    <a href="/admin/internships/" class="btn btn-secondary">Cancel</a>
                </form>
            </main>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>