<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Post Id</th>
            <th>Username</th>
            <th>First name</th>
            <th>Last name</th>
            <th>email</th>
            <th>Role</th>

        </tr>

    </thead>

    <tbody

    <?php

        //Εμφάνιση όλων το users
        $query = "SELECT * FROM users";

        $select_users= mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];



          /*  $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";

            $select_categories_id = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_title = $row['cat_title'];
            }*/
            //Εμφάνιση στο table και buttons για τα edit και delete
            echo "<tr>
                    <td>$user_id</td>
                    <td>$username</td>
                    <td>$user_firstname</td>
                    <td>$user_lastname</td>
                    <td>$user_email</td>
                    <td>$user_role</td>
        
                    <td><a href='users.php?ch_admin={$user_id}'>Admin</a></td>
                    <td><a href='users.php?ch_sub={$user_id}'>Subscriber</a></td>
                    <td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>
                    <td><a onClick=\" javascript: return confirm('Are you sure you want to delete'); \" href='users.php?delete={$user_id}'>Delete</a></td>
    
    
               </tr>";

            /*

            echo "


            </tr>"; */
        }

    ?>

    </tbody>

</table>

<?php

    //Update Delete στο database
    if (isset($_GET['delete'])){

        if (isset($_SESSION['user_role'])) {

            if($_SESSION['user_role'] ='admin') {

            $the_user_id = mysqli_real_escape_string($conn, $_GET['delete']);

            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

            $delete_query = mysqli_query($conn, $query);

            confirm($delete_query);

            header("Location: users.php");

            }
        }
    }

    // Αυτά γίνονται με get το είπε και ο ιδιος καλύτερα να τα έκανες
    // Post αν ήθελες να τα ανεβάσεις

    if (isset($_GET['ch_admin'])){
        $the_user_id = $_GET['ch_admin'];

        $query = "UPDATE users SET user_role='admin' WHERE user_id = $the_user_id";

        $ch_role_query = mysqli_query($conn, $query);

        confirm($ch_role_query);

        header("Location: users.php");

    }
    elseif (isset($_GET['ch_sub'])){
        $the_user_id = $_GET['ch_sub'];

        $query = "UPDATE users SET user_role='subscriber' WHERE user_id = $the_user_id";

        $ch_role_query = mysqli_query($conn, $query);

        confirm($ch_role_query);

        header("Location: users.php");

    }

?>