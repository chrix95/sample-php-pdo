<?php
include('inc/header.php');
$query = $conn->query("SELECT * FROM article");
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Articles</h1>
        <a href="create-article.php" class="btn btn-dark">
            Create Article
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (isset($results) && count($results) > 0) {
                    foreach ($results as $key => $value) {
            ?>
                <tr>
                    <td>
                        <?php echo $value->title ?>
                    </td>
                    <td>
                        <a href="show-article.php?articleId=<?php echo $value->id;?>" class="btn btn-dark">
                            Show    
                        </a>
                        <a href="delete-article.php?articleId=<?php echo $value->id;?>" class="btn btn-danger ml-3">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            <?php
                } else {
            ?>
                <tr>
                    <td colspan="2">
                        No result found
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
include('inc/footer.php')
?>