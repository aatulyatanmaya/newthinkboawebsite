<?php
require_once 'includes/header.php';

$post = ['title' => '', 'content' => '', 'status' => 'draft'];

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $post = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $content = $_POST['content'];
    $status = $_POST['status'];
    $slug = generate_slug($title);
    
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, status = ?, slug = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $content, $status, $slug, $_GET['id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO posts (title, content, status, slug, author_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $title, $content, $status, $slug, $_SESSION['user_id']);
    }
    
    if ($stmt->execute()) {
        redirect('posts.php');
    }
}
?>

<div class="content-header">
    <h1><?php echo isset($_GET['id']) ? 'Edit Post' : 'New Post'; ?></h1>
</div>

<form method="POST" class="post-form">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" 
               value="<?php echo htmlspecialchars($post['title']); ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10" required>
            <?php echo htmlspecialchars($post['content']); ?>
        </textarea>
    </div>
    
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="draft" <?php echo $post['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
            <option value="published" <?php echo $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
        </select>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Post</button>
        <a href="posts.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#content',
    height: 500,
    plugins: 'link image code',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | link image | code'
});
</script>

<?php require_once 'includes/footer.php'; ?>