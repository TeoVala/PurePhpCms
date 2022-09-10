<?php

    // Δημιουργια post

    if (isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');


        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_title, post_category_id, post_author, 
                  post_date, post_image, post_content, post_tags, post_status)";

        $query .= "VALUES ('{$post_title}', {$post_category_id}, '{$post_author}', 
                now(), '{$post_image}', '{$post_content}', '{$post_tags}',
                 '{$post_status}')";

        $create_post_query = mysqli_query($conn, $query);

        confirm($create_post_query);


        echo "Post Created: "." "."<a href='posts.php'>View Posts</a> ";
    }

?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category" id="post_category">

            <?php
            $query = "SELECT * FROM categories";

            $select_categories= mysqli_query($conn, $query);

            confirm($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";

            }



            ?>

        </select>

    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
        </div>

</form>