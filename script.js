// Открывает модальное окно при загрузке страницы
window.onload = function () {
    openModal();
};

// Показывает модальное окно
function openModal() {
    document.getElementById('adModal').style.display = 'block';
}

// Закрывает модальное окно
function closeModal() {
    document.getElementById('adModal').style.display = 'none';
}

// Пример объекта с переводами
var translations = {
    'en': {
        'text1-header': 'Best cars for your family and you',
        'More': 'More',
        'Contacts': 'Contacts',
        'Support': 'Support',
    },
    'ru': {
        'text1-header': 'Лучшие машины для твоей семьи и тебя',
        'More': 'Больше',
        'Contacts': 'Контакты',
        'Support': 'Поддержка',
    }
};

// Пример изменения текста на странице
function changeLanguage(lang) {
    var elements = document.querySelectorAll('[data-translate]');
    elements.forEach(function(element) {
        var key = element.getAttribute('data-translate');
        element.textContent = translations[lang][key];
    });
}
