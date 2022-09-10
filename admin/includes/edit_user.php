<?php
    // Παίρνει το user id από το '/admin/users.php' όταν ο χρήστης πατάει το url
    if(isset($_GET['edit_user'])){
        $the_user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $the_user_id";

        $select_users_query= mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($select_users_query)) {
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];

        }


    }

    // Κάνει set στο database τα input του χρήστη
    if (isset($_POST['edit_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];


        /*   $post_image = $_FILES['image']['name'];
           $post_image_temp = $_FILES['image']['tmp_name'];*/



        /*$post_date = date('d-m-y');


        move_uploaded_file($post_image_temp, "../images/$post_image");

    */

        $query = "UPDATE users SET ";
        $query .= "user_firstname='{$user_firstname}', ";
        $query .= "user_lastname='{$user_lastname}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_password='{$user_password}', ";
        $query .= "user_email='{$user_email}', ";
        $query .= "user_role='{$user_role}' ";

        $query .= "WHERE user_id = {$the_user_id}";

        $update_users = mysqli_query($conn,$query);

        confirm($update_users);

        header('Location: users.php');

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

            <option value="subscriber"><?php echo ucfirst($user_role); ?></option>

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
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">

    </div>


    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Submit">
    </div>


</form>