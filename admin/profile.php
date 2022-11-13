<?php include "includes/admin_header.php";


    if (isset($_SESSION['username'])){

        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}'";

        $select_user_profile = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($select_user_profile)){
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];

        }
    }

    if (isset($_POST['update_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];


        $query = "UPDATE users SET ";
        $query .= "user_firstname='{$user_firstname}', ";
        $query .= "user_lastname='{$user_lastname}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_password='{$user_password}', ";
        $query .= "user_email='{$user_email}' ";


        $query .= "WHERE username = '{$username}'";

        $update_users = mysqli_query($conn, $query);

        confirm($update_users);

        header('Location: profile.php');

    }
?>

    <div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Profile Page
                        <small><?php echo "{$_SESSION['username']}"; ?></small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname">First name</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                        </div>


                        <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                        </div>





                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">

                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" autocomplete="off" class="form-control" name="user_password">

                        </div>


                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
                        </div>


                    </form>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>