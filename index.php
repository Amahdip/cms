<?php
include "./includes/header.php";
include "./includes/db.php";
?>
<!-- Navigation -->
<?php

include "./includes/navigation.php"
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Home Page <small>This is my blog</small>
            </h1>

            <!-- First Blog Post -->

            <?php
            $query = "SELECT * FROM posts";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];
                $post_category_id = $row['post_category_id'];

                if ($post_status === 'published') {

            ?>

            <!-- Blog Posts -->
            <h2>
                <?php
                        if (isset($login_user_id)) {
                        ?>
                <a
                    href="post.php?category=<?php echo $post_category_id; ?>&p_id=<?php echo $post_id; ?>&user=<?php echo $login_user_id ?>&p_author=<?php echo $post_author ?>"><?php echo $post_title ?></a>
                <?php
                        } else {
                        ?>
                <a
                    href="post.php?category=<?php echo $post_category_id; ?>&p_id=<?php echo $post_id; ?>&p_author=<?php echo $post_author ?>"><?php echo $post_title ?></a>
                <?php } ?>
            </h2>
            <p class="lead">by
                <?php
                        if (isset($login_user_id)) {
                        ?>
                <a
                    href="author.php?p_author=<?php echo $post_author; ?>&user=<?php echo $login_user_id ?>"><?php echo $post_author ?></a>

                <?php
                        } else {
                        ?>
                <a href="author.php?p_author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>

                <?php } ?>

            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
            <hr>
            <?php
                    if (isset($login_user_id)) {
                    ?>

            <a
                href="post.php?category=<?php echo $post_category_id; ?>&p_id=<?php echo $post_id; ?>&user=<?php echo $login_user_id ?>"><img
                    class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
            <?php
                    } else {
                    ?>
            <a href="post.php?category=<?php echo $post_category_id; ?>&p_id=<?php echo $post_id; ?>"><img
                    class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
            <?php } ?>
            <hr>
            <p><?php echo $post_content ?></p>
            <?php
                    if (isset($login_user_id)) {
                    ?>
            <a class="btn btn-primary"
                href="post.php?p_id=<?php echo $post_id; ?>&user=<?php echo $login_user_id ?>">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>
            <?php
                    } else {
                    ?>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>

            <?php } ?>


            <?php
                    if (isset($login_user_id)) {
                    ?>

            <a class="btn btn-primary"
                href="admin/posts.php?source=edit_post&p_id=<?php echo $post_id; ?>&user=<?php echo $login_user_id ?>">Edit
                <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php } ?>

            <hr>

            <?php }
            } ?>

            <!-- Pager -->
            <!-- <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul> -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include "./includes/sidebar.php"
        ?>




    </div>
    <!-- /.row -->

    <hr>

    <?php

    include "./includes/footer.php";

    ?>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>