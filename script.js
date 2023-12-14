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
  