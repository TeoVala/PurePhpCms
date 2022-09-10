<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit category</label>

        <?php
            // Παίρνει το category id από το '/admin/categories.php' όταν ο χρήστης πατάει το url
            if (isset($_GET['edit'])){

                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE cat_id= {$cat_id}";

                $select_update_categories= mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($select_update_categories)) {

                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    ?>

                    <input value="<?php if(isset($cat_title)){ echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
                    <?php
                }

            }

            // Άμα πατήσεις το link για edit εμφανίζεται αυτό το form για να κάνει edit το category
            if (isset($_POST['update_category'])) {
                $update_cat_title = $_POST['cat_title'];


                $query = "UPDATE categories SET cat_title='{$update_cat_title}' WHERE cat_id = {$cat_id}";
                $update_category_query = mysqli_query($conn, $query);

                if (!$update_category_query) {
                    die("Query Failed: ".mysqli_error($conn));

                }

            }



        ?>



    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">

    </div>

</form>