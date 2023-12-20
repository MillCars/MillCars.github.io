<?php
session_start();
$_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];
// Дополнительный код для отображения формы входа
?>




<?php
session_start(); // Обязательно вызывайте session_start() в самом начале скрипта

// Обработка запроса на аутентификацию
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Получите хэшированный пароль из базы данных для данного пользователя
    $storedHashedPassword = //...;

    // Проверьте пароль
    if (password_verify($password, $storedHashedPassword)) {
        // Пароль верен

        session_start();
         $_SESSION["username"] = $username;
        header("Location: welcome.php");
        exit();
    } else {
      
         echo "Invalid username or password";
    }

    // Вставка токена в форму
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;

    // Перенаправляем пользователя на предыдущую страницу
    $previousPage = $_SERVER["HTTP_REFERER"];
    header("Location: $previousPage");
    exit();
}

// Валидация токена при обработке запроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csrfToken = $_POST['csrf_token'];
    
    if (!empty($csrfToken) && hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        // Токен верен, обрабатываем запрос
    } else {
        // Токен не верен, возможно атака CSRF
        // Вы можете принять меры по обработке этой ситуации
    }
}
?>


<?php
session_start();
// Предполагаемая успешная аутентификация
// ...

// Перенаправление на предыдущую страницу или на главную страницу
$redirectUrl = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '/';
header("Location: $redirectUrl");
exit();
?>

