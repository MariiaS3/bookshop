
    <div class="navbar-logo">
        <div class="navbar-nav-img">
            <div class="nav-img">
                <img src="./img/ksiazki.gif" width="150px">
            </div>
        </div>
        <div class="navbar-nav-logo">
            <div class="nav-logo">
                <p>Ksiegarnia Internetowa</p>
            </div>
            <div class="log">
                <?php
                    if(!isset($_SESSION['username'])){
                        echo '<a class="nav-link" href="./logowanie.php">Zaloguj się</a>';
                        echo '<a class="nav-link" href="./rejestracja.php">Zarejestruj się</a>';
                    }else{
                       echo '<a class="nav-link" href="./logowanie.php">Wyloguj się</a>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./main.php">Księgarnia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./products.php">Zakupy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./koszyk.php">Koszyk</a>
            </li>
        </ul>
    </div>
