<?php
include('inc/header.php');
$articleId = $_GET["articleId"];
if (!$articleId) {
    header("Location: 404.php");
    exit();
}
$query = $conn->prepare("SELECT * FROM article WHERE id = :articleId");
$query->bindValue('articleId', $articleId);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
if ($result && count($result) > 0) {
?>
    <div class="container">
        <h1><?php echo $result['title']; ?></h1>
        <hr>
        <p style="text-align: justify">
            <?php echo $result['body']; ?>
        </p>
        <hr>
        <a href="index.php" class="btn btn-primary">
            Back to List
        </a>
        <a href="delete-article.php?articleId=<?php echo $result['id'];?>" class="btn btn-danger ml-3">
            Delete
        </a>
    </div>
<?php
} else {
?>
    <div class="container">
        <h1>Article ID <?php echo $articleId; ?> Not Found</h1>
    </div>
<?php
}
?>
<?php
include('inc/footer.php');
?>