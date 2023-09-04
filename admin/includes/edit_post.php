<?php

if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
}

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($connection, $query);
confirm($select_posts_by_id);


while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}

?>

<?php

if (isset($_POST['edit_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];


    move_uploaded_file($post_image_tmp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }


    $query = "UPDATE posts SET ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_author='{$post_author}', ";
    $query .= "post_date = now(), ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}' ";
    $query .= "WHERE post_id = $the_post_id";

    $update_post_query = mysqli_query($connection, $query);
    confirm($update_post_query);
    echo "<p class='bg-success'>Post Updated Successfully.
    </br>
    </br>
    <a href='../../post.php?p_id=$post_id&user=$user_id'>Click</a> to see the post.</br>
    Or go back to see all <a href='posts.php?&user=$user_id'>posts</a> </p>";
}
?>
<h1 class="page-header">
    Posts
    <small>Edit Post</small>
</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <div class='form-group'>
        <label for="title">Post Title</label>
        <input class='form-control' type="text" name='title' value="<?php echo $post_title ?>">
    </div>


    <div class='form-group'>
        <label for="category">Category</label>
        <select name="post_category" id="">
            <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirm($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for="author">Post Author</label>
        <input class='form-control' type="text" name='author' value="<?php echo $post_author; ?>">
    </div>

    <div class='form-group'>
        <label for="post_status">Post Status</label>
        <div class="form-group">
            <select name="post_status" id="">
                <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
                <?php
                if ($post_status == 'published') {
                    echo "<option value='draft'>Draft</option>";
                } else {
                    echo "<option value='published'>Publish</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class='form-group'>
        <img src="../images/<?php echo $post_image; ?>" width="200">
        <input class='form-control' type="file" name='image'>

    </div>

    <div class='form-group'>
        <label for="post_tags">Post Tags</label>
        <input class='form-control' type="text" name='post_tags' value="<?php echo $post_tags; ?>">
    </div>

    <div class='form-group'>
        <label for="post_content">Post Content</label>
        <textarea class='form-control' id="" name='post_content' cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class='form-group'>
        <input class='btn btn-primary' type="submit" name="edit_post" value="Edit Post">
    </div>


</form>