<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./koszyk.css">
</head>

<body>
    <main>
        <?php
        include_once("./pasek.html")
        ?>
        <?php
        $address = "localhost";
        $user = "root";
        $password = "";
        $dbname = "bookshop";

        session_start();
        if (!isset($_SESSION['koszyk'])) {
            echo "<p>Koszyk jest pusty</p>";
        } else {
            try {

                $koszyk = $_SESSION['koszyk'];
                $isbn = [];
                $n = [];
               
                for ($i = 0, $j = 1; $i < count($koszyk); $i += 2, $j += 2) {
                    // echo '<p>'.$koszyk[$i]." => ".$koszyk[$j].'</p>';
                    array_push($isbn, $koszyk[$i]);
                    array_push($n, $koszyk[$j]);
                }
                $count = count($isbn);
                $placeholders = implode(',', array_fill(0, $count, '?'));

                echo "<a href=\"kasuj.php\">Kasuj koszyk</a>";

                $id = new mysqli($address, $user, $password, $dbname);

                $query = "SELECT * FROM books WHERE isbn IN ($placeholders)";
                $dane = $id->query($query);
        ?>
                <div class="container">
                    <div class="items">
                        <ul>
                            <?php
                            $j = 0;
                            while ($rekord = $dane->fetch_assoc()) {
                            ?>
                                <li class="item">
                                    <div class="opis">
                                        <div class="tytul">
                                            <?php
                                            echo '<h2 class="tytul">' . $rekord['tytul'] . '</h2>';
                                            echo '<p class="dane">Autor: ' . $rekord['autor'] . '</p>';
                                            echo '<p class="dane">ISBN: ' . $rekord['isbn'] . '</p>';
                                            echo '<p class="dane">Cena : ' . $rekord['cena'] . '</p>';
                                            echo '<p class="dane">Ilość : ' . $n[$j] . '</p>';
                                            echo '<p class="dane">Wartość : ' . $rekord['cena'] * $n[$j] . '</p>';
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            <?php
                                $j++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
        <?php

            } catch (Exception $th) {
                $komunikat = $th->getMessage();
                echo $komunikat;
                echo "<p>Błąd przepraszamy</p>";
            }
        }
        ?>

    </main>
</body>

</html>