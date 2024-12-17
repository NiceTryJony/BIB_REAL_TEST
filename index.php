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
    <br><br><h2 id="pan_gl_nap">Panel Główny</h2><br>
    <ul>
        <li><button class="el_panel_gl" onclick="switchPanel('main0')">Panel Główny</button></li>
        <li><button class="el_panel_gl" onclick="switchPanel('main1')">Konkursy</button></li>
        <li><button class="el_panel_gl" onclick="switchPanel('main2')">Wyjazdy</button></li>
        <li><button class="el_panel_gl" onclick="switchPanel('main3')">Wycieczki</button></li>
        <li><button class="el_panel_gl" onclick="window.location.href='admin.php'">Panel Administracji</button></li>
    </ul>
</section>
<!-- Остальные панели -->
<main id="main1" class="main"><h2>Konkursy</h2></main>
<main id="main2" class="main"><h2>Wyjazdy</h2></main>
<main id="main3" class="main"><h2>Wycieczki</h2></main>

<script src="script.js"></script>
</body>
</html>
