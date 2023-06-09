<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.6.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/koszyk.css">
</head>

<body>
    <header>
        <nav>
            <?php
            include_once("./polacz_db.php");
            include_once("./pasek1.php")
            ?>
        </nav>
    </header>
    <main>
        <?php
        include_once("./pasek2.html")
        ?>
        <div id="prawy">
            <section class="container">
                <?php

                if (!isset($_SESSION['koszyk'])) {
                    echo '<p class="kosz">Koszyk jest pusty</p>';
                } else {

                    $koszyk = $_SESSION['koszyk'];
                    $isbn = [];

                    foreach ($_SESSION['koszyk'] as $x => $x_value) {
                        array_push($isbn, $x);
                    }
                    include_once("./polacz_db.php");
                    $query = "SELECT * FROM books WHERE isbn IN ('" . implode("','", $isbn) . "')";
                    $dane = $id->query($query);

                ?>
                    <div class="items">
                        <table>
                            <tr>
                                <th>Tytuł</th>
                                <th>Autor</th>
                                <th>ISBN</th>
                                <th>Cena</th>
                                <th>Ilość</th>
                                <th>Wartość</th>
                            </tr>
                            <?php
                            $sum = 0;

                            while ($rekord = $dane->fetch_array()) {
                                echo '<tr><td><h4 class="tytul">' . $rekord['tytul'] . '</h4></td>';
                                echo '<td><p class="dane">' . $rekord['autor'] . '</p></td>';
                                echo '<td><p class="dane">' . $rekord['isbn'] . '</p></td>';
                                echo '<td><p class="dane">' . $rekord['cena'] . '</p></td>';
                                echo '<td><p class="dane">' . $_SESSION['koszyk'][$rekord['isbn']] . '</p></td>';
                                echo '<td><p class="dane">' . $rekord['cena'] *  $_SESSION['koszyk'][$rekord['isbn']] . '</p></td></tr>';

                                $sum += $rekord['cena'] *  $_SESSION['koszyk'][$rekord['isbn']];
                            }
                            ?>
                        </table>
                        <div class="suma">
                            <?php
                            echo "<p>Wartość książek w koszyku wynosi: $sum</p>";
                            echo '<input type="submit" id="zamow" value="Złóż zamówienie"><br><br>';
                            echo "<a href=\"kasuj.php\">Usuń towary z koszyka</a>";
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
                <script>
                    $(document).ready(function() {
                        <?php
                        if (!isset($_SESSION['username'])) {
                        ?>
                            $('#zamow').click(function() {
                                $.confirm({
                                    title: 'Zamówienie',
                                    content: '<br> Do złożenia zamowienia jest wymagane posiadanie konta. <br> Proszę zarejestruj się jeśli jeszcze nie masz konta w przeciwnym przypadku zaloguj się',
                                    buttons: {
                                        'zaloguj się': function() {
                                            location.href = './logowanie/logowanie.php';
                                        },
                                        'zarejestruj się': function() {
                                            location.href = './rejestracja/rejestracja.php';
                                        },
                                        anuluj: function() {},
                                    }
                                });
                            });
                        <?php
                        } else if (isset($_SESSION['koszyk'])) {

                        ?>
                            $('#zamow').click(function() {
                               location.href = './kasuj.php';
                            });
                        <?php

                        }
                        ?>
                    });
                </script>
            </section>
        </div>
    </main>
    <footer>

    </footer>

</body>

</html>