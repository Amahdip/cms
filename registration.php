<?php
include "./admin/functions.php";
include "includes/header.php";
include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username (required)" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email (required)" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password (required)" required>
                            </div>
                            <?php

                            if (isset($_POST['user-register'])) {
                                $username = strtolower(mysqli_escape_string($connection, $_POST['username']));
                                $user_email = strtolower(mysqli_escape_string($connection, $_POST['email']));
                                $user_password = mysqli_real_escape_string($connection, $_POST['password']);
                                $user_password = password_hash($user_password, PASSWORD_BCRYPT);

                                if (is_usernameAvailable($username) && !is_emailAvailable($user_email)) {
                                    echo "<p class='bg-danger'>username not available</p>";
                                } else if (!is_usernameAvailable($username) && is_emailAvailable($user_email)) {
                                    echo "<p class='bg-danger'>email not available</p>";
                                } else if (is_usernameAvailable($username) && is_emailAvailable($user_email)) {
                                    if (does_userExist($user_email, $username)) {
                                        echo "<p class='bg-danger'>a user with the same username and email exists <a href='users.php?forgotton_password''>password recovery?<?a></p>";
                                    } else {
                                        echo "<p class='bg-danger'>Neither username nor email is available</p>";
                                    }
                                } else {

                                    $query = "INSERT INTO users (username, user_email, user_password) ";
                                    $query .= "VALUES ('{$username}', '{$user_email}', '{$user_password}')";
                                    $register_user_query = mysqli_query($connection, $query);
                                    if (!$register_user_query) {
                                        die("QUARY FAILED" . mysqli_error($connection) . mysqli_errno($connection));
                                    } else {
                                        echo "<p class='bg-success'>User Created Successfully <a href=''>redirect</a></p>";
                                    }
                                }
                            }

                            ?>
                            <input type="submit" name="user-register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>