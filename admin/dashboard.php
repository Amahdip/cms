<?php
include "functions.php";
include "includes/admin_header.php";
include_once "../includes/db.php";




$post_rows_count = counting('posts');
$comment_rows_count = counting('comments');
$user_rows_count = counting('users');
$category_rows_count = counting('categories');

$post_draft_rows_count = countingRecords('posts', 'post_status', 'draft');
$post_published_rows_count = countingRecords('posts', 'post_status', 'published');

$comment_approved_rows_count = countingRecords('comments', 'comment_status', 'approved');
$comment_unapproved_rows_count = countingRecords('comments', 'comment_status', 'unapproved');
$comment_pending_rows_count = countingRecords('comments', 'comment_status', 'pending');




?>

<head>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {
                    role: "style"
                }],
                ["Posts", <?php echo $post_rows_count ?>, "#337ab7"],
                ["Draft", <?php echo $post_draft_rows_count ?>, "#4584ba"],
                ["Published", <?php echo $post_published_rows_count ?>, "#6185a4"],
                ["Comments", <?php echo $comment_rows_count ?>, "#5cb85c"],
                ["Approved Comments", <?php echo $comment_approved_rows_count ?>, "#369537"],
                ["Unapproved Comments", <?php echo $comment_unapproved_rows_count ?>, "#21b823"],
                ["Pending Comments", <?php echo $comment_pending_rows_count ?>, "#19ff1c"],
                ["Users", <?php echo $user_rows_count ?>, "#f0ad4e"],
                ["Categories", <?php echo $category_rows_count ?>, "color: #d9534f"]
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                height: 400,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>


</head>


<!-- /.row -->
<div id="wrapper">
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="page-header">
                Welcome
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $post_rows_count ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php?user=<?php echo $user_id ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $comment_rows_count ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php?user=<?php echo $user_id ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $user_rows_count ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php?user=<?php echo $user_id ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $category_rows_count ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php?user=<?php echo $user_id ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="columnchart_values" style="width: 'auto'; height: 500px;"></div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/admin_footer.php" ?>

<!-- /.row -->