function submitReview() {
    var userName = document.getElementById('userName').value;
    var userReview = document.getElementById('userReview').value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_review.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            loadReviews(); // Перезагрузка отзывов после успешной отправки
        }
    };
    xhr.send("userName=" + userName + "&userReview=" + userReview);
    document.getElementById('reviewForm').reset(); // Очистить форму после отправки
}

function loadReviews() {
    var reviewsContainer = document.getElementById('reviewsContainer');
    reviewsContainer.innerHTML = '';

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "load_reviews.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var reviews = JSON.parse(xhr.responseText);
            for (var i = 0; i < reviews.length; i++) {
                var reviewDiv = document.createElement('div');
                reviewDiv.className = 'review';
                reviewDiv.innerHTML = '<strong>' + reviews[i].userName + ':</strong> ' + reviews[i].userReview;
                reviewsContainer.appendChild(reviewDiv);
            }
        }
    };
    xhr.send();
}
