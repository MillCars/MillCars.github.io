<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
    <!-- Ваши стили CSS идут здесь -->
    <style>
        /* Ваши стили CSS */
    </style>
</head>
<body>
    <div>
        <h2>Оставьте свой отзыв</h2>
        <form id="reviewForm">
            <label for="userName">Ваше имя:</label>
            <input type="text" id="userName" name="userName" required>

            <label for="userReview">Ваш отзыв:</label>
            <textarea id="userReview" name="userReview" rows="4" required></textarea>

            <button type="button" onclick="submitReview()">Отправить отзыв</button>
        </form>

        <div id="reviewsContainer">
            <!-- Отзывы будут добавляться сюда -->
        </div>
    </div>

    <script>
        function submitReview() {
            var userName = document.getElementById('userName').value;
            var userReview = document.getElementById('userReview').value;

            // Отправка данных на сервер
            fetch("ваш_обработчик_отзывов.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "userName=" + encodeURIComponent(userName) + "&userReview=" + encodeURIComponent(userReview),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Перезагрузка отзывов после успешной отправки
                    loadReviews();
                    // Очистить форму после отправки
                    document.getElementById('reviewForm').reset();
                } else {
                    console.error("Ошибка при обработке отзыва на сервере");
                }
            })
            .catch(error => {
                console.error("Произошла ошибка:", error);
            });
        }

        function loadReviews() {
            // Загрузка отзывов с сервера
            fetch("ваш_обработчик_отзывов.php")
            .then(response => response.json())
            .then(reviews => {
                var reviewsContainer = document.getElementById('reviewsContainer');
                reviewsContainer.innerHTML = '';

                for (var i = 0; i < reviews.length; i++) {
                    var reviewDiv = document.createElement('div');
                    reviewDiv.className = 'review';
                    reviewDiv.innerHTML = '<strong>' + reviews[i].userName + ':</strong> ' + reviews[i].userReview;
                    reviewsContainer.appendChild(reviewDiv);
                }
            })
            .catch(error => {
                console.error("Произошла ошибка при загрузке отзывов:", error);
            });
        }

        // Загрузка отзывов при загрузке страницы
        window.onload = function() {
            loadReviews();
        };
    </script>
</body>
</html>
