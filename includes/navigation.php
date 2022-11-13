<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Cms Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

              <?php

                    // Βάζει τα categories δυναμικά απτο database

                  $query = "SELECT * FROM categories";

                  $select_categories = mysqli_query($conn, $query);

                  // Στο μενού κάνει να φαίνεται active οποιά κατηγορία ή μενου item έχεις διαλέξει

                  while ($row = mysqli_fetch_assoc($select_categories)) {

                      $cat_title = $row['cat_title'];
                      $cat_id = $row['cat_id'];


                      // Activate current page
                      $category_class = '';

                      $registration_class = '';

                      $page_name = basename($_SERVER['PHP_SELF']);

                      $registration = 'registration.php';

                      $contact = 'contact.php';

                      if(isset($_GET['cat_id']) && $_GET['cat_id'] == $cat_id) {

                          $category_class = 'active';
                      }
                      else if ($page_name == $registration) {
                          $registration_class = 'active';

                      }

                      else if ($page_name == $contact) {
                          $contact_class = 'active';

                      }


                      echo "<li class='$category_class'> <a href='/category/$cat_id'> {$cat_title} </a> </li>";

                  }


              ?>

                <!-- Εμφανίζει admin και logout αν είσαι συνδεδεμένος -->


                <?php if(is_logged_in()): ?>

                    <li>
                        <a href="/admin">Admin</a>
                    </li>

                    <li>
                        <a href="/includes/logout.php">Logout</a>
                    </li>

                <?php else: ?>

                <li>
                    <a href="/login">Login</a>
                </li>

                    <?php  endif; ?>


                <!--Στο μενού κάνει να φαίνεται active οποιά κατηγορία ή μενου item έχεις διαλέξει-->

                <li class='<?php echo  $registration_class; ?>'>
                    <a  href="registration">Register</a>
                </li>
                <li class='<?php echo  $contact_class; ?>'>
                    <a  href="contact">Contact</a>
                </li>



                <!--Εμφανίζεται Edit post μέσα στα ποστ του blog στο navigation bar -->

                <?php
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        if (isset($_GET['p_id'])) {
                            $the_post_id = $_GET['p_id'];
                            echo " <li>
                                    <a href='/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit post</a>
                                </li>";
                        }

                    }


                ?>





            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>