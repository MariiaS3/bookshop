<?php
   $isbn = [];
   include_once("./polacz_db.php");

   foreach ($_SESSION['koszyk'] as $x => $x_value) {
       array_push($isbn, $x);
   }
   $query = "SELECT * FROM books WHERE isbn IN ('" . implode("','", $isbn) . "')";
   $dane = $id->query($query);

while ($rekord = $dane->fetch_array()) {
    $stan = $rekord['stan'] -  $_SESSION['koszyk'][$rekord['isbn']];
    $query = "UPDATE books SET stan=$stan WHERE isbn='" . $rekord['isbn'] . "';";
    $id->query($query);
}

    session_start();
    unset($_SESSION['koszyk']); 
    header("Location:koszyk.php");
?>