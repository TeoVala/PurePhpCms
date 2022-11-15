<?php  include "includes/header.php"; ?>

    <?php

    // Simple php send mail

    if(isset($_POST['submit'])) {

            $to = "nomail@nomail.com";
            $subject = escape(wordwrap($_POST['subject']), 70);
            $body = mysqli_real_escape_string($conn, $_POST['body']);
            $header = "From: ".mysqli_real_escape_string($conn, $_POST['email']);

            mail($to ,$subject, $body, $header);

        }
    ?>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Please enter your subject">
                        </div>

                        <div class="form-group">
                            <textarea name="body" class="form-control" id="body"  rows="10" ></textarea>
                        </div>


                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
