<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

$job_id = (int)$_GET['id'];
$query = "SELECT * FROM jobs WHERE id = ? AND status = 'open'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$job = $stmt->get_result()->fetch_assoc();

if (!$job) {
    redirect('/careers/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_logged_in()) {
    $user_id = $_SESSION['user_id'];
    $cover_letter = sanitize_input($_POST['cover_letter']);
    
    // Handle resume upload
    $resume = $_FILES['resume'];
    $resume_path = '';
    
    if ($resume['error'] === 0) {
        $allowed = ['pdf', 'doc', 'docx'];
        $file_ext = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));
        
        if (in_array($file_ext, $allowed)) {
            $upload_dir = '../uploads/resumes/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $filename = uniqid() . '.' . $file_ext;
            $resume_path = 'uploads/resumes/' . $filename;
            
            if (move_uploaded_file($resume['tmp_name'], '../' . $resume_path)) {
                $query = "INSERT INTO job_applications (job_id, user_id, resume_path, cover_letter) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("iiss", $job_id, $user_id, $resume_path, $cover_letter);
                
                if ($stmt->execute()) {
                    $success = "Your application has been submitted successfully!";
                } else {
                    $error = "Failed to submit application. Please try again.";
                }
            } else {
                $error = "Failed to upload resume. Please try again.";
            }
        } else {
            $error = "Invalid file format. Please upload PDF, DOC, or DOCX files only.";
        }
    } else {
        $error = "Please select a resume to upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?> - TechBao Careers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <h1><?php echo htmlspecialchars($job['title']); ?></h1>
                <p class="text-muted mb-4">
                    <span class="me-3"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($job['location']); ?></span>
                    <span><i class="bi bi-clock"></i> <?php echo ucfirst($job['type']); ?></span>
                </p>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Job Description</h3>
                        <div class="mb-4"><?php echo nl2br(htmlspecialchars($job['description'])); ?></div>
                        
                        <h3>Requirements</h3>
                        <div><?php echo nl2br(htmlspecialchars($job['requirements'])); ?></div>
                    </div>
                </div>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (!is_logged_in()): ?>
                    <div class="alert alert-info">
                        Please <a href="/auth/login.php">login</a> or <a href="/auth/register.php">register</a> to apply for this position.
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Apply for this Position</h3>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="resume" class="form-label">Resume (PDF, DOC, or DOCX)</label>
                                    <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cover_letter" class="form-label">Cover Letter</label>
                                    <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5" placeholder="Tell us why you're the perfect fit for this role"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3>About TechBao</h3>
                        <p>We are a leading technology company committed to innovation and excellence. Join our team and be part of something extraordinary.</p>
                        <hr>
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="/about.php">About Us</a></li>
                            <li><a href="/careers/">All Openings</a></li>
                            <li><a href="/internships/">Internship Programs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>