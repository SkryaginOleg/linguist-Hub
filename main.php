<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style_main.css">
    <title>Document</title>
</head>


<?php
session_start();
$_SESSION['current_page'] = 'main';

require_once 'db.php';
require_once __DIR__ . '/Class/WebPage.php';

$webpage1 = new MainPage("WebPage 1", "Курси");
$webpage1->displayHeader();
$webpage1->displayContent();
$webpage1->displayFooter();

?>