<h1 class="page-header">
    Posts
    <small>View All Posts</small>
</h1>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <td>Id</td>
            <td>Author</td>
            <td>Title</td>
            <td>Category</td>
            <td>Status</td>
            <td>Images</td>
            <td>Tags</td>
            <td>Comments</td>
            <td>Date</td>
            <td>Edit</td>
            <td>Delete</td>
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
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

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
            echo "<td><a href='?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='?source=delete_post&p_id={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }

        if (isset($_GET['p_id'])) {
            $the_target_post = $_GET['p_id'];
            $query = "DELETE FROM posts WHERE post_id = $the_target_post";
            $delete_post = mysqli_query($connection, $query);
            header("Location: posts.php");
        }
        ?>

    </tbody>
</table>