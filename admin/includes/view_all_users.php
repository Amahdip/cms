<?php
$login_user_id = $_SESSION['user_id'];
?>

<h1 class="page-header">
    Users
    <small>View All Users</small>
</h1>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <td>User Id</td>
            <td>Username</td>
            <td>Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Image</td>
            <td>Role</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = 'SELECT * FROM users';
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = strtolower($row['username']);
            $user_firstname = ucwords(strtolower($row['user_firstname']));
            $user_lastname = ucwords(strtolower($row['user_lastname']));
            $user_email = strtolower($row['user_email']);
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $date_created = $row['date_created'];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td><img src='../images/{$user_image}' width=40></td>";
            echo "<td>{$user_role}</td>";
            echo "<td>{$date_created}</td>";
            echo "<td><a href='users.php?delete={$user_id}&user=$login_user_id'>Delete</a>/<a href='users.php?source=edit_user&u_id={$user_id}&user=$login_user_id'>Edit</a></td>";

            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_post_by_id = mysqli_query($connection, $query);
            // while ($row = mysqli_fetch_assoc($select_post_by_id)) {;
            //     $post_title = $row['post_title'];
            //     $post_id = $row['post_id'];
            //     echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            // }
            // echo "<td><a href='comments.php?approved={$comment_id}'>Approve</a>/<a href='comments.php?unapproved={$comment_id}'>Unapprove</a></td>";
            // echo "<td>{$comment_date}</td>";
            // echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            // echo "</tr>";
        }

        if (isset($_GET['delete'])) {
            $the_target_user = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = $the_target_user";
            $delete_comment = mysqli_query($connection, $query);
            header("Location: users.php");
        }

        // if (isset($_GET['edit'])) {
        //     $the_target_user = $_GET['edit'];
        //     $query = "UPDATE users SET user_id = $the_target_user";
        //     $delete_comment = mysqli_query($connection, $query);
        //     header("Location: users.php");
        // }
        ?>

    </tbody>
</table>