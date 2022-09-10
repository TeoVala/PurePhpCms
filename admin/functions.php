<?php

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

?>