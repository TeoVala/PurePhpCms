<?php


    // Παίρνει το user id από το '/admin/users.php' όταν ο χρήστης πατάει το url
    if(isset($_GET['edit_user'])) {
        $the_user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $the_user_id";

        $select_users_query = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($select_users_query)) {

            $user_id        = $row['user_id'];
            $username       = $row['username'];
            $user_password  = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_email     = $row['user_email'];
            $user_role      = $row['user_role'];

        }



        if (isset($_POST ['edit_user'])) {

            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_role = $_POST['user_role'];


            // Κάνει set στο database τα input του χρήστη
            if (!empty($user_password)) {
                $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
                $get_user_query = mysqli_query($conn, $query_password);
                confirm($get_user_query);

                $row = mysqli_fetch_array($get_user_query);

                $db_user_password = $row['user_password'];

                if ($db_user_password != $user_password) {
                    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 12]);
                }

                $query = "UPDATE users SET ";
                $query .= "user_firstname='{$user_firstname}', ";
                $query .= "user_lastname='{$user_lastname}', ";
                $query .= "username = '{$username}', ";
                $query .= "user_password='{$hashed_password}', ";
                $query .= "user_email='{$user_email}', ";
                $query .= "user_role='{$user_role}' ";

                $query .= "WHERE user_id = {$the_user_id}";

                $update_users = mysqli_query($conn, $query);

                confirm($update_users);

                /* header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);*/
                //Μήνυμα ότι ο χρήστης δημιουργήθηκε με επιτυχία

                echo "<p class='bg-success'>User Updated </p>";
            }

        }

    } else {
        header("Location:index.php");

    }


?>

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
        <label for="role">Role</label>
        <select name="user_role" id="">

            <option value="<?php echo $user_role; ?>"><?php echo ucfirst($user_role); ?></option>

            <?php
                if ($user_role == 'admin') {
                    echo "<option value='subscriber'>Subscriber</option>";
                }

                else {
                    echo "<option value='admin'>Admin</option>";

                }


            ?>

        </select>
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Submit">
    </div>


</form>