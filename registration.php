<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вікно реєстрації та авторизації</title>

    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/script-reg.js" defer></script>
    <script src="JS/script-reg-ajax.js"></script>

</head>

<body>
    <style>
        /*Error*/

        .form__input.error {
            border-bottom: 2px solid red;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .googlebtn {
            height: 40px;
            width: 200px;
            color: black;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            border-radius: 5px;
            border: 1px solid black;
            margin-top: 10px;
        }

        .googlebtn img {
            margin-right: 10px;
            width: 25px;
            height: 25px;
        }
    </style>
    <article class="container">

        <div class="block">

            <section class="block__item block-item">
                <h2 class="block-item__title">У вас вже є акаунт?</h2>
                <button class="block-item__btn signin-btn">Війти</button>
            </section>
            <section class="block__item block-item">
                <h2 class="block-item__title">У вас немає акаунту?</h2>
                <button class="block-item__btn signup-btn">Зареєструватися</button>
            </section>

        </div>


        <div class="form-box">


            <form action="actions/login.php" method="post" class="form form_signin" name="signinForm" onsubmit="return checkSignInForm();">
                <h3 class="form__title">Вхід</h3>

                <p>
                    <input type="login" class="form__input" placeholder="Логін" name="login" oninput="removeError('signinForm', 'login');">
                </p>

                <p>
                    <input type="password" class="form__input" placeholder="Пароль" name="password" oninput="removeError('signinForm', 'password');">
                </p>

                <p>
                    <button type="submit" class="form__btn">Війти</button>
                </p>

                <p>
                    <a href="#" class="form__forgot">Відновити Пароль</a>
                </p>

                <?php
                require_once 'LibApi' . '/vendor/autoload.php';

                $clientID = '519186468841-tanr04jan9kdhatf1m0hflvpqojj4snj.apps.googleusercontent.com';
                $clientSecret = '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';
                $redirectUri = 'http://localhost/registration.php';

                $client = new Google\Client();
                $client->setClientId($clientID);
                $client->setClientSecret($clientSecret);
                $client->setRedirectUri($redirectUri);
                $client->addScope('email');
                $client->addScope('profile');

                // authenticate code Google OAUTH
                if (isset($_GET['code'])) {
                    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                    $client->setAccessToken($token['access_token']);

                    // get info
                    $google_oauth = new Google\Service\Oauth2($client);
                    $google_account_info = $google_oauth->userinfo->get();
                    $email = $google_account_info->email;
                    $name = $google_account_info->name;


                    // DB finder
                    require "DataBase/db.php";

                    // DB finder
                    require "DataBase/db.php";

                    // Check if the connection was successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Prepare the query with placeholders
                    $query = "SELECT * FROM `User` WHERE `User`.`full_name` = ? AND `email` = ?";
                    $stmt = $conn->prepare($query);

                    // Check if the prepare() call succeeded
                    if (!$stmt) {
                        die("Error preparing statement: " . $conn->error);
                    }

                    // Bind parameters
                    $stmt->bind_param("ss", $name, $email);

                    // Set parameters and execute
                    $stmt->execute();

                    // Get the result set
                    $result = $stmt->get_result();

                    // Check if there are rows returned
                    if ($result->num_rows > 0) {
                        // Fetch the first row as an associative array
                        $user = $result->fetch_assoc();

                        // Extract user ID
                        $user_id = $user["user_id"];
                        session_start();
                        $_SESSION['user'] = $user_id;
                        setcookie("user", $user_id, time() + 60 * 60 * 60);
                        header("Location: index.php");
                    } else {
                        // No user found, insert new user
                        $query = "INSERT INTO `User`(`User`.`full_name`, `email`,`password`,`photo`) VALUES (?, ?,1,?)";
                        $stmt = $conn->prepare($query);

                        // Bind parameters for the insert statement
                        $stmt->bind_param("sss", $name, $email, $img);

                        // Execute the insert statement
                        if ($stmt->execute()) {
                            $user_id = $stmt->insert_id;
                            setcookie('user', $user_id, time() + 60 * 60 * 60);
                            session_start();
                            $_SESSION['user'] = $user_id;
                            header("Location: index.php");
                        } else {
                            echo "Error inserting user: " . $conn->error;
                        }
                    }

                    // Close the statement
                    $stmt->close();

                    // Close the database connection
                    $conn->close();
                }
                $authUrl = $client->createAuthUrl();
                echo '<a href="' . htmlspecialchars($authUrl) . '" style="display: inline-block; text-decoration: none; border: none; background: none; padding: 0;">
    <img src="https://onymos.com/wp-content/uploads/2020/10/google-signin-button.png" alt="Продовжити з Google" style="cursor: pointer; width: 230px; height: 60px; max-width: 300; max-height: 300;">
  </a>';

                ?>
            </form>



            <form method="post" class="form form_signup" id="signupForm" name="signupForm">
                <h3 class="form__title">Реєстрація</h3>

                <p><input type="login" class="form__input" placeholder="Логін" name="login" oninput="removeError('signupForm', 'login');"></p>

                <p><input type="email" class="form__input" placeholder="Email" name="email" oninput="removeError('signupForm', 'email');"></p>

                <p><input type="password" class="form__input" placeholder="Пароль" name="password" oninput="removeError('signupForm', 'password');"></p>

                <p><input type="password" class="form__input" placeholder="Підтвердіть пароль" name="repassword" oninput="removeError('signupForm', 'repassword');"></p>

                <p><button type="submit" class="form__btn form__btn__signup">Зареєструватися</button></p>
            </form>
        </div>
    </article>
</body>

</html>