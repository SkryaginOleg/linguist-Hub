
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