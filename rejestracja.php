<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main>
        <?php
        include_once("./rejestracja.html");

        $email_exist = false;
        $zapisz = true;

        if (isset($_POST['name'])) {
            try {
                $adres = "localhost";
                $user = "root";
                $password = "";
                $dbname = "bookshop";

                $id = new mysqli($adres, $user, $password, $dbname);

                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $password1 = $_POST['haslo1'];
                // $password2 = $_POST['haslo2'];

                $password_hash = hash('sha256', $password1);
                $query_find_if_exist = "SELECT login FROM users WHERE login='$email'";
                $find_user =  $id->query($query_find_if_exist);

                if ($find_user->num_rows == 0) {
                    $query = "INSERT INTO users (name, last_name, login, password) VALUES ('$name','$lastname', '$email', '$password_hash')";
                    $id->query($query);
                } else {
                    $email_exist = true;
                    header("Location:rejestracja.html", TRUE, 422);
                }
            } catch (Exception $ex) {
            }
        }
        ?>

    </main>


</body>

</html>