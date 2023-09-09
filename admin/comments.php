<?php
include "functions.php";
include "includes/admin_header.php";
include_once "../includes/db.php";

?>

<div id="wrapper">
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Comments
                        <small>View All Comments</small>
                    </h1>
                    <?php

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {

                        case 'comments';
                            include '40';
                            break;

                        case 'edit_post';
                            include 'includes/edit_post.php';
                            break;

                        case '74';
                            echo "Helo from 74";
                            break;

                        default:
                            include 'includes/view_all_comments.php';
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