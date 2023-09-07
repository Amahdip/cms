<?php include "./includes/header.php"; ?>

<!-- Navigation -->
<?php

include "./includes/navigation.php"
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->

            <!-- First Blog Post -->

            <?php

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_category_id = $row['post_category_id'];

            ?>

                <!-- Blog Posts -->
                <h2><a href="post.php?category=<?php echo $post_category_id; ?>&p_id=<?php echo $post_id; ?><?php if (isset($login_user_id)) echo "&user=$login_user_id"; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">by <a href="author.php?p_author=<?php echo $post_author; ?><?php if (isset($login_user_id)) echo "&user=$login_user_id"; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?category=<?php echo $post_category_id; ?>&p_id=<?php echo $post_id; ?><?php if (isset($login_user_id)) echo "&user=$login_user_id"; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>

            <?php } ?>

            <?php
            include "./includes/comments.php"
            ?>


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