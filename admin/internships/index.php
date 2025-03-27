<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';

if (!is_admin()) {
    redirect('/admin/login.php');
}

// Handle internship deletion
if (isset($_GET['delete'])) {
    $internship_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM internships WHERE id = $internship_id");
    redirect('/admin/internships/');
}

// Get all internships
$query = "SELECT * FROM internships ORDER BY created_at DESC";
$internships = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Internships - TechBao Admin</title>
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
                    <h1 class="h2">Manage Internships</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="create.php" class="btn btn-sm btn-outline-secondary">
                            Add New Internship
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($internships as $internship): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($internship['title']); ?></td>
                                <td><?php echo htmlspecialchars($internship['duration']); ?></td>
                                <td><?php echo ucfirst($internship['type']); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $internship['status'] === 'open' ? 'success' : 'secondary'; ?>">
                                        <?php echo ucfirst($internship['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M j, Y', strtotime($internship['created_at'])); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $internship['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="?delete=<?php echo $internship['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>