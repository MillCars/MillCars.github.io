<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"];
    $userReview = $_POST["userReview"];

    // Здесь вы можете выполнить дополнительные действия с данными, например, сохранить их в базу данных

    // Отправляем ответ обратно на клиент
    echo json_encode(["success" => true]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
    <!-- Ваш HTML- и JavaScript-код для формы и отображения отзывов -->
    <style>
        /* Ваши стили CSS идут здесь */
    </style>
</head>
<body>
    <!-- Ваш HTML-код идет здесь -->
    <script>
        // Ваш JavaScript-код для обработки отправки формы и отображения отзывов идет здесь
    </script>



</body>
</html>
