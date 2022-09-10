
<?php

    /* Στο tutorial το κάνει έτσι εγώ έκανα το count μέσα στην mysql
        $query = "SELECT * FROM posts";
        $select_all_post = mysqli_query($conn, $query);
        $post_counts = mysqli_num_rows($select_all_post);

        <div class='huge'><?php echo $post_counts ?></div>

    */

    $query = "SELECT count(*) FROM posts";
    $post_count_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($post_count_query);

    $post_count = $row[0];

    /* Βρίσκει ποια post είναι σε Draft */
    $query = "SELECT COUNT(*) FROM posts WHERE post_status ='draft'";
    $select_all_draft_posts_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($select_all_draft_posts_query);
    $post_draft_count = $row[0];


    $query = "SELECT count(*) FROM comments";
    $comment_count_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($comment_count_query);

    $comment_count = $row[0];

    $query = "SELECT count(*) FROM comments WHERE comment_status= 'unapproved'";
    $unapproved_comments_count_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($unapproved_comments_count_query);

    $unapp_com_count = $row[0];

    $query = "SELECT count(*) FROM users";
    $user_count_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($user_count_query);

    $user_count = $row[0];

    $query = "SELECT count(*) FROM users WHERE user_role= 'subscriber'";
    $user_role_count_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($user_role_count_query);

    $user_role_count = $row[0];

    $query = "SELECT count(*) FROM categories";
    $categories_count_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($categories_count_query);

    $categories_count = $row[0];




?>


<!-- /.row -->

<!-- Κάρτες στο dashboard -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $post_count ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $comment_count ?></div>
                        <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $user_count ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $categories_count ?></div>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->




<!-- Chart με javascript του google στο dashboard -->

<div class="row">
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Data', 'Count',],

                <?php
                    $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comms', 'Users', 'Subscribers', 'Categories'];
                    $element_count = [$post_count, $post_draft_count, $comment_count, $unapp_com_count, $user_count, $user_role_count, $categories_count];

                    for ($i = 0;$i < 7; $i++){
                        echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";

                    }

                ?>

               /* ['Posts', 1000, ],*/

            ]);

            var options = {
                chart: {
                    title: '',
                    subtitle: '',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <div id="columnchart_material" style="width: 'auto'px; height: 500px;"></div>
</div>