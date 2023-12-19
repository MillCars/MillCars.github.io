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
        echo "<p><strong>Имя:</strong> " . $row["name"] . "<br>";
        echo "<strong>Email:</strong> " . $row["email"] . "<br>";
        echo "<strong>Оценка:</strong> " . $row["rating"] . " звезд<br>";
        echo "<strong>Отзыв:</strong> " . $row["review_text"] . "<br>";
        echo "<strong>Дата:</strong> " . $row["timestamp"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Отзывов пока нет.";
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
