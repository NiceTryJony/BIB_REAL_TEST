<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Button with Sliding Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
$polaczenie = mysqli_connect('localhost', 'root', '02dE@Ks7sw5sRc4cGj9', 'biblioteka_zss');
session_start();
?>

<body>

    <!-- Кнопка для открытия панели -->
    <button class="button" id="toggleButton"><strong><span>☰</span></strong></button>

    <!-- Боковая панель -->
    <section class="panel" id="sidePanel">
        <br><br>
        <h2 id="pan_gl_nap">Panel Główny</h2>
        <ul>
            <!--li><button class="el_panel_gl" onclick="switchPanel('main0')" id="panGL">Strona główna</button></li-->
            <li><button class="el_panel_gl" onclick="switchPanel('main1')" id="konkursy">Konkursy</button></li>
            <li><button class="el_panel_gl" onclick="switchPanel('main2')" id="wyjazdy">Wyjazdy</button></li>
            <li><button class="el_panel_gl" onclick="switchPanel('main3')" id="wycieczki">Wycieczki</button></li>
        </ul>
    </section>
    <script>
        function prepareFilename() {
            const titleField = document.getElementById("tytul");
            const fileField = document.getElementById("zdjecia");
            const form = document.getElementById("uploadForm");

            // Генерация текущей даты
            const now = new Date();
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Месяцы начинаются с 0
            const year = now.getFullYear();

            // Формирование имени файла
            const title = titleField.value.trim().replace(/\s+/g, "_");
            const newFilename = `${day}_${month}_${year}_${title}`;

            // Создаем скрытое поле для передачи имени файла
            const filenameField = document.createElement("input");
            filenameField.type = "hidden";
            filenameField.name = "filename";
            filenameField.value = newFilename;

            form.appendChild(filenameField);
        }
    </script>
    <main id='main0' class='main active' style='display:none;'>
            <h1 style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); padding: 30px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin: 20px auto;">WITAM NA PANELU ADMINISTRATORA</h1>
            <button class="el_panel_gl" onclick="switchPanel('main1')" id="konkursy" style="width:300px;height:200px;margin:7px;font-size:290%;">Konkursy</button>
            <button class="el_panel_gl" onclick="switchPanel('main2')" id="wyjazdy" style="width:300px;height:200px;margin:7px;font-size:290%;">Wyjazdy</button>
            <button class="el_panel_gl" onclick="switchPanel('main3')" id="wycieczki" style="width:300px;height:200px;margin:7px;font-size:290%;">Wycieczki</button>
    </main>
            <!--ZRÓB OGRANICZENIE DO ILOŚCI TEKTU W TYTÓL, TREŚĆ itd-->
    <main id='main1' class='main active' style='display:none;'>
    <section id="pn_DODATKOWA_KON" style="display:flex; gap: 250px; align-items: flex-start;">
        <section id='pn_KONKURS' style="flex: 1; max-width: 40%;">
            <form method='post' enctype='multipart/form-data' id="uploadForm">
                <div class='form-group'>
                    <h1 id="pan_kon">DODAJ KONKURS</h1>
                    <label for='tytul'>Tytuł:</label>
                    <input type='text' id='tytul' name='tytul' required>
                </div>

                <div class='form-group'>
                    <label for='tresc'>Treść:</label>
                    <textarea id='tresc' name='tresc' rows='4' required></textarea>
                </div>

                <div class='form-group'>
                    <label for='data'>Data:</label>
                    <input type='date' id='data' name='data' required>
                </div>

                <div class='form-group'>
                    <label for='zdjecia'>Zdjęcia:</label>
                    <input type='file' id='zdjecia' name='zdjecia[]' class='file-input' data-id='1' multiple accept='image/*'>
                    <div id='preview_1' class='preview'></div>
                </div>

                <button type="reset">Wyczyść</button>
                <button type='submit' class='el_panel_gl'>Dodaj</button>
            </form>
        </section>
        <section id="pn_KONKURS_dane" style="overflow-y:auto; overflow-x:hidden; max-width: 100%; height: 600px; flex: 1; padding: 10px; padding-right: 70px;">
            <h1 style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); padding: 18px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin-left:14px ;">DODANE KONKURSY</h1>
            <?php
                $konkursy = mysqli_query(mysql: $polaczenie, query: "SELECT * FROM konkursy");
                if(mysqli_num_rows(result: $konkursy) < 1){
                    echo "<h1>Nie ma aktualnie żadnych konkursów😞</h1>";
                } else {
                    while($k_wiersz = mysqli_fetch_array(result: $konkursy)){
                        echo "<form method='post' enctype='multipart/form-data' id='uploadForm'>
                                <div class='form-group'>
                                    <label for='tytul'>Tytuł:</label>
                                    <div id='tytol' name='tytul'>{$k_wiersz[1]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='tresc'>Treść:</label>
                                    <div id='tresc' name='tresc' rows='4'>{$k_wiersz[2]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='data'>Data:</label>
                                    <div id='data' name='data'>{$k_wiersz[3]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='zdjecia'>Zdjęcia:</label>
                                    
                                    <div id='preview_1' class='preview'>{$k_wiersz[4]}</div>
                                </div>
                                <input type='number' value='{$k_wiersz[0]}' name='id' hidden>
                        </form>";
                        // echo "<form method='post' enctype='multipart/form-data' id='uploadForm'>
                        //         <div class='form-group'>
                        //             <h1 id='pan_kon'>DODAJ KONKURS</h1>
                        //             <label for='tytul'>Tytuł:</label>
                        //             <input type='text' id='tytul' name='tytul' value='{$k_wiersz[1]}' required>
                        //         </div>

                        //         <div class='form-group'>
                        //             <label for='tresc'>Treść:</label>
                        //             <textarea id='tresc' name='tresc' rows='4' value='{$k_wiersz[2]}' required></textarea>
                        //         </div>

                        //         <div class='form-group'>
                        //             <label for='data'>Data:</label>
                        //             <input type='date' id='data' name='data' value='{$k_wiersz[3]}' required>
                        //         </div>

                        //         <div class='form-group'>
                        //             <label for='zdjecia'>Zdjęcia:</label>
                        //             <input type='file' id='zdjecia' name='zdjecia[]' class='file-input' data-id='1' multiple accept='photo/*' value='{$k_wiersz[4]}'>
                        //             <div id='preview_1' class='preview'></div>
                        //         </div>

                        //         <input type='number' value='{$k_wiersz[0]}' name='id' hidden>
                        //         <button type='submit' id='usun' name='usun'>Usuń</button>
                        //         <button type='submit' class='el_panel_gl'>Zapisz</button>
                        // </form>";
                    }
                }
            ?>
        </section>
    </section>
    </main>

    <main id='main2' class='main active' style='display:none;'>
    <section id="pn_DODATKOWA_WYJ" style="display:flex; gap: 250px; align-items: flex-start;">
        <section id='pn_WYJAZDY' style="flex: 1; max-width: 40%;">
            <form method='post' enctype='multipart/form-data' id="uploadForm">
                <div class='form-group'>
                    <h1 id="pan_wyj">DODAJ WYJAZD</h1>
                    <label for='tytul'>Tytuł:</label>
                    <input type='text' id='tytul' name='tytul' required>
                </div>

                <div class='form-group'>
                    <label for='tresc'>Treść:</label>
                    <textarea id='tresc' name='tresc' rows='4' required></textarea>
                </div>

                <div class='form-group'>
                    <label for='data'>Data:</label>
                    <input type='date' id='data' name='data' required>
                </div>

                <div class='form-group'>
                    <label for='zdjecia'>Zdjęcia:</label>
                    <input type='file' id='zdjecia' name='zdjecia[]' class='file-input' data-id='1' multiple accept='image/*'>
                    <div id='preview_1' class='preview'></div>
                </div>

                <button type="reset" id="usun" name="">Usuń</button>
                <button type='submit' class='el_panel_gl'>Zapisz</button>
            </form>
        </section>
        <section id="pn_WYJAZDY_dane" style="overflow-y:auto; overflow-x:hidden; max-width: 100%; height: 600px; flex: 1; padding: 10px; padding-right: 70px;">
        <h1 style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); padding: 18px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin-left:14px ;">DODANE WYJAZDY</h1>
            <?php
                $wyjazdy = mysqli_query(mysql: $polaczenie, query: "SELECT * FROM wyjazdy");
                if(mysqli_num_rows(result: $wyjazdy) < 1){
                    echo "<h1>Nie ma aktualnie żadnych konkursów😞</h1>";
                } else {
                    while($wyj_wiersz = mysqli_fetch_array(result: $wyjazdy)){
                        echo "<form method='post' enctype='multipart/form-data' id='uploadForm'>
                                <div class='form-group'>
                                    <label for='tytul'>Tytuł:</label>
                                    <div id='tytol' name='tytul'>{$wyj_wiersz[1]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='tresc'>Treść:</label>
                                    <div id='tresc' name='tresc' rows='4'>{$wyj_wiersz[2]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='data'>Data:</label>
                                    <div id='data' name='data'>{$wyj_wiersz[3]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='zdjecia'>Zdjęcia:</label>
                                    
                                    <div id='preview_1' class='preview'>{$wyj_wiersz[4]}</div>
                                </div>
                                <input type='number' value='{$wyj_wiersz[0]}' name='id' hidden>
                        </form>";
                    }
                }
            ?>
        </section>
        </section>
    </main>

    <main id='main3' class='main active' style='display:none;'>
    <section id="pn_DODATKOWA_WYC" style="display:flex; gap: 250px; align-items: flex-start;">
        <section id="pn_WYCIECZKI" tyle="flex: 1; max-width: 40%;">
            <form method='post' enctype='multipart/form-data' id="uploadForm">
                <div class='form-group'>
                    <h1 id="pan_wyc">DODAJ WYCIECZKĘ</h1>
                    <label for='tytul'>Tytuł:</label>
                    <input type='text' id='tytul' name='tytul' required>
                </div>

                <div class='form-group'>
                    <label for='tresc'>Treść:</label>
                    <textarea id='tresc' name='tresc' rows='4' required></textarea>
                </div>

                <div class='form-group'>
                    <label for='data'>Data:</label>
                    <input type='date' id='data' name='data' required>
                </div>

                <div class='form-group'>
                    <label for='zdjecia'>Zdjęcia:</label>
                    <input type='file' id='zdjecia' name='zdjecia[]' class='file-input' data-id='1' multiple accept='image/*'>
                    <div id='preview_1' class='preview'></div>
                </div>

                <button type="submit" id="usun" name="">Usuń</button>
                <button type='submit' class='el_panel_gl'>Zapisz</button>
            </form>
        </section>
        <section id="pn_WYCIECZKI_dane" style="overflow-y:auto; overflow-x:hidden; max-width: 100%; height: 600px; flex: 1; padding: 10px; padding-right: 70px;">
        <h1 style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); padding: 18px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin-left:14px ;">DODANE WYCIECZKĘ</h1>
            <?php
                $wycieczka = mysqli_query(mysql: $polaczenie, query: "SELECT * FROM wycieczki");
                if(mysqli_num_rows(result: $wycieczka) < 1){
                    echo "<h1>Nie ma aktualnie żadnych konkursów😞</h1>";
                } else {
                    while($wyc_wiersz = mysqli_fetch_array(result: $wycieczka)){
                        echo "<form method='post' enctype='multipart/form-data' id='uploadForm'>
                                <div class='form-group'>
                                    <label for='tytul'>Tytuł:</label>
                                    <div id='tytol' name='tytul'>{$wyc_wiersz[1]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='tresc'>Treść:</label>
                                    <div id='tresc' name='tresc' rows='4'>{$wyc_wiersz[2]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='data'>Data:</label>
                                    <div id='data' name='data'>{$wyc_wiersz[3]}</div>
                                </div>

                                <div class='form-group'>
                                    <label for='zdjecia'>Zdjęcia:</label>
                                    
                                    <div id='preview_1' class='preview'>{$wyc_wiersz[4]}</div>
                                </div>
                                <input type='number' value='{$wyc_wiersz[0]}' name='id' hidden>
                        </form>";
                    }
                }
            ?>
        </section>
        </section>
    </main>

    <nav id="logowanie">
        <form method="post" class="login-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" placeholder="Wpisz email" name="email" required>
            </div>
            <div class="form-group">
                <label for="haslo">Hasło:</label>
                <input type="password" id="haslo" placeholder="Wpisz hasło" name="haslo" required>
            </div>
            <div class="form-buttons">
                <input type="reset" value="Powrót" onKeyDown onclick="window.location.href='../BIB_REAL_TEST/'" class="btn-back" style="margin-left: 10px;">
                <input type="submit" value="Zaloguj" name="zaloguj" class="btn-login">
                <!--input type="submit" value="Zarejestrój" name="zarejestroj" class="btn-login" style="width: 140px; padding: 5px; "-->
            </div>
        </form>
    </nav>
    <!--?php
       if(isset($_POST['zarejestroj'])) {
        $email = $_POST['email'];
        $haslo = $_POST['haslo'];
        $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);

        $zapytanie = "INSERT INTO konta (id, nazwa_uzytkownika, haslo, uprawnienia) VALUES (NULL, '$email', '$hashed_password', 'admin')";
        if(mysqli_query($polaczenie,$zapytanie)){
            echo "<script>alert('Admin został dodany')</script>";
        }else{
            echo "<script>alert('Admin nie został dodany')</script>";
        }
    }
    ?-->
    <?php
    if(isset($_POST['zaloguj'])) {
        $email = $_POST['email'];
        $haslo = $_POST['haslo'];
        $sprHaslo = mysqli_query($polaczenie, "SELECT haslo FROM konta WHERE nazwa_uzytkownika='$email'");

        if ($sprHaslo && mysqli_num_rows($sprHaslo) > 0) {
            $row = mysqli_fetch_array($sprHaslo);
            $hashed_password = $row[0];

            if (password_verify($haslo, $hashed_password)) {
                $sesja = mysqli_fetch_array(mysqli_query($polaczenie, "SELECT `uprawnienia` FROM konta WHERE nazwa_uzytkownika='$email'"));
                $_SESSION['zalogowano'] = $sesja[0];
                echo "
                <script>
                    document.getElementById('main0').style.display='inline';
                    document.getElementById('logowanie').style.display='none';

                    // Переключение панелей
                    function switchPanel(panelId) {
                        // Скрыть все панели
                        document.querySelectorAll('.main').forEach(panel => {
                            panel.classList.remove('active');
                            panel.style.display = 'none'; // Скрыть панель
                        });
                        // Показать активную панель
                        const activePanel = document.getElementById(panelId);
                        if (activePanel) {
                            activePanel.classList.add('active');
                            activePanel.style.display = 'block'; // Показать панель
                        }
                    }
                

                </script>";
            } else {
                echo "<script>
                        console.log('złe hasło');
                        const alarm='Nie prawidlowy email lub hasło! \n Przenosimy cię do strony głównej..';
                        alert(alarm);
                        window.location.href='../BIB_REAL_TEST/';
                    </script>";
            } //window.location.href='../BIB_REAL_TEST/';
        } else {
            echo "<script>
                    console.log('zły email');
                    alert('Nie prawidlowy email lub hasło! Przenosimy cię do strony głównej.');
                    window.location.href='../BIB_REAL_TEST/';
                </script>";
        }
    }
    mysqli_close($polaczenie);
    ?>

    <div id="overlay">
        <span id="close">X</span>
        <img src="" alt="Zoomed Image" style="border-radius: 15px;">
    </div>
    <script src="script.js"></script>
</body>

</html>