<?php
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"];
    $userReview = $_POST["userReview"];

    $stmt = $conn->prepare("INSERT INTO reviews (userName, userReview) VALUES (?, ?)");
    $stmt->bind_param("ss", $userName, $userReview);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT * FROM reviews");
$reviews = [];

while ($row = $result->fetch_assoc()) {
    $reviews[] = $row; // Добавляем отзыв в массив
    echo '<p>' . $row['userName'] . ': ' . $row['userReview'] . '</p>';
}

echo json_encode($reviews);
$conn->close();

// Подготовка и выполнение SQL-запроса для вставки данных в таблицу
$sql = "INSERT INTO reviews (name, email, rating, review_text, moderation_status) 
        VALUES ('$name', '$email', '$rating', '$reviewText', 'pending')";

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




