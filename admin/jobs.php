<?php
require_once 'includes/header.php';

// Handle job deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
}

// Get all jobs
$query = "SELECT * FROM jobs ORDER BY created_at DESC";
$jobs = $conn->query($query);
?>

<div class="content-header">
    <h1>Job Listings</h1>
    <a href="job-edit.php" class="btn btn-primary">Add New Job</a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Type</th>
                <th>Status</th>
                <th>Posted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($job = $jobs->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($job['title']); ?></td>
                <td><?php echo htmlspecialchars($job['location']); ?></td>
                <td><?php echo ucfirst($job['type']); ?></td>
                <td>
                    <span class="badge bg-<?php echo $job['status'] === 'open' ? 'success' : 'secondary'; ?>">
                        <?php echo ucfirst($job['status']); ?>
                    </span>
                </td>
                <td><?php echo date('M d, Y', strtotime($job['created_at'])); ?></td>
                <td>
                    <a href="job-applications.php?job_id=<?php echo $job['id']; ?>" 
                       class="btn btn-sm btn-secondary">Applications</a>
                    <a href="job-edit.php?id=<?php echo $job['id']; ?>" 
                       class="btn btn-sm btn-info">Edit</a>
                    <a href="jobs.php?delete=<?php echo $job['id']; ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>