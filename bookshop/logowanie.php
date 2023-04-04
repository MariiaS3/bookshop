<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $email = "";
    $password = "";

    $wrong_email = false;
    $wrong_password = false;
    $email_exist = false;

    if (isset($_POST['email'])) {
        try {
            $adres = "localhost";
            $user = "root";
            $password = "";
            $dbname = "bookshop";

            $id = new mysqli($adres, $user, $password, $dbname);

            $email = $_POST['email'];
            $password = $_POST['haslo'];

            $query_find_if_exist = "SELECT login, password FROM users WHERE login='$email'";
            $find_user =  $id->query($query_find_if_exist);
            echo "zalogowano1";


            if ($find_user->num_rows == 0) {
                $email_exist = true;
            } else {
                $password_hash = hash('sha256', $password);
                $rekord = $find_user->fetch_array();
                if ($rekord['password'] == $password_hash) {
                    echo "zalogowano";
                } else {
                    $wrong_password = true;
                }
            }
        } catch (Exception $ex) {
        }
    }
    ?>

    <form action="./logowanie.php" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>" required><br>
        <?php
        if ($email_exist) {
            echo "<p>Użytkownik o takim email nie istnieje</p>";
        }
        ?>
        <label for="haslo">Hasło</label>
        <input type="password" name="haslo" id="haslo" value="<?php echo $password; ?>" required><br>
        <?php
        if ($wrong_password) {
            echo "<p>Błędne hasło</p>";
        }
        ?>
        <input type="submit" value="ZALOGUJ SIĘ">
    </form>


</body>

</html>