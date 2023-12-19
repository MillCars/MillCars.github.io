<?php
session_start();
$_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];
// Дополнительный код для отображения формы регистрации
?>




<?php
session_start(); // Обязательно вызывайте session_start() в самом начале скрипта

// Обработка запроса на регистрацию
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Здесь вы должны сохранить учетные данные в базе данных или другом месте.
    // В реальном приложении реализуйте безопасный механизм хранения паролей.

    // Предположим, что регистрация успешна.
    // В реальном приложении замените этот код на сохранение ваших данных.
    // ...

    // Перенаправляем пользователя на предыдущую страницу
    $previousPage = $_SERVER["HTTP_REFERER"];
    header("Location: $previousPage");
    exit();
}

// Генерация хэша пароля в момент регистрации
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Сохраните $hashedPassword в базу данных

// Вставка токена в форму
$csrfToken = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrfToken;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" action="your_registration_script.php">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <!-- Добавьте другие поля формы для ввода имени пользователя и пароля -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>


<?php
session_start();
// Предполагаемая успешная регистрация
// ...

// Перенаправление на предыдущую страницу или на главную страницу
$redirectUrl = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '/';
header("Location: $redirectUrl");
exit();
?>
