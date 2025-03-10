document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('overlay');
    const overlayImage = overlay.querySelector('img');
    const closeButton = document.getElementById('close');

    // Обработчик открытия панели
    document.getElementById('toggleButton').addEventListener('click', () => {
        document.getElementById('sidePanel').classList.toggle('open');
    });
    // Обработчик превью изображений
    //const fileInput = document.querySelector('.file-input');
    // const preview_1 = document.getElementById('preview_1');

    // if (fileInput && preview_1) {
    //     fileInput.addEventListener('change', (event) => {
    //         preview_1.innerHTML = '';
    //         const files = Array.from(event.target.files);

    //         files.forEach(file => {
    //             if (file.type.startsWith('image/')) {
    //                 const reader = new FileReader();
    //                 reader.onload = (e) => {
    //                     const img = document.createElement('img');
    //                     img.src = e.target.result;
    //                     img.style.width = '104px';
    //                     img.style.height = '104px';
    //                     img.style.objectFit = 'cover';
    //                     img.style.borderRadius = '8px';
    //                     img.style.margin = '5px';
    //                     img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.4)';
    //                     img.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
                        
    //                     img.addEventListener('mouseover', () => {
    //                         img.style.transform = 'scale(1.05)';
    //                         img.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.3)';
    //                     });
                        
    //                     img.addEventListener('mouseout', () => {
    //                         img.style.transform = 'scale(1)';
    //                         img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
    //                     });

    //                     img.addEventListener('click', () => {
    //                         overlayImage.src = img.src;
    //                         overlay.style.display = 'flex';
    //                     });

    //                     preview_1.appendChild(img);
    //                 };
    //                 reader.readAsDataURL(file);
    //             }
    //         });
    //     });
    // }



    document.querySelectorAll('.file-input').forEach(input => {
        const previewId = input.dataset.previewId;
        const preview = document.getElementById(previewId);
    
        input.addEventListener('change', (event) => {
            preview.innerHTML = '';
            const files = Array.from(event.target.files);
    
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = createImageElement(e.target.result);
                        addImageBehaviors(img); // Общая функция для обработки событий
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
    
    // Общие функции для переиспользования
    function createImageElement(src) {
        const img = document.createElement('img');
        img.src = src;
        img.style.cssText = `
            width: 104px; 
            height: 104px;
            object-fit: cover;
            border-radius: 8px;
            margin: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        `;
        return img;
    }
    
    function addImageBehaviors(img) {
        img.addEventListener('mouseover', () => {
            img.style.transform = 'scale(1.05)';
            img.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.3)';
        });
        
        img.addEventListener('mouseout', () => {
            img.style.transform = 'none';
            img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.4)';
        });
    
        img.addEventListener('click', () => {
            const overlay = document.getElementById('overlay');
            const overlayImage = document.getElementById('overlayImage');
            overlayImage.src = img.src;
            overlay.style.display = 'flex';
        });

        img.addEventListener('dblclick', () => {
            img.remove();
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

    document.getElementById('wyloguj').addEventListener('click', function () {
        if (confirm('Czy na pewno chesz wylogować się?')) {
            document.getElementById('confirmInput').value = 'true'; // Устанавливаем подтверждение
            document.getElementById('form_wyl').submit(); // Отправляем форму
        } else {
            alert('Anulowano wylogowanie.');
        }
    });
});
