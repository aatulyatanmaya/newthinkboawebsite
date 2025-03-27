<?php
require_once 'includes/header.php';

$job = [
    'title' => '',
    'description' => '',
    'requirements' => '',
    'location' => '',
    'type' => 'full-time',
    'status' => 'open'
];

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $job = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $location = sanitize_input($_POST['location']);
    $type = $_POST['type'];
    $status = $_POST['status'];
    
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("UPDATE jobs SET title = ?, description = ?, requirements = ?, location = ?, type = ?, status = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $title, $description, $requirements, $location, $type, $status, $_GET['id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO jobs (title, description, requirements, location, type, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $description, $requirements, $location, $type, $status);
    }
    
    if ($stmt->execute()) {
        redirect('jobs.php');
    }
}
?>

<div class="content-header">
    <h1><?php echo isset($_GET['id']) ? 'Edit Job' : 'New Job'; ?></h1>
</div>

<form method="POST" class="job-form">
    <div class="mb-3">
        <label for="title" class="form-label">Job Title</label>
        <input type="text" class="form-control" id="title" name="title" 
               value="<?php echo htmlspecialchars($job['title']); ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Job Description</label>
        <textarea class="form-control" id="description" name="description" rows="6" required>
            <?php echo htmlspecialchars($job['description']); ?>
        </textarea>
    </div>
    
    <div class="mb-3">
        <label for="requirements" class="form-label">Requirements</label>
        <textarea class="form-control" id="requirements" name="requirements" rows="6" required>
            <?php echo htmlspecialchars($job['requirements']); ?>
        </textarea>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" 
                       value="<?php echo htmlspecialchars($job['location']); ?>" required>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="mb-3">
                <label for="type" class="form-label">Job Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="full-time" <?php echo $job['type'] === 'full-time' ? 'selected' : ''; ?>>Full Time</option>
                    <option value="part-time" <?php echo $job['type'] === 'part-time' ? 'selected' : ''; ?>>Part Time</option>
                    <option value="contract" <?php echo $job['type'] === 'contract' ? 'selected' : ''; ?>>Contract</option>
                    <option value="remote" <?php echo $job['type'] === 'remote' ? 'selected' : ''; ?>>Remote</option>
                </select>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="open" <?php echo $job['status'] === 'open' ? 'selected' : ''; ?>>Open</option>
                    <option value="closed" <?php echo $job['status'] === 'closed' ? 'selected' : ''; ?>>Closed</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Job</button>
        <a href="jobs.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script>
tinymce.init({
    selector: '#description, #requirements',
    height: 300,
    plugins: 'lists link',
    toolbar: 'undo redo | formatselect | bold italic | bullist numlist | link'
});
</script>

<?php require_once 'includes/footer.php'; ?>