<?php
         // echo "zalogowano";
                                    // $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
                                    // $issuedAt   = new DateTimeImmutable();
                                    // $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();
                                    // $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
                                    // $payload = json_encode([
                                    //     'iat'  => $issuedAt->getTimestamp(),                          
                                    //     'nbf'  => $issuedAt->getTimestamp(),         
                                    //     'exp'  => $expire, 
                                    //     'user_name' => $email ]);    
                                    // $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
                                    // $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
                                    // $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secretKey, true);
                                    // $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
                                    // $token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
                                    
                                    // session_start();
                                    // $_SESSION['token']='Bearer '+$token;
                                    // $_SESSION['start'] = time();
                                    // $_SESSION['expire'] = $_SESSION['start'] + (60 * 60 * 24);
?>
