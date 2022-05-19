<?php
include('inc/header.php');
require_once('functions/index.php');
$error_status = false;
$message = '';
if (!empty($_POST)) {
    $title = isset($_POST['title']) ? sanitize_input($_POST['title']) : '';
    $body = isset($_POST['body']) ? sanitize_input($_POST['body']) : '';
    if (empty($title) || empty($body)) {
        $error_status = true;
        $message = 'All fields are required';
    } else {
        $query = $conn->prepare("INSERT INTO article (title, body) VALUES (:title, :body)");
        $query->bindParam(':title', $title);
        $query->bindParam(':body', $body);
        $query->execute();
        $result = $query->rowCount();
        if ($result > 0) {
            $message = 'Article created successfully';
        } else {
            $error_status = true;
            $message = 'Internal server error';
        }
    }
}
?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Create Article</h1>
            <a href="index.php" class="btn btn-dark">
                Article List
            </a>
        </div>
        <hr>
        <?php if ($error_status): ?>
            <div class="alert alert-danger">
                <?php echo $message ?>
            </div>
        <?php endif ?>
        <?php if (!$error_status && $message !== ''): ?>
            <div class="alert alert-success">
                <?php echo $message ?>
            </div>
        <?php endif ?>
        <form action="create-article.php" method="POST">
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Article Body</label>
                <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
<?php
include('inc/footer.php');
?>