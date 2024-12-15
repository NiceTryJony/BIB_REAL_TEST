document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('overlay');
    const overlayImage = overlay.querySelector('img');
    const closeButton = document.getElementById('close');

    // Обработчик открытия панели
    document.getElementById('toggleButton').addEventListener('click', () => {
        document.getElementById('sidePanel').classList.toggle('open');
    });

    // Обработчик превью изображений
    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', (event) => {
            const preview = document.getElementById(`preview_${input.dataset.id}`);
            preview.innerHTML = '';
            const files = Array.from(event.target.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.addEventListener('click', () => {
                        overlayImage.src = img.src;
                        overlay.style.display = 'flex';
                    });
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    });

    // Закрытие оверлея
    closeButton.addEventListener('click', () => {
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', (event) => {
        if (event.target === overlay) {
            overlay.style.display = 'none';
        }
    });
});

// Переключение панелей
function switchPanel(panelId) {
    document.querySelectorAll('.main').forEach(panel => {
        panel.classList.remove('active');
    });
    document.getElementById(panelId).classList.add('active');
}
