document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('overlay');
    const overlayImage = overlay.querySelector('img');

    document.getElementById('toggleButton').addEventListener('click', () => {
        document.getElementById('sidePanel').classList.toggle('open');
    });

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
                        addImageBehaviors(img); 
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
    
    function createImageElement(src) {
        const img = document.createElement('img');
        img.src = src;
        img.style.cssText = `
            width: 92px; 
            height: 92px;
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


        let clickTimer;
        img.addEventListener('click', (e) => {
            clearTimeout(clickTimer);
            clickTimer = setTimeout(() => {
                overlayImage.src = img.src;
                overlay.style.display = 'flex';
            }, 200);
        });

        img.addEventListener('dblclick', (e) => {
            clearTimeout(clickTimer);
            e.stopPropagation(); 

            img.remove();
            fileInput.value = '';
        });

    }

    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            overlay.style.display = 'none';
        }
    });
    
    overlayImage.addEventListener('click', (e) => {
        e.stopPropagation(); 
    });

    
    document.getElementById('wyloguj').addEventListener('click', function () {
        if (confirm('Czy na pewno chesz wylogować się?')) {
            document.getElementById('confirmInput').value = 'true';
            document.getElementById('form_wyl').submit(); 
        } else {
            alert('Anulowano wylogowanie.');
        }
    });
});
