<?php
if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];
}
$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$select_user_by_id = mysqli_query($connection, $query);
confirm($select_user_by_id);


while ($row = mysqli_fetch_assoc($select_user_by_id)) {
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_image = $row['user_image'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
    $date_created = $row['date_created'];
}

?>

<?php

if (isset($_POST['edit_user'])) {

    $the_user_id = $_GET['u_id'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_tmp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $user_image = $row['user_image'];
        }
    }


    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password = '{$user_password}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_image = '{$user_image}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = $the_user_id";

    $update_user_query = mysqli_query($connection, $query);
    confirm($update_user_query);
    header("Location: users.php");
}

?>


<h1 class="page-header">
    Users
    <small>Edit User</small>
</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <div class='form-group'>
        <label for="username">Username</label>
        <input class='form-control' type="text" name='username' value="<?php echo $username; ?>">
    </div>
    <div class='form-group'>
        <label for="password">Password</label>
        <input class='form-control' type="text" name='user_password' value="<?php echo $user_password; ?>">
    </div>

    <div class='form-group'>
        <label for="firstname">Firstname</label>
        <input class='form-control' type="text" name='user_firstname' value="<?php echo $user_firstname; ?>">
    </div>

    <div class='form-group'>
        <label for="lastname">Lastname</label>
        <input class='form-control' type="text" name='user_lastname' value="<?php echo $user_lastname; ?>">
    </div>

    <div class='form-group'>
        <label for="email">Email</label>
        <input class='form-control' type="text" name='user_email' value="<?php echo $user_email; ?>">
    </div>

    <div class='form-group'>
        <label for="user_image">User Image</label>
        <input class='form-control' type="file" name='user_image'>

    </div>

    <div class='form-group'>
        <label for="role">Role</label>
        <select name="user_role" id="">
            <option value="admin" <?php if ($user_role == strtolower('Admin')) { ?> selected <?php } ?>>Admin</option>
            <option value="moderator" <?php if ($user_role == strtolower('Moderator')) { ?> selected <?php } ?>>
                Moderator</option>
            <option value="copywriter" <?php if ($user_role == strtolower('Copywriter')) { ?> selected <?php } ?>>
                Copywriter</option>
            <option value="visitor" <?php if ($user_role == strtolower('Visitor')) { ?> selected <?php } ?>>Visitor
            </option>
        </select>
    </div>

    <div class='form-group'>
        <input class='btn btn-primary' type="submit" name="edit_user" value="Edit User">
    </div>


</form>