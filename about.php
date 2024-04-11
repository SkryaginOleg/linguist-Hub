<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Контактная форма</title>
</head>

<body>
    <?php require "blocks/header.php" ?>  

    <div class = "container mt-5">
        <h3>Контактная форма</h3>
        <form action="check.php" method="post">
            <input type="email" name = "email" placeholder="Ведите Email" class = "form-control"><br>
            <textarea name="message" class = "form-control" placeholder = "Введите ваше сообщение"></textarea><br>
            <button type = "submit" name = "send" class = "btn btn-success">Отправить</button>
        </form>
    </div>

    <?php require "blocks/footer.php" ?> 
  
</body>
</html>