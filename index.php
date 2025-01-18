<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link rel="icon" href="book_3725.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Кнопка для открытия панели -->
<button class="button" id="toggleButton"><strong><span>☰</span></strong></button>

<!-- Боковая панель -->
<section class="panel" id="sidePanel">
    <br><br>
    <h2 id="pan_gl_nap">Panel Główny</h2><br>
    <ul>
        <li class="el_panel_li"><button class="el_panel_gl" onclick="switchPanel('main0')">Panel Główny</button></li>
        <li class="el_panel_li"><button class="el_panel_gl" onclick="switchPanel('main1')">Konkursy</button></li>
        <li class="el_panel_li"><button class="el_panel_gl" onclick="switchPanel('main2')">Wyjazdy</button></li>
        <li class="el_panel_li"><button class="el_panel_gl" onclick="switchPanel('main3')">Wycieczki</button></li>
        <li class="el_panel_li"><button class="el_panel_gl" onclick="window.location.href='admin.php'">Panel Administracji</button></li>
    </ul>
    <script>
        const przyciski_menu = document.querySelectorAll('.el_panel_gl');
        const li_menu = document.querySelectorAll('.el_panel_li');
        var wysokosc_menu;
        przyciski_menu.forEach()
    </script>
</section>
<main id="main1" class="main active" style="display:none"><h2>Konkursy</h2></main>
<main id="main2" class="main active" style="display:none"><h2>Wyjazdy</h2></main>
<main id="main3" class="main active" style="display:none"><h2>Wycieczki</h2></main>
<script>
    document.getElementById('toggleButton').addEventListener('click', () => {
    document.getElementById('sidePanel').classList.toggle('open');
});
function switchPanel(panelId) {
    document.querySelectorAll('.main').forEach(panel => {
        panel.classList.remove('active');
        panel.style.display = 'none';
    });
    const activePanel = document.getElementById(panelId);
    if (activePanel) {
        activePanel.classList.add('active');
        activePanel.style.display = 'block';
    }
}
</script>
</body>
</html>