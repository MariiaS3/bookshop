<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./main.css">
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
        if(!isset($_SESSION['koszyk'])){
            echo "<p>Koszyk jest pusty</p>";
        }else{
            try {

                $koszyk=$_SESSION['koszyk'];
                $isbn=[];
                $n=[];
                for ($i=0, $j=1; $i<count($koszyk); $i+=2, $j+=2) {
                    // echo '<p>'.$koszyk[$i]." => ".$koszyk[$j].'</p>';
                    array_push($isbn, $koszyk[$i]);
                    array_push($n, $koszyk[$j]);
                }
                echo "<a href=\"kasuj.php\">Kasuj koszyk</a>";
                
                $id = new mysqli($address, $user, $password, $dbname);

                $query = "SELECT * FROM books WHERE isbn IN '.$isbn.';";
                $dane = $id->query($query);
        ?>
                <div class="container">
                    <div class="items">
                        <ul>
                            <?php
                            $m = 1;
                            while ($rekord = $dane->fetch_array()) {
                            ?>
                                <li class="item">
                                    <div class="opis">
                                        <div>
                                            <?php
                                            echo '<img src="./img/book' . $m . '.png">';

                                            echo '<p></p>';
                                            ?>
                                        </div>
                                        <div class="tytul">
                                            <?php
                                            echo '<h2 class="tytul">' . $rekord['tytul'] . '</h2>';
                                            echo '<p class="dane">Autor: ' . $rekord['autor'] . '</p>';
                                            echo '<p class="dane">ISBN: ' . $rekord['isbn'] . '</p>';
                                            ?>
                                        </div>
                                        <div class="cena">
                                            <?php
                                            echo '<h3>' . $rekord['cena'] . ' zł</h3>';
                                            ?>
                                            <form method='get' action="#">
                                                <input type="hidden" name="id_book" value="<?= $rekord['isbn'] ?>">
                                                <input class="dodaj-do-kosz" type="submit" value="Dodaj do koszyka" /><br>
                                                <input type="number" class="num" name="num" value="1" min="0" max="999">
                                                <i class="stan"> z <?= $rekord['stan'] ?> sztuk</i>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            <?php
                                $m++;
                                if ($m >= 8) {
                                    $m = 1;
                                }
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