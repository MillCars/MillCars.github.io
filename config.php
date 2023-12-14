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
?>
