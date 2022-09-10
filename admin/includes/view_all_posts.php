<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Post Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>

    </thead>

    <tbody

    <?php

        //Εμφάνιση όλων το posts

        $query = "SELECT * FROM posts";

        $select_posts= mysqli_query($conn, $query);

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

            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";

            $select_categories_id = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_title = $row['cat_title'];
            }
            //Εμφάνιση στο table και buttons για τα edit και delete
            echo "<tr>
                    <td>$post_id</td>
                    <td>$post_author</td>
                    <td>$post_title</td>
                    <td>$cat_title</td>
                    <td>$post_status</td>
                    <td><img width='100' src='/images/$post_image' alt='images'></td>
                    <td>$post_tags</td>
                    <td>$post_comment_count</td>
                    <td>$post_date</td>
                    <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
                    <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
                                             
                                            
    
                </tr>";

        }

    ?>

    </tbody>

</table>

<?php


    //Delete στο database
    if (isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

        $delete_query = mysqli_query($conn, $query);

        confirm($delete_query);

        header("Location: posts.php");

    }

?>