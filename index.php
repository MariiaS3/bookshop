<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <nav>
            <?php
                session_start();
                include_once("./pasek1.php")
            ?>
        </nav>
    </header>
    <main>
        <?php
            include_once("./pasek2.html")
        ?> 
        <div id="prawy">
            <h1>Nasza ksiegarnia</h1>
            <section>
                <p>opis sklepu</p>
            </section>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>