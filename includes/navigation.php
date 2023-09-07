<?php include "db.php"; ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if (isset($login_user_id)) {
            ?>
                <a class="navbar-brand" href="index.php?user=<?php echo $login_user_id ?>">Home</a>
            <?php } else { ?>
                <a class="navbar-brand" href="index.php">Home</a>
            <?php } ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    if (isset($login_user_id)) {
                        echo "<li><a href='category.php?category=$cat_id&user=$login_user_id'>{$cat_title}</a></li>";
                    } else {
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                }

                ?>
                <?php if (isset($_SESSION['role'])) { ?>
                    <li>
                        <a href="../admin/dashboard.php?user=<?php echo $login_user_id ?>">Admin</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="../registration.php">Register</a>
                    </li>

                <?php } ?>

                <!-- <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>