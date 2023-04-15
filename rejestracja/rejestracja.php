<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.6.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/rejestracja.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="panels">
                <div class="panel">
                    <h2>REJESTRACJA</h2>
                    <?php
                    include_once("./rejestracja.html");

                    $email_exist = false;
                    $zapisz = true;

                    if (isset($_POST['name'])) {

                            include_once("../polacz_db.php");

                            $name = $_POST['name'];
                            $lastname = $_POST['lastname'];
                            $email = $_POST['email'];
                            $password1 = $_POST['haslo1'];

                            $password_hash = hash('sha256', $password1);
                            $query_find_if_exist = "SELECT login FROM users WHERE login='$email'";
                            $find_user =  $id->query($query_find_if_exist);

                            if ($find_user->num_rows == 0) {
                                $query = "INSERT INTO users (name, last_name, login, password) VALUES ('$name','$lastname', '$email', '$password_hash')";
                                $id->query($query);
                                header("Location:../logowanie/logowanie.php");
                            } else {
                                $email_exist = true;
                                header("Location:rejestracja.html", TRUE, 422);
                            }
                    
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>