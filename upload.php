<?php
require_once 'DataBase/db.php';
session_start();

if (isset($_POST['save'])) {
    $img_type = substr($_FILES['img_upload']['type'], 0, 5);
    $img_size = 1024 * 1024;

    if (!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] < $img_size) {
        $img_blob = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
        //$user_id = intval($_COOKIE['user']);
        $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

        $conn->query("UPDATE User SET photo = '$img_blob' WHERE user_id = $userId");
    }
}

if (isset($_POST['delete'])) {
    //$user_id = intval($_COOKIE['user']);
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);
    $conn->query("UPDATE User SET photo = NULL WHERE user_id = $userId");
}


if (isset($_COOKIE['user'])) {

    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);
    
    $query = $conn->query("SELECT photo FROM User WHERE user_id = " . $userId . "");
    $row = $query->fetch_assoc();

    if ($row['photo']) {
        $img = base64_encode($row['photo']);
    } else {
        $default_image_path = "IMG/user_male4-256.webp";
        $img = base64_encode(file_get_contents($default_image_path));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('userImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function sendAjaxRequest(formData) {

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "upload.php", true);

            xhr.send(formData);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    document.getElementById("userImage").src = response;
                }
            };
        }



            document.getElementById("uploadForm").addEventListener("submit", function(event) {

                event.preventDefault();

                var formData = new FormData(this);                
                sendAjaxRequest(formData);
            });
    </script>
</head>

<body>
    <img id="userImage" src="data:image/jpeg;base64, <?php echo $img; ?>" alt="User Image" style="max-width: 200px;" onclick="document.getElementById('imgUpload').click();">

    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="imgUpload" name="img_upload" accept="image/png, image/jpeg, image/jpg, image/gif" style="display:none;" onchange="previewImage(event)">
        <button type="submit" name="save">Изменить</button>
    </form>

    <form action="upload.php" method="post">
        <button type="submit" name="delete">Удалить фото</button>
    </form>
</body>

</html>