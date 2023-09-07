<?php

// confirm connection to DB

function confirm($query)
{
    global $connection;
    if (!$query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}




// checking if the user is admin

function isAdmin($username)
{
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    confirm($result);
    $row = mysqli_fetch_array($result);
    return ($row['user_role'] == 'admin') ? true : false;
}






// Find all categories
function insert_categories()
{

    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}








// Delete a category
function delete_categories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $target_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $target_cat_id";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}







// Add a category
function add_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];
        if ($cat_title == '' || empty($cat_title)) {

            echo "this field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE ('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}






// count query function

function counting($table)
{
    global $connection;
    $query = "SELECT * FROM $table";
    $select_query = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_query);
    confirm($result);

    return $result;
}


function countingRecords($table, $where, $status)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE $where = '$status'";
    $select_query = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_query);

    return $result;
}




// cloning posts

function clonePost($id)
{
    global $connection;
    $query = "SELECT posts.post_id, posts.post_author,posts.post_title,posts.post_category_id, ";
    $query .= "posts.post_status,posts.post_content,
posts.post_image,posts.post_tags,posts.post_comment_count,posts.post_date, categories.cat_title ";
    $query .= " FROM posts ";
    $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";
    $query .= "WHERE post_id = {$id} ";
    $select_posts = mysqli_query($connection, $query);
    confirm($select_posts);

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
        $post_content = $row['post_content'];
        $cat_title = $row['cat_title'];

        $query = "INSERT INTO posts
(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
        $query .= "VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}',
'{$post_content}','{$post_tags}','{$post_status}') ";

        $create_post_query = mysqli_query($connection, $query);
        confirm($create_post_query);

        $the_last_post_id = mysqli_insert_id($connection);
    }
}




// delete post

function deletePost($id)
{
    global $connection;
    $query = "DELETE FROM posts WHERE post_id = {$id} ";
    $delete_post_query = mysqli_query($connection, $query);
    confirm($delete_post_query);
}




// update post status

function updatePostStatus($status, $id)
{
    global $connection;
    $query = "UPDATE posts SET post_status = '{$status}' WHERE post_id = {$id} ";
    $update_post_status_query = mysqli_query($connection, $query);
    confirm($update_post_status_query);
}





// username duplicate check

function is_usernameAvailable($username)
{
    global $connection;
    $query = "SELECT count(*) FROM users WHERE username = '{$username}' ";
    $looking_up_username_query = mysqli_query($connection, $query);
    $count = mysqli_fetch_column($looking_up_username_query);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}



// email duplicate check

function is_emailAvailable($email)
{
    global $connection;
    $query = "SELECT count(*) FROM users WHERE user_email = '{$email}' ";
    $looking_up_email_query = mysqli_query($connection, $query);
    $count = mysqli_fetch_column($looking_up_email_query);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}
