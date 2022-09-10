<?php

    //Δημιουργία χρήστη
    if (isset($_POST['create_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        //Προσθήκη εικόνα χρήστη και date

     /*   $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];*/

        /*$post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");
*/

        $query = "INSERT INTO users(user_firstname, user_lastname,user_role, username, user_email,user_password)";

        $query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', 
        '{$user_password}' )";

        $create_user_query = mysqli_query($conn, $query);

        confirm($create_user_query);


        //Μήνυμα ότι ο χρήστης δημιουργήθηκε με επιτυχία
        echo "User Created: "." "."<a href='users.php'>View Users</a> ";


    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">First name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>


    <div class="form-group">
        <label for="lastname">Last name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <label for="role">Role</label>
        <select name="user_role" id="">
            <option value="subscriber">Select options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
            
        </select>
    </div>


    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">

    </div>


    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password">

    </div>


    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create">
    </div>

</form>