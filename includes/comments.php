<!-- Blog Comments -->

<!-- Comments Form -->

<div class="well">
    <h4>Leave a Comment:</h4>
    <?php

    if (isset($_POST['create_comment'])) {
        $the_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'pending', now())";
        $create_comment_query = mysqli_query($connection, $query);
        if (!$create_comment_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            echo "<p class='bg-success'>Your comment awaits Admin's
            approval</p>";
        }
    }
    ?>
    <form action="" method="POST" role="form">
        <div class="form-group">
            <label for="comment_author">Author</label>
            <input class="form-control" type="text" name="comment_author" required>
        </div>
        <div class="form-group">
            <label for="comment_email">Email</label>
            <input class="form-control" type="email" name="comment_email" required>
        </div>

        <div class="form-group">
            <label for="comment">Your Comment</label>
            <textarea name="comment_content" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->
<?php
$the_post_id = $_GET['p_id'];
$query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
$query .= "AND comment_status = 'approved' ";
$query .= "ORDER BY comment_id DESC ";
$show_comments_query = mysqli_query($connection, $query);
if (!$show_comments_query) {
    die("QUERY FAILED" . mysqli_error($connection));
}
while ($row = mysqli_fetch_assoc($show_comments_query)) {
    $comment_author = $row['comment_author'];
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];

?>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.co/64x64" alt="">
        </a>
        <div class="media-body">


            <h4 class="media-heading"><?php echo $comment_author ?>
                <small><?php echo $comment_date ?></small>
            </h4>
            <?php echo $comment_content ?>
        </div>
    </div>

<?php } ?>