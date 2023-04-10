<?php
    session_start();
    unset($_SESSION['koszyk']); 
    session_destroy();
    session_unset();
    header("Location:koszyk.php");
?>