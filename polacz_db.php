<?php
    $adres = "localhost";
    $user = "root";
    $password = "";
    $dbname = "bookshop";
    try {
        $id = new mysqli($adres, $user, $password, $dbname);
    } catch (Exception $ex) {
        $komunikat = $ex->getMessage();
        echo $komunikat;
        echo "<p>Błąd przepraszamy</p>";
    }

    session_start();
?>