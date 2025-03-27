<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!is_admin()) {
    http_response_code(403);
    exit('Unauthorized');
}

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT cover_letter FROM job_applications WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    header('Content-Type: application/json');
    echo json_encode([
        'cover_letter' => nl2br(htmlspecialchars($result['cover_letter']))
    ]);
}
?>