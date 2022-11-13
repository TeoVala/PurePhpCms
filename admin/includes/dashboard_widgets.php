
<?php

    /* Στο tutorial το κάνει έτσι εγώ έκανα το count μέσα στην mysql
        $query = "SELECT * FROM posts";
        $select_all_post = mysqli_query($conn, $query);
        $post_counts = mysqli_num_rows($select_all_post);

        <div class='huge'><?php echo $post_counts ?></div>

    */

    // Queries για να λαμβάνουν τa data απ'το database

    if (is_admin()) {
        $post_publish_count = checkStatus('posts', 'post_status', 'published');

        $post_count = recordCount('posts');

        /* Βρίσκει ποια post είναι σε Draft */

        $post_draft_count = checkStatus('posts', 'post_status', 'draft');

        $comment_count = recordCount('comments');

        $unapp_com_count = checkStatus('comments', 'comment_status', 'unapproved');

        $user_count = recordCount('users');

        $user_role_count = checkStatus('users', 'user_role', 'subscriber');

        $categories_count = recordCount('categories');

    } else {

        $post_publish_count = checkStatus_user('posts', 'post_status', 'published', 'post_user' ,$_SESSION['username']);

        $post_count = recordCount_user('posts', 'post_user',$_SESSION['username']);

        /* Βρίσκει ποια post είναι σε Draft */

        $post_draft_count = checkStatus_user('posts', 'post_status', 'draft', 'post_user', $_SESSION['username']);

        $comment_count = recordCount('comments');

        $unapp_com_count = checkStatus('comments', 'comment_status', 'unapproved');

        $user_count = recordCount('users');

        $user_role_count = checkStatus('users', 'user_role', 'subscriber');

        $categories_count = recordCount('categories');
    }


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

    <?php if(is_admin()) : ?>
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
    <?php endif; ?>
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
                    $element_text = ['All posts','Active Posts', 'Draft Posts', 'Comments', 'Pending Comms', 'Users', 'Subscribers', 'Categories'];
                    $element_count = [$post_count, $post_publish_count, $post_draft_count, $comment_count, $unapp_com_count, $user_count, $user_role_count, $categories_count];

                    for ($i = 0;$i < 8; $i++){
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