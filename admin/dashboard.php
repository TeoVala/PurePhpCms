<?php include "includes/admin_header.php" ?>


<?php if (!is_admin())
    {
        redirect('/admin/index.php');
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
                            Welcome to the Admin Dashboard

                            <small><?php echo "Hello there ".$_SESSION['username']; ?></small>
                        </h1>




                    </div>
                </div>


                <!-- /.row -->

                <?php include "includes/dashboard_widgets.php" ?>




            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>