// userCounter.js
document.addEventListener('DOMContentLoaded', function () {
    // Ваш счетчик
    let userCount = 0;

    // Увеличиваем счетчик при загрузке страницы
    userCount++;

    // Отображаем счетчик на странице
    document.getElementById('userCounter').innerText = userCount;

    // Обновляем счетчик при каждом новом посещении
    document.addEventListener('visibilitychange', function () {
        if (document.visibilityState === 'visible') {
            userCount++;
            document.getElementById('userCounter').innerText = userCount;
        }
    });
});
