<?php include "functions.php";
include "includes/admin_header.php";
include_once "../includes/db.php";



$query = "SELECT * FROM users WHERE user_id = $user_id ";
$get_user_info_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($get_user_info_query)) {
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
}


if (isset($_POST['edit_profile'])) {
    $new_username = strtolower($_POST['username']);
    $new_firstname = ucwords(strtolower($_POST['user_firstname']));
    $new_lastname = ucwords(strtolower($_POST['user_lastname']));
    $new_email = strtolower($_POST['user_email']);
    $new_role = strtolower($_POST['user_role']);


    $query = "UPDATE users SET ";
    $query .= "username = '$new_username', ";
    $query .= "user_firstname = '$new_firstname', ";
    $query .= "user_lastname = '$new_lastname', ";
    $query .= "user_email = '$new_email', ";
    $query .= "user_role = '$new_role' ";
    $query .= "WHERE user_id = $user_id ";

    $update_user_query = mysqli_query($connection, $query);
    if (!$update_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    $_SESSION['username'] = $new_username;
    header("Location: profile.php?user=$user_id");
}

?>

<div id="wrapper">
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $username ?></span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-left">Profile Settings</h4>
                            </div>
                            <hr>
                            <form action="profile.php?user=<?php echo $user_id ?>" method="post">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Username</label>
                                        <input name="username" type="text" class="form-control" value="<?php echo $username ?>">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input name="user_firstname" type="text" class="form-control" value="<?php echo $user_firstname ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input name="user_lastname" type="text" class="form-control" value="<?php echo $user_lastname ?>">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email ID</label>
                                        <input name="user_email" type="text" class="form-control" value="<?php echo $user_email ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Role</label>
                                        <input name="user_role" type="text" class="form-control" value="<?php echo $user_role ?>">
                                    </div>
                                </div>
                                <hr>

                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit" name="edit_profile">Save Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>