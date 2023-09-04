<?php

if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
}

if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d_m_y');

    move_uploaded_file($post_image_tmp, "../images/$post_image");



    $query = "INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}', '{$post_content}','{$post_tags}','{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);
    confirm($create_post_query);

    $the_last_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created Successfully.
    </br>
    </br>
    <a href='../../post.php?p_id=$the_last_post_id&user=$user_id'>Click</a> to see the post.</br>
    Or go back to see all <a href='posts.php?&user=$user_id'>posts</a> </p>";
}



?>

<h1 class="page-header">
    Posts
    <small>Add Post</small>
</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <div class='form-group'>
        <label for="title">Post Title</label>
        <input class='form-control' type="text" name='title'>
    </div>

    <div class='form-group'>
        <label for="category">Category</label>
        <div class="form-group">
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
    </div>

    <div class='form-group'>
        <label for="author">Post Author</label>
        <input class='form-control' type="text" name='author'>
    </div>

    <div class='form-group'>
        <label for="post_status">Post Status</label>
        <div class="form-group">
            <select name="post_status" id="">
                <option value='draft' selected>Draft</option>
                <option value='published'>Publish</option>"
            </select>
        </div>
    </div>

    <div class='form-group'>
        <label for="post_image">Post Image</label>
        <input class='form-control' type="file" name='image'>
    </div>

    <div class='form-group'>
        <label for="post_tags">Post Tags</label>
        <input class='form-control' type="text" name='post_tags'>
    </div>

    <div class='form-group'>
        <label for="post_content">Post Content</label>
        <textarea class='form-control' id="" name='post_content' cols="30" rows="10"></textarea>
    </div>

    <div class='form-group'>
        <input class='btn btn-primary' type="submit" name="create_post" value="Publish Post">
    </div>


</form>