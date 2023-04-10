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
                
                
                $id = new mysqli($address, $user, $password, $dbname);
                $query = "SELECT * FROM books WHERE isbn IN ('" . implode("','", $isbn) . "')";
                $dane = $id->query($query);
                
                ?>
                <div class="container">
                    <div class="items">
                            <table>
                                <tr>
                                    <th>Tytul</th>
                                    <th>Autor</th>
                                    <th>ISBN</th>
                                    <th>Cena</th>
                                    <th>Ilosc</th>
                                    <th>Wartosc</th>
                                </tr>
                                <?php
                            $j = 0;
                            $sum = 0;
                            while ($rekord = $dane->fetch_array()) {
                                echo '<tr><td><h4 class="tytul">' . $rekord['tytul'] . '</h4></td>';
                                echo '<td><p class="dane">' . $rekord['autor'] . '</p></td>';
                                echo '<td><p class="dane">' . $rekord['isbn'] . '</p></td>';
                                echo '<td><p class="dane">' . $rekord['cena'] . '</p></td>';
                                echo '<td><p class="dane">' . $n[$j] . '</p></td>';
                                echo '<td><p class="dane">' . $rekord['cena'] * $n[$j] . '</p></td></tr>';
                                
                                $sum += $rekord['cena'] * $n[$j];
                                $j++;
                            }
                            ?>
                                </table>
                                <?php
                                    echo "<p>Wartosc w koszyku wynosi: $sum</p>";
                                    echo "<a href=\"kasuj.php\">Usun towary z koszyka</a>";
                                ?>
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