<?php
    session_start();
    if(!isset($_SESSION["useremail"])) {
        header("Location: login.php");
        exit();
    }
?>