<?php
include 'includes/header.php';


?>

<!-- Navigation -->

<?php
include 'includes/navigation.php';

/* Like post */

if (isset($_POST['liked'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];


    $search_post_query = "SELECT * FROM posts WHERE post_id=$post_id";

    $post_result = mysqli_query($conn, $search_post_query);

    $post = mysqli_fetch_array($post_result);

    $likes = $post['likes'];

    mysqli_query($conn, "UPDATE posts SET likes=$likes+1 WHERE post_id = $post_id");

    mysqli_query($conn, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");

    exit();
}

if (isset($_POST['unliked'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];


    $search_post_query = "SELECT * FROM posts WHERE post_id=$post_id";

    $post_result = mysqli_query($conn, $search_post_query);

    $post = mysqli_fetch_array($post_result);

    $likes = $post['likes'];

    mysqli_query($conn, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");

    mysqli_query($conn, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id");

    exit();

}


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



            $views_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id}";
            $send_query = mysqli_query($conn, $views_query);

            if (!$send_query){
                die("Query failed". mysqli_error($conn));

            }

            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {

                $query = "SELECT * FROM posts WHERE post_id=$the_post_id";

            }
            else {
                $query = "SELECT * FROM posts WHERE post_id=$the_post_id AND post_status = 'published'";
            }




            $select_posts = mysqli_query($conn, $query);

            // If no posts in category show this message
            if (mysqli_num_rows($select_posts) <1) {
                echo "<h2 class='text-center'>No post here sorry</h2>";
            }

            else {


            while ($row = mysqli_fetch_assoc($select_posts)) {

                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                ?>



                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="/images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>


                <hr>

                <!--

                HERE

                -->

                <?php if(is_logged_in()) {  ?>

                <div class="row">
                    <p class="pull-right"><a
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo user_liked_this_post($the_post_id) ? 'I liked this before':'Want to like it?'; ?>"


                                class="<?php echo user_liked_this_post($the_post_id) ? 'unlike':'like'; ?>" href=""> <span class="glyphicon glyphicon-thumbs-up"></span>
                            <?php echo user_liked_this_post($the_post_id) ? 'Unlike':'Like'; ?>
                        </a></p>

                </div>

                <?php } else { ?>

                    <div class="row">
                    <p class="pull-right">You need to <a href="/login">login</a> to like this post.
                            </p>

                    </div>


                <?php } ?>

                <div class="row">
                    <p class="pull-right">Like: <?php get_post_likes($the_post_id); ?></p>

                </div>

                <div class="clearfix"></div>

            <?php }  ?>

            <!-- Blog Comments -->

            <?php

                // Δημιουργία comments
                if (isset($_POST['create_comment'])){

                    $the_post_id = $_GET['p_id'];



                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                        $query = "INSERT INTO comments(comment_author, comment_email,
                     comment_content, comment_post_id, comment_date, comment_status)";

                        $query .= "VALUES ('{$comment_author}', '{$comment_email}', 
                    '{$comment_content}', $the_post_id, now(), 'unapproved')";

                        $add_comment_query = mysqli_query($conn, $query);

                        if (!$add_comment_query){
                            die("Query Failed: ". mysqli_error($conn));

                        }


                    }

                    else {
                        echo "<script>alert('Fields cannot be empty')</script>";

                    }



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
            } }

            else {

                header("Location: index.php");
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

    <script>

        /* Like post Jquery */

        $(document).ready(function() {

            //Tooltip

            $("[data-toggle='tooltip']").tooltip();

            //Like

            $('.like').click(function(){

                var post_id = <?php echo $the_post_id; ?>

                var user_id = <?php echo logged_in_user_id(); ?>;

                $.ajax({
                    url: "/post/"+post_id,
                    type: 'post',
                    data:{
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id,


                    }

                });

            });

            //Unlike

            $('.unlike').click(function(){

                var post_id = <?php echo $the_post_id; ?>

                var user_id = 30;

                $.ajax({
                    url: "/post/"+post_id,
                    type: 'post',
                    data:{
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id,


                    }

                });

            });


            }


        )

    </script>

