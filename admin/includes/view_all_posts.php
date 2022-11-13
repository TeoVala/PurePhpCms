<?php

include "delete_modal.php";

    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $postValueId){ // Checkbox Value returns Post ID
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options) {

                case 'published':
                        $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$postValueId}";

                        $update_to_published = mysqli_query($conn, $query);
                        confirm($update_to_published);

                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$postValueId}";

                    $update_to_draft = mysqli_query($conn, $query);
                    confirm($update_to_draft);

                    break;

                case 'clone':


                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";

                    $select_posts_query = mysqli_query($conn, $query);

                    confirm($select_posts_query);

                    while($row = mysqli_fetch_array($select_posts_query)) {
                        $post_user = $row['post_user'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        $post_date = $row['post_date'];

                    }

                    $query = "INSERT INTO posts(post_title, post_category_id, post_user, 
                  post_date, post_image, post_content, post_tags, post_status)";

                    $query .= "VALUES ('{$post_title}', {$post_category_id}, '{$post_user}', 
                now(), '{$post_image}', '{$post_content}', '{$post_tags}',
                 '{$post_status}')";

                    $copy_query = mysqli_query($conn, $query);

                    if (!$copy_query) {
                        die("Query Failed: ". mysqli_error($conn));

                    }

                    break;

                case 'delete':
                    $the_post_id = $_GET['delete'];

                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}";

                    $update_to_delete = mysqli_query($conn, $query);

                    confirm($update_to_delete);
                    header("Location: posts.php");
                    break;


            }

        }

    }

?>


<form action="" method="post">

    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer"  class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>

            </select>

        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add new</a>

        </div>


        <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
            <th>Post Id</th>
            <th>User</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Post Views</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

        </thead>

        <tbody

        <?php

            //Εμφάνιση όλων το posts

            /*$query = "SELECT * FROM posts ORDER BY post_id DESC"; OLD UNOPTIMIZED */
            if ($_SESSION['user_role'] == 'admin'){ // Δικο μου τσεκ ωστε να βλεπουν
                                                    // μονο οι admin ολα τα post ενω οι αλλοι user οχι

            $query = "SELECT posts.post_id, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status,"; // NEWEST OPTIOMISED MYSQL QUERY
            $query .= "posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count,";
            $query .= "categories.cat_title,categories.cat_id FROM posts  LEFT JOIN categories ";
            $query .= "ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
            }

            else {
                $user = currentUser();

                $query = "SELECT posts.post_id, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status,"; // NEWEST OPTIOMISED MYSQL QUERY
                $query .= "posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count,";
                $query .= "categories.cat_title,categories.cat_id FROM posts  LEFT JOIN categories ";
                $query .= "ON posts.post_category_id = categories.cat_id WHERE post_user='$user' ORDER BY posts.post_id DESC";

            }

            $select_posts= mysqli_query($conn, $query);

            confirm($select_posts);
            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views = $row['post_views_count'];
                $cat_id =  $row['cat_id'];
                $cat_title =  $row['cat_title'];

              /*  $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories_id = mysqli_query($conn, $query); OLD UNOPTIMIZED

                while($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_title = $row['cat_title'];
                }*/

                // Comments Query

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $send_comment_query = mysqli_query($conn, $query);

                $row = mysqli_fetch_array($send_comment_query);

               /* $comment_id = $row['comment_id'];*/
                $comment_count = mysqli_num_rows($send_comment_query); // Select the first inside the array

                //Εμφάνιση στο table και buttons για τα edit και delete

                if(isset($post_user)) {
                    echo "";
                }

                echo "<tr>
                        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='$post_id'></td>
                        <td>$post_id</td>
                        
                        ";

                        if(!empty($post_user)){
                            echo "<td>$post_user</td>";

                        }

                        elseif (!empty($post_user)) {
                            echo "<td>$post_user</td>";

                        }




                        echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td> 
                        <td>$cat_title</td>
                        <td>$post_status</td>
                        <td><img width='100' src='/images/$post_image' alt='images'></td>
                        <td>$post_tags</td>
     
                        <td><a href='post_comments.php?id=$post_id'>$comment_count</a></td>
                        
                        
                        <td>$post_date</td>
                        <td><a onClick=\" javascript: return confirm('Are you sure you want to reset your views'); \" href='posts.php?reset_views={$post_id}'>$post_views</a></td>
                        <td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
                       
                       <form method='post' action=''>
                       
                       <input type='hidden' name='post_id' value='$post_id'>
                       <td><input class='btn btn-danger' type='submit' name='delete' value='Delete'> </td>                 
</form>
                       
                        
                                                 
                                          
                                                
        
                    </tr>";
                /*<td><a onClick=\" javascript: return confirm('Are you sure you want to reset your views'); \" href='posts.php?reset_views={$post_id}'>$post_views</a></td>
                        <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
                        <td><a onClick=\" javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td> <!--Added Confirmation before delete-->
                        Παλιό confirms για delete τώρα χρησιμοποιεί modals*/

            }

        ?>

        </tbody>

    </table>

</form>

<?php

    //Delete στο database
    if (isset($_POST['delete'])){
        $the_post_id = $_POST['post_id'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

        $delete_query = mysqli_query($conn, $query);

        confirm($delete_query);

        header("Location: posts.php");

    }

    //Reset views
    if (isset($_GET['reset_views'])){
        $the_post_id = $_GET['reset_views'];

        $query = "UPDATE posts SET post_views_count=0 WHERE post_id= $the_post_id";

        $select_curr_post = mysqli_query($conn, $query);

        confirm($select_curr_post);

        header("Location: posts.php");

    }

?>

<script>

    $(document).ready(function(){

    $(".delete-link").on('click', function() {

        var id = $(this).attr("rel");

        var delete_url = "posts.php?delete="+id+"";

        $(".modal-delete-link").attr("href", delete_url);

        $("#myModal").modal('show');

    })

    });

</script>
