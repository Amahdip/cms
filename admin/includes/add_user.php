<?php

if (isset($_POST['create_user'])) {
    $username = strtolower($_POST['username']);
    $user_password = $_POST['user_password'];
    $user_firstname = ucwords(strtolower($_POST['user_firstname']));
    $user_lastname = ucwords(strtolower($_POST['user_lastname']));
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_email = strtolower($_POST['user_email']);
    $user_role = strtolower($_POST['user_role']);


    move_uploaded_file($user_image_tmp, "../images/$user_image");


    $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_image, user_role, user_email) ";
    $query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_image}', '{$user_role}', '{$user_email}') ";

    $create_user_query = mysqli_query($connection, $query);
    confirm($create_user_query);
    echo "User Created Successfully " . "<a href='users.php?user=$user_id'>Users</a>";
}



?>

<h1 class="page-header">
    Users
    <small>Add User</small>
</h1>

<form action="" method="POST" enctype="multipart/form-data">

    <div class='form-group'>
        <label for="firstname">Firstname</label>
        <input class='form-control' type="text" name='user_firstname' placeholder="first name" required>
    </div>

    <div class='form-group'>
        <label for="lastname">Lastname</label>
        <input class='form-control' type="text" name='user_lastname' placeholder="lastname" required>
    </div>
    <div class='form-group'>
        <label for="username">Username</label>
        <input class='form-control' type="text" name='username' placeholder="username" required>
    </div>
    <div class='form-group'>
        <label for="role">Role</label>
        <select name="user_role" id="">
            <option value="Admin">Admin</option>
            <option value="Moderator">Moderator</option>
            <option value="Copywriter">Copywriter</option>
            <option value="Visitor" selected>Visitor</option>
        </select>
    </div>
    <div class='form-group'>
        <label for="password">Password</label>
        <input class='form-control' type="text" name='user_password' placeholder="password" required>
    </div>

    <div class='form-group'>
        <label for="email">Email</label>
        <input class='form-control' type="text" name='user_email' placeholder="example@gmail.com" required>
    </div>

    <div class='form-group'>
        <label for="user_image">User Image</label>
        <input class='form-control' type="file" name='user_image'>

    </div>


    <div class='form-group'>
        <input class='btn btn-primary' type="submit" name="create_user" value="Add User">
    </div>


</form>