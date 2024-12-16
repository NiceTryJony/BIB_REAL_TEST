<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Button with Sliding Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Кнопка для открытия панели -->
<button class="button" id="toggleButton"><strong><span>☰</span></strong></button>

<!-- Боковая панель -->
<section class="panel" id="sidePanel">
    <br><br><h2 id="pan_gl_nap">Panel Główny</h2>
    <ul>
        <li><button class="el_panel_gl" onclick="switchPanel('main0')">Panel Główny</button></li>
        <li><button class="el_panel_gl" onclick="switchPanel('main1')">Konkursy</button></li>
        <li><button class="el_panel_gl" onclick="switchPanel('main2')">Wyjazdy</button></li>
        <li><button class="el_panel_gl" onclick="switchPanel('main3')">Wycieczki</button></li>
    </ul>
</section>

<!-- Основной контент -->
<main id="main0" class="main active">
    <section id="pn_PRZYWITALNY">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="tytul">Tytuł:</label>
            <input type="text" id="tytul" name="tytul" required>
        </div>

        <div class="form-group">
            <label for="tresc">Treść:</label>
            <textarea id="tresc" name="tresc" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
        </div>

        <div class="form-group">
            <label for="zdjecia">Zdjęcia:</label>
            <input type="file" id="zdjecia" name="zdjecia[]" class="file-input" data-id="1" multiple accept="image/*">
            <div id="preview_1" class="preview" style='background-color:rgba(0, 38, 121, 0.81); margin: 5px; padding: 10px; border-radius: 10px; width: 100%; height: 100%'></div>
        </div>

        <button type="submit" class="el_panel_gl">Zapisz</button>
    </form>
    </section>
</main>

<!-- Остальные панели -->
<main id="main1" class="main"><h2>Konkursy</h2></main>
<main id="main2" class="main"><h2>Wyjazdy</h2></main>
<main id="main3" class="main"><h2>Wycieczki</h2></main>

<!-- Общий оверлей -->
<div id="overlay">
    <span id="close">X</span>
    <img src="" alt="Zoomed Image" style="border-radius: 15px;">
</div>

<script src="script.js"></script>
</body>
</html>
