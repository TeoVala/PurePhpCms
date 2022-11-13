<?php

ob_start();
session_start();

// Κάνει logout τον χρήστη

        $_SESSION['username'] = null;
        $_SESSION['firstname'] = null;
        $_SESSION['lastname'] = null;
        $_SESSION['user_role'] = null;

        header("Location: ../index.php ");

?>
