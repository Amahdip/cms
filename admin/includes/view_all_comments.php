<?php
if (isset($_GET['user'])) {
    $_SESSION['user_id'] = $_GET['user'];
    $login_user_id = $_SESSION['user_id'];
}
?>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <td>Id</td>
            <td>Author</td>
            <td>Comment</td>
            <td>Email</td>
            <td>Status</td>
            <td>In Response To</td>
            <td>Approval</td>
            <td>Date</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = 'SELECT * FROM comments';
        $select_comments = mysqli_query($connection, $query);
        $login_user_id = $_SESSION['user_id'];


        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_by_id = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_post_by_id)) {;
                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                echo "<td><a href='../post.php?p_id={$post_id}&user={$login_user_id}'>{$post_title}</a></td>";
            }
            echo "<td><a href='comments.php?approved={$comment_id}&user={$login_user_id}'>Approve</a>/<a href='comments.php?unapproved={$comment_id}&user={$login_user_id}'>Unapprove</a></td>";
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?delete={$comment_id}&user={$login_user_id}'>Delete</a></td>";
            echo "</tr>";
        }

        if (isset($_GET['delete'])) {
            $the_comment_id = $_GET['delete'];
            $query0 = "SELECT * FROM comments WHERE comment_id = $the_comment_id";
            $check_comment_status_query = mysqli_query($connection, $query0);
            $row = mysqli_fetch_assoc($check_comment_status_query);
            $query = "DELETE FROM comments WHERE comment_id = $the_comment_id";
            $delete_comment = mysqli_query($connection, $query);
            if ($row['comment_status'] == 'approved') {
                $query2 = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $post_id";
                $update_comment_count_query = mysqli_query($connection, $query2);
                header("Location: comments.php?user={$login_user_id}");
            } else {
                header("Location: comments.php?user={$login_user_id}");
            }
        }

        if (isset($_GET['approved'])) {
            $the_comment_id = $_GET['approved'];
            $query0 = "SELECT * FROM comments WHERE comment_id = $the_comment_id";
            $check_comment_status_query = mysqli_query($connection, $query0);
            $row = mysqli_fetch_assoc($check_comment_status_query);
            if ($row['comment_status'] != 'approved') {
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
                $change_comment_status_query = mysqli_query($connection, $query);
                $query2 = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                $update_comment_count_query = mysqli_query($connection, $query2);
                header("Location: comments.php?user={$login_user_id}");
            }
        }

        if (isset($_GET['unapproved'])) {
            $the_comment_id = $_GET['unapproved'];
            $query0 = "SELECT * FROM comments WHERE comment_id = $the_comment_id";
            $check_comment_status_query = mysqli_query($connection, $query0);
            $row = mysqli_fetch_assoc($check_comment_status_query);
            if ($row['comment_status'] == 'approve') {
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
                $change_comment_status_query = mysqli_query($connection, $query);
                $query2 = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $post_id";
                $update_comment_count_query = mysqli_query($connection, $query2);
                header("Location: comments.php?user={$login_user_id}");
            } else if ($row['comment_status'] == 'pending') {
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
                $change_comment_status_query = mysqli_query($connection, $query);
                header("Location: comments.php?user={$login_user_id}");
            }
        };
        ?>

    </tbody>
</table>