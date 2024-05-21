
<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вікно реєстрації та авторизації</title>

    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/script.js" defer></script>
    <script src="JS/script_form.js"></script>

</head>

<body>

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
                <?php
    $params = array(
        'client_id'     => '519186468841-tanr04jan9kdhatf1m0hflvpqojj4snj.apps.googleusercontent.com',
        'redirect_uri'  => 'http://localhost/Linguist%20Hub/index.php', // Ensure this matches with Google Console
        'response_type' => 'code',
        'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'state'         => '123'
    );

    $url = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($params); // Changed urldecode to http_build_query
    echo '<a href="' . $url . '">Авторизация через Google</a>';

    if (!empty($_GET['code'])) {
        // Sending the code to get the token (POST request).
        $params = array(
            'client_id'     => '519186468841-tanr04jan9kdhatf1m0hflvpqojj4snj.apps.googleusercontent.com',
            'client_secret' => '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',
            'redirect_uri'  => 'http://localhost/Linguist%20Hub/index.php', // Ensure this matches with Google Console
            'grant_type'    => 'authorization_code',
            'code'          => $_GET['code']
        );

        $ch = curl_init('https://accounts.google.com/o/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params)); // Changed to http_build_query
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Set to true for security
        $data = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($data, true);
        if (!empty($data['access_token'])) {
            // Token received, now getting user data.
            $params = array(
                'access_token' => $data['access_token'],
            );

            $info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . http_build_query($params)); // Changed urldecode to http_build_query
            $info = json_decode($info, true);
                $user_email = $info['email'];
                $user_name = $info['name'];
               
               
            echo $user_email . $user_name ;
        }
    }
?>

                
                    <a href="#" class="form__forgot">Відновити Пароль</a>
                </p>

            </form>



            <form method="post" class="form form_signup" id = "signupForm" name="signupForm">
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