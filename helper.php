<?php
session_start();

function redirect(string $path){
    header("Location: $path");
    die();
}

function getErrorMessage(string $fieldName){
    echo $_SESSION['validation'][$fieldName] ?? '';
}



function validationErrorAttr(string $fieldName): string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}