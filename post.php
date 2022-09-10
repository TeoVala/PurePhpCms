<?php
include 'includes/header.php';


?>

<!-- Navigation -->

<?php
include 'includes/navigation.php';

?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header"> Page Heading
                <small>Secondary Text</small>
            </h1>


            <?php

            if(isset($_GET['p_id'])){

                $the_post_id = $_GET['p_id'];

            }

            $query = "SELECT * FROM posts WHERE post_id=$the_post_id";


            $select_posts = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                ?>



                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>


                <hr>

            <?php } ?>

            <!-- Blog Comments -->

            <?php

                // Δημιουργία comments
                if (isset($_POST['create_comment'])){

                    $the_post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    $query = "INSERT INTO comments(comment_author, comment_email,
                     comment_content, comment_post_id, comment_date, comment_status)";

                    $query .= "VALUES ('{$comment_author}', '{$comment_email}', 
                    '{$comment_content}', $the_post_id, now(), 'unapproved')";

                    $add_comment_query = mysqli_query($conn, $query);

                    if (!$add_comment_query){
                        die("Query Failed: ". mysqli_error($conn));

                    }

                    // Ανεβάζει τo comment count στο post
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1
                    WHERE post_id = $the_post_id";

                    $update_comment_count = mysqli_query($conn, $query);

                }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="content">Your message</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php



                $query = "SELECT * FROM comments WHERE comment_post_id= $the_post_id and comment_status = 'approved'";
                $show_post_comments = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($show_post_comments)){
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];


                    echo "<!-- Comment -->
                        <div class='media'>                            
                            <div class='media-body'>
                                <h4 class='media-heading'>$comment_author
                                    <small>$comment_date</small>
                                </h4>
                                $comment_content
                            </div>
                    </div>";

                }



            ?>





        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php
        include 'includes/sidebar.php';

        ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php
    include 'includes/footer.php';

    ?>


