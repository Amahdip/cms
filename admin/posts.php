<?php
include "includes/admin_header.php";
$user_id = $_SESSION['user_id'];
?>


<div id="wrapper">
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <?php

                    // if (isset($_GET['user'])) {
                    //     $user_id = $_GET['user'];
                    // }

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {

                        case 'add_post';
                            include "includes/add_post.php";
                            break;

                        case 'edit_post';
                            include "includes/edit_post.php";
                            break;

                        default:
                            include "includes/view_all_posts.php";
                    }
                    ?>


                    <div class="col-xs-6">

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>