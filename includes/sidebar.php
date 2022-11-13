<div class="col-md-4">

    <!-- Blog Search με input, χρησιμοποιεί τα tags για το search -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name = "search" type="text" class="form-control">
            <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </div>
        </form><!-- Search form -->
        <!-- /.input-group -->
    </div>


    <!-- Σύνδεση χρήστη -->
    <div class="well">

        <?php if(isset($_SESSION['user_role'])): ?>

            <h4>Logged in as <?php echo $_SESSION['username']?></h4>
            <a href="/includes/logout.php" class="btn btn-primary">Logout</a>

        <?php  else: ?>

            <?php
            is_logged_redirect('/admin/');

            if (ifItIsMethod('post')){

                if (isset($_POST['login'])){

                    if (!empty($_POST['username']) && !empty($_POST['password'])) {

                        login_user($_POST['username'], $_POST['password']);

                    }

                    else {

                        redirect('/login');
                    }

                }
            }

            ?>

            <h4>Login</h4>
            <form action="" method="post">
                <div class="form-group">
                    <input name = "username" type="text" class="form-control" placeholder="Enter username">

                </div>

                <div class="input-group">
                    <input name = "password" type="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Submit</button>

                    </span>

                </div>

                <div class="form-group">
                    <a href="/forgot?forgot=<?php echo uniqid(true); ?>">Forgot password</a>

                </div>

            </form><!-- Search form -->
            <!-- /.input-group -->


        <?php  endif; ?>




    </div>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    //Sort τα Post στην αρχική με τα categories. $_GET

                    $query = "SELECT * FROM categories";

                    $select_categories_sidebar = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {

                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li> <a href='category.php?cat_id=$cat_id'> {$cat_title} </a> </li>";

                    }

                    ?>

                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>