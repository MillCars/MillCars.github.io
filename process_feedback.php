<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Проверяем, что запрос пришел методом POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем данные отзыва
    $feedbackText = isset($_POST["feedback"]) ? $_POST["feedback"] : '';

    // Здесь вы можете выполнить любую дополнительную обработку данных отзыва
    // Например, сохранение в базу данных или отправка по электронной почте

    // В этом примере просто выводим отзыв в консоль
    error_log("Received feedback: " . $feedbackText);

    // Отправляем успешный ответ клиенту
    echo "Success";
} else {
    // Если запрос не методом POST, отправляем ошибку метода
    http_response_code(405);
    echo "Method Not Allowed";
}
?>


<?php
// Включаем вывод ошибок для отладки (в реальном приложении лучше выключить)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверяем, что запрос пришел методом POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем данные отзыва
    $feedbackText = isset($_POST["feedback"]) ? $_POST["feedback"] : '';

    // Здесь вы можете выполнить любую дополнительную обработку данных отзыва
    // Например, сохранение в базу данных или отправка по электронной почте

    // В этом примере просто выводим отзыв в консоль
    error_log("Received feedback: " . $feedbackText);

    // Отправляем успешный ответ клиенту
    echo "Success";
} else {
    // Если запрос не методом POST, отправляем ошибку метода
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
