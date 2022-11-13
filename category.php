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
                <h1 class="page-header"> Category

                </h1>


                <?php

                    if (isset($_GET['cat_id'])){
                        $the_cat_id = $_GET['cat_id'];

                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {

                            $query = "SELECT * FROM posts WHERE post_category_id = $the_cat_id";

                        }
                        else {

                            $query = "SELECT * FROM posts WHERE post_category_id = $the_cat_id AND post_status='published'";
                        }



                    $select_posts = mysqli_query($conn, $query);


                    // If no posts in category show this message
                    if (mysqli_num_rows($select_posts) <1) {
                        echo "<h2 class='text-center'>No post in this category sorry</h2>";
                    }

                    else {



                    while ($row = mysqli_fetch_assoc($select_posts)) {

                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_user = $row['post_user'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,100);

                ?>



                        <!-- First Blog Post -->
                        <h2>
                            <a href="/post/<?php echo "$post_id"; ?>"> <?php echo $post_title; ?> </a>
                        </h2>
                        <p class="lead">
                            by <a href="index"><?php echo $post_user; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="/images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                <?php } }}
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