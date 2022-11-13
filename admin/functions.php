<?php
// ==== Database Helper  ==== //

    
    function redirect($location) {
        return header("Location: ".$location);
        exit;

    }

    function query($query) {

        global $conn;

        $result = mysqli_query($conn, $query);

        confirm($result);

        return $result;


    }

    function fetch_records($result){

        return mysqli_fetch_array($result);
    }


// ==== Database Helper END ==== //

// ==== Auth Helper  ==== //


function is_admin() {
    if(is_logged_in()){

        $result = query("SELECT user_role FROM users WHERE user_id = ".$_SESSION['user_id']."");

        confirm($result);

        $row =  fetch_records($result);

        if ($row['user_role'] == 'admin') {
            return true;

        }

        else {
            return false;

        }

    }
    return false;
}


function is_logged_in() {

    if(isset($_SESSION['user_role'])){
        return true;

    }

    return false;


}

// ==== Auth Helper END ==== //


    function imagePlaceholder($image='') {
        if (!$image){

            return 'image_1.jpg';
        }
        else {
            return $image;
        }
    }

    function ifItIsMethod($method=null) {

        if($_SERVER['REQUEST_METHOD']== strtoupper($method)) {
            return true;

        }

            return false;

    }

    function logged_in_user_id() {

        if (is_logged_in()) {

            $result = query("SELECT * FROM users WHERE username ='".$_SESSION['username']."'");
            confirm($result);
            $user = mysqli_fetch_array($result);

            return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;

        }

        return false;

    }

    function user_liked_this_post($post_id) {

        $result = query("SELECT * FROM likes WHERE user_id=" .logged_in_user_id() . " AND post_id={$post_id}");
        confirm($result);
        return mysqli_num_rows($result) >= 1 ? true : false;

    }

    function get_post_likes($post_id) {

        $result = query("SELECT * FROM likes WHERE post_id=$post_id");
        confirm($result);

        echo mysqli_num_rows($result);
    }


    function currentUser() {

        if (isset($_SESSION['username'])){

            return $_SESSION['username'];

        }
    }


    function is_logged_redirect($redirectLocation=null){

    if(is_logged_in()){

        redirect($redirectLocation);

    }

    }


function escape($data){
        global $conn;

        return mysqli_real_escape_string($conn, trim($data));
    }

    function confirm($result) {
        global $conn;

        if (!$result){
           die('Query Failed: '.mysqli_error($conn));

        }

    }

    function insert_categories() {
        global $conn;

        if (isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || $cat_title == " " || empty($cat_title)) {
                echo "This field shouldn't be empty";

            }

            else {
                $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";

                $create_category_query = mysqli_query($conn, $query);

            }

        }
    }


    function findAllCategories(){
        global $conn;

        //Find all categories table
        $query = "SELECT * FROM categories";

        $select_categories_admin = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($select_categories_admin)) {

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];


            echo "<tr>
                    <td>{$cat_id}</td>
                    <td>{$cat_title}</td>
                    <td><a href='categories.php?delete={$cat_id}'>Delete</td></a>
                    <td><a href='categories.php?edit={$cat_id}'>Edit</td></a>
                </tr>";

        }

    }

    function deleteCategories(){
        global $conn;

        // Delete
        if (isset($_GET['delete'])){
            $del_cat_id = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id}";
            $delete_category_query = mysqli_query($conn, $query);

            header("Location: categories.php");
        }


    }

function users_online() {

    if(isset($_GET["onlineUsers"])) {
        global $conn;

    if (!$conn) {

        session_start();

        include ("../includes/db.php");

        // Users online
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";

        $send_query = mysqli_query($conn, $query);

        $count = mysqli_num_rows($send_query);

        if ($count == NULL) {
            mysqli_query($conn, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");

        } else {
            mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }

        $users_online_mysqli_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time>'$time_out'");
        echo "Users Online: ".$count_user = mysqli_num_rows($users_online_mysqli_query);

        }
    } // get request isset()


}
users_online();

    function recordCount ($table) {
        global $conn;

        $query = "SELECT count(*) FROM $table";
        $table_count_query = mysqli_query($conn, $query);

        confirm($table_count_query);

        $result = mysqli_fetch_array($table_count_query);

        return $table_count = $result[0];
    }

function checkStatus($table, $column, $status) {
    global $conn;

    $query = "SELECT COUNT(*) FROM $table WHERE $column ='$status'";
    $table_count_query = mysqli_query($conn, $query);

    confirm($table_count_query);

    $result = mysqli_fetch_array($table_count_query);

    return $table_count = $result[0];

}

// === User Functions === //

function recordCount_user ($table,$user_col,$username) {
    global $conn;

    $query = "SELECT count(*) FROM $table WHERE $user_col='$username'";
    $table_count_query = mysqli_query($conn, $query);

    confirm($table_count_query);

    $result = mysqli_fetch_array($table_count_query);

    return $table_count = $result[0];
}

function checkStatus_user($table, $column, $status, $user_col, $username) {
    global $conn;

    $query = "SELECT COUNT(*) FROM $table WHERE $column ='$status' AND $user_col='$username'";
    $table_count_query = mysqli_query($conn, $query);

    confirm($table_count_query);

    $result = mysqli_fetch_array($table_count_query);

    return $table_count = $result[0];

}

// === User Functions END === //



function username_exists($username) {
        global $conn;

        $query = "SELECT username FROM users WHERE username = '$username'";

        $result = mysqli_query($conn, $query);

        confirm($result);

        if(mysqli_num_rows($result) > 0) {
            return true;

        }
        else {
            return false;

        }


}

function email_exists($email) {

    global $conn;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $query);
    confirm($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }

}


function register_user($username, $email, $password)
{
    global $conn;

    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $query = "INSERT INTO users(username, user_email, user_password, user_role)";
    $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";

    $register_user_query = mysqli_query($conn, $query);

    confirm($register_user_query);

}

function login_user($username, $password) {
    global $conn;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE username= '{$username}'";
    $select_user_query = mysqli_query($conn, $query);

    confirm($select_user_query);

    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        /*$new_password = crypt($password, $db_password);*/


        // Κάνει set τα στοιχεία του χρήστη στο session και κάνει redirect

        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $db_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['user_role'] = $db_user_role;


            /*header("Location: ../admin");*/
            redirect("../admin");

        }

        else {
            /*header("Location: ../index.php");*/
            /*redirect("../index.php");*/
            return false;
        }

    }



}



?>