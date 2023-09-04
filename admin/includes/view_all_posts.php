<?php
$_SESSION['user_id'] = $_GET['user'];
$login_user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_post_status_query = mysqli_query($connection, $query);
                confirm($update_post_status_query);

                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_post_status_query = mysqli_query($connection, $query);
                confirm($update_post_status_query);

                break;

            case 'delete':
                $query2 = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $delete_post_query = mysqli_query($connection, $query2);
                confirm($delete_post_query);

                break;
        }
    }
}

?>


<h1 class="page-header">
    Posts
    <small>View All Posts</small>
</h1>
<form action="" method="post">
    <table class="table table-hover table-bordered">
        <div name="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input class="btn btn-success" name="submit" type="submit" value="Apply">
            <a class="btn btn-primary" href="posts.php/?user=<?php echo $login_user_id; ?>&source=add_post">Add New</a>
        </div>
        </br>
        </br>
    </table>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Images</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = 'SELECT * FROM posts';
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];

                echo "<tr>";
            ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'>
                </td>

            <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td><a href='../../post.php?p_id=$post_id&user=$login_user_id'>{$post_title}</a></td>";

                $query2 = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_category_title = mysqli_query($connection, $query2);
                while ($row = mysqli_fetch_assoc($select_category_title)) {
                    echo "<td>{$row['cat_title']}</td>";
                }
                echo "<td>{$post_status}</td>";
                echo "<td><img src='../images/{$post_image}' width=100 </td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='?source=edit_post&p_id={$post_id}&user=$login_user_id'>Edit</a></td>";
                echo "<td><a href='?source=delete_post&p_id={$post_id}&user=$login_user_id'>Delete</a></td>";
                echo "</tr>";
            }

            if (isset($_GET['p_id'])) {
                $the_target_post = $_GET['p_id'];
                $query = "DELETE FROM posts WHERE post_id = $the_target_post";
                $delete_post = mysqli_query($connection, $query);
                header("Location: posts.php?user=$login_user_id");
            }
            ?>

        </tbody>
    </table>
</form>