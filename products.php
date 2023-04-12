<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <script src="jquery-3.6.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./products.css">
</head>

<body>
    <main>
        <?php
        include_once("./pasek.php")
        ?>
        <?php
        $address = "localhost";
        $user = "root";
        $password = "";
        $dbname = "bookshop";

        try {
            $id = new mysqli($address, $user, $password, $dbname);

            $query = "SELECT isbn, autor, tytul, cena, stan FROM books";
            $dane = $id->query($query);


            if (isset($_GET['id_book'])) {
                session_start();

                if (!isset($_SESSION['koszyk'])) {
                    $_SESSION['koszyk'] = [];
                }

                $_SESSION['koszyk'][$_GET['id_book']] = $_GET['num'];
            }
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
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('form').submit(function(e) {
                                                    e.preventDefault();
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "products.php",
                                                        data: $(this).serialize()
                                                    });
                                                });
                                            });
                                        </script>

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
        ?>
    </main>
</body>

</html>