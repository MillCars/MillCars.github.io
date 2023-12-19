<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "ALEKSEI10ljamovnalodon";
$dbname = "zumirle";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы модерации
$reviewId = $_POST["review_id"];
$moderationStatus = $_POST["moderation_status"];

// Обновление статуса модерации в базе данных
$sql = "UPDATE reviews SET moderation_status='$moderationStatus' WHERE id='$reviewId'";

if ($conn->query($sql) === TRUE) {
    echo "Статус модерации успешно обновлён.";
} else {
    echo "Ошибка при обновлении статуса модерации: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>


// Основная страница с отзывами
<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "root";
$password = "ALEKSEI10ljamovnalodon";
$dbname = "zumirle";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запрос на извлечение отзывов со статусом "approved"
$sql = "SELECT * FROM reviews WHERE moderation_status = 'approved'";
$result = $conn->query($sql);

// Проверка наличия отзывов
if ($result->num_rows > 0) {
    // Вывод отзывов
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Имя:</strong> " . $row["name"] . "<br>";
        echo "<strong>Email:</strong> " . $row["email"] . "<br>";
        echo "<strong>Оценка:</strong> " . $row["rating"] . " звезд<br>";
        echo "<strong>Отзыв:</strong> " . $row["review_text"] . "<br>";
        echo "<strong>Дата:</strong> " . $row["timestamp"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Нет одобренных отзывов.";
}

// Закрытие соединения с базой данных
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rewstyle.css">
    <title>Страница с отзывами</title>
</head>
<body>

<h2>Отзывы пользователей</h2>

<!-- Место для отображения отзывов -->
<div id="reviews-container">
    <?php
    // Подключение к базе данных
    $servername = "127.0.0.1";
    $username = "root";
    $password = "ALEKSEI10ljamovnalodon";
    $dbname = "zumirle";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Запрос на извлечение всех отзывов
    $sql = "SELECT * FROM reviews";
    $result = $conn->query($sql);

    // Проверка наличия отзывов
    if ($result->num_rows > 0) {
        // Вывод отзывов
        while ($row = $result->fetch_assoc()) {
            echo "<div class='review'>";
            echo "<p><strong>Имя:</strong> " . $row["name"] . "<br>";
            echo "<strong>Email:</strong> " . $row["email"] . "<br>";
            echo "<strong>Оценка:</strong> " . $row["rating"] . " звезд<br>";
            echo "<strong>Отзыв:</strong> " . $row["review_text"] . "<br>";
            echo "<strong>Дата:</strong> " . $row["timestamp"] . "</p>";
            echo "</div>";
            echo "<hr>";
        }
    } else {
        echo "<p>Отзывов пока нет.</p>";
    }

    // Закрытие соединения с базой данных
    $conn->close();
    ?>
</div>

</body>
</html>

