<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.6.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./logowanie.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="panels">
                <div class="panel">
                    <h2>LOGOWANIE</h2>
                    <?php
                    use \Firebase\JWT\JWT;

                    include_once("./logowanie.html");

                    $email_exist = false;
                    $zapisz = true;

                    if (isset($_POST['email'])) {
                        try {
                            $adres = "localhost";
                            $user = "root";
                            $password = "";
                            $dbname = "bookshop";

                            $id = new mysqli($adres, $user, $password, $dbname);

                            $email = $_POST['email'];
                            $password = $_POST['haslo'];

                            $password_hash = hash('sha256', $password);
                            $query_find_if_exist = "SELECT login, password FROM users WHERE login='$email'";
                            $find_user =  $id->query($query_find_if_exist);

                            if ($find_user->num_rows != 0) {
                                $password_hash = hash('sha256', $password);
                                $rekord = $find_user->fetch_array();
                                if ($rekord['password'] == $password_hash) {
                                    echo "zalogowano";
                                    $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
                                    $issuedAt   = new DateTimeImmutable();
                                    $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();
                                    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
                                    $payload = json_encode([
                                        'iat'  => $issuedAt->getTimestamp(),                          
                                        'nbf'  => $issuedAt->getTimestamp(),         
                                        'exp'  => $expire, 
                                        'user_name' => $email ]);    
                                    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
                                    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
                                    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secretKey, true);
                                    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
                                    $token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
                                    
                                    session_start();
                                    $_SESSION['użutkownik']='Bearer '+$token;

                                } else {
                                    header("Location:rejestracja.html", TRUE, 401);
                                }
                            }
                        } catch (Exception $ex) {
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>