<?php
// Генерируем хэш пароля
$password = "secret_password";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Выводим хэш для использования в других местах
echo $hashedPassword;
?>
