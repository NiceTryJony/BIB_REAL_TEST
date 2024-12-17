document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('overlay');
    const overlayImage = overlay.querySelector('img');
    const closeButton = document.getElementById('close');

    // Обработчик открытия панели
    document.getElementById('toggleButton').addEventListener('click', () => {
        document.getElementById('sidePanel').classList.toggle('open');
    });

    // Обработчик превью изображений
    const fileInput = document.getElementById('zdjecia');
    const preview = document.getElementById('preview_1');

    if (fileInput && preview) {
        fileInput.addEventListener('change', (event) => {
            preview.innerHTML = '';
            const files = Array.from(event.target.files);

            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '150px';
                        img.style.height = '150px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '8px';
                        img.style.margin = '5px';
                        img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                        img.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
                        
                        img.addEventListener('mouseover', () => {
                            img.style.transform = 'scale(1.05)';
                            img.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.3)';
                        });
                        
                        img.addEventListener('mouseout', () => {
                            img.style.transform = 'scale(1)';
                            img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                        });

                        img.addEventListener('click', () => {
                            overlayImage.src = img.src;
                            overlay.style.display = 'flex';
                        });

                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }

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
     document.getElementById(panelId).style.display='inline';
 }