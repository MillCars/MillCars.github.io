CREATE DATABASE IF NOT EXISTS reviews_database;

USE reviews_database;

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    rating INT NOT NULL,
    review_text TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


$sql = "INSERT INTO reviews (name, email, rating, review_text, timestamp) VALUES ('$name', '$email', '$rating', '$reviewText', CURRENT_TIMESTAMP)";

$sql = "SELECT * FROM reviews ORDER BY timestamp DESC";


// Запрос на извлечение отзывов с сортировкой по времени
$sql = "SELECT * FROM reviews ORDER BY timestamp DESC";
$result = $conn->query($sql);

// Проверка наличия отзывов
if ($result->num_rows > 0) {
    // Вывод данных каждого отзыва
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

