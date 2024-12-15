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
        <?php
        $conn = new mysqli("localhost", "root", "02dE@Ks7sw5sRc4cGj9", "biblioteka_zss");
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        $query = "SELECT * FROM aktualnosci";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                echo "<section class='aktual' style='background-color:rgb(0, 148, 84); margin: 10px; padding: 10px; border-radius: 10px;'>";
                echo "<h1>" . htmlspecialchars($row[1]) . "</h1>";
                echo "<p>" . htmlspecialchars($row[2]) . "</p>";
                echo "<p>" . htmlspecialchars($row[3]) . "</p>";

                // Форма для загрузки изображений
                echo "<form method='POST' enctype='multipart/form-data' class='upload-form'>";
                echo "<label for='files_" . $row['id'] . "'>Wybierz Zdjęcia:</label><br>";
                echo "<input type='file' name='files[]' class='file-input' data-id='" . $row['id'] . "' accept='image/*' multiple><br><br>";
                echo "<div class='preview' id='preview_" . $row['id'] . "' style='background-color:rgba(0, 38, 121, 0.81); margin: 5px; padding: 10px; border-radius: 10px;'></div>";
                echo "<br><br><button type='submit'>Wyślij</button>";
                echo "</form>";
                echo "</section>";
            }
        } else {
            echo "<p>Нет записей.</p>";
        }

        $conn->close();
        ?>
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
