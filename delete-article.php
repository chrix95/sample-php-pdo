<?php
include('inc/header.php');
require_once('functions/index.php');
$error_status = false;
$message = '';
$articleId = isset($_GET['articleId']) ? $_GET['articleId'] : '';
$error = false;
$deleteArticle = false;
if (empty($articleId)) {
    if (!empty($_POST)) {
        $article_id = isset($_POST['article_id']) ? sanitize_input($_POST['article_id']) : '';
        $query = $conn->prepare("DELETE FROM article WHERE id = :articleId");
        $query->bindParam(':articleId', $article_id);
        $query->execute();
        $result = $query->rowCount();
        if ($result > 0) {
        ?>
            <div class="d-block text-center justify-content-center align-items-center">
                <p style="font-size: 16px" class="text-center">Article deleted successfully</p>
                <a href="index.php" class="btn btn-success">
                    Back to List
                </a>
            </div>
        <?php 
        exit();
        } else {
            exit('Internal server error');
        }
    } else {
        exit('Article ID has to be specified');
    }
} else {
    $query = $conn->prepare("SELECT * FROM article WHERE id = :articleId");
    $query->bindParam(':articleId', $articleId);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result && count($result) > 0) {
        $title = $result['title'];
    } else {
        $error = true;
    }
}
?>
    <div class="container mb-5">
        <div class="d-block justify-content-center align-items-center">
            <h1>Delete Article</h1>
            <hr>
            <?php if ($error) : ?>
                <div class="d-block text-center justify-content-center align-items-center">
                    <p style="font-size: 16px" class="text-center">Article could not be found</p>
                    <a href="index.php" class="btn btn-success">
                        Back to List
                    </a>
                </div>
            <?php else : ?>
                <div class="text-center d-block justify-content-center align-items-center">
                    <p class="m-0" style="font-size: 16px">Are you sure you want to delete article</p>
                    <h1 class="mb-4"><?php echo $title; ?>?</h1>
                    <div class="d-flex justify-content-center align-items-center">
                        <form action="delete-article.php" method="post">
                            <input type="hidden" name="article_id" value="<?=$articleId?>">
                            <button type="submit" class="btn btn-danger">
                                Yes
                            </button>
                        </form>
                        <a href="index.php" class="btn btn-info ml-3">
                            No
                        </a>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php
include('inc/footer.php');
?>