<?php
require_once 'includes/header.php';

$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : null;
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Handle status update
if (isset($_POST['update_status'])) {
    $app_id = (int)$_POST['application_id'];
    $new_status = sanitize_input($_POST['new_status']);
    $stmt = $conn->prepare("UPDATE job_applications SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $app_id);
    $stmt->execute();
}

// Build query based on filters
$query = "SELECT a.*, j.title as job_title 
          FROM job_applications a 
          LEFT JOIN jobs j ON a.job_id = j.id 
          WHERE 1=1";
if ($job_id) {
    $query .= " AND a.job_id = " . $job_id;
}
if ($status_filter !== 'all') {
    $query .= " AND a.status = '" . $conn->real_escape_string($status_filter) . "'";
}
$query .= " ORDER BY a.created_at DESC";

$applications = $conn->query($query);
?>

<div class="content-header">
    <h1>Job Applications</h1>
    <div class="filters">
        <select class="form-select" onchange="window.location.href='?status='+this.value">
            <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All Status</option>
            <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="reviewed" <?php echo $status_filter === 'reviewed' ? 'selected' : ''; ?>>Reviewed</option>
            <option value="shortlisted" <?php echo $status_filter === 'shortlisted' ? 'selected' : ''; ?>>Shortlisted</option>
            <option value="rejected" <?php echo $status_filter === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Applied Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($app = $applications->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($app['full_name']); ?></td>
                <td><?php echo htmlspecialchars($app['job_title']); ?></td>
                <td><?php echo htmlspecialchars($app['email']); ?></td>
                <td><?php echo htmlspecialchars($app['phone']); ?></td>
                <td>
                    <form method="POST" class="status-form">
                        <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                        <select name="new_status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="pending" <?php echo $app['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="reviewed" <?php echo $app['status'] === 'reviewed' ? 'selected' : ''; ?>>Reviewed</option>
                            <option value="shortlisted" <?php echo $app['status'] === 'shortlisted' ? 'selected' : ''; ?>>Shortlisted</option>
                            <option value="rejected" <?php echo $app['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                        <input type="hidden" name="update_status" value="1">
                    </form>
                </td>
                <td><?php echo date('M d, Y', strtotime($app['created_at'])); ?></td>
                <td>
                    <a href="<?php echo htmlspecialchars($app['resume_path']); ?>" 
                       class="btn btn-sm btn-info" target="_blank">View Resume</a>
                    <button type="button" class="btn btn-sm btn-secondary" 
                            onclick="viewCoverLetter('<?php echo htmlspecialchars($app['id']); ?>')">
                        Cover Letter
                    </button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Cover Letter Modal -->
<div class="modal fade" id="coverLetterModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cover Letter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="coverLetterContent"></div>
            </div>
        </div>
    </div>
</div>

<script>
function viewCoverLetter(id) {
    fetch(`get-cover-letter.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('coverLetterContent').innerHTML = data.cover_letter;
            new bootstrap.Modal(document.getElementById('coverLetterModal')).show();
        });
}
</script>

<?php require_once 'includes/footer.php'; ?>