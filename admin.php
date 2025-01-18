<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN_PANEL_ADMIN</title>
    <link rel="icon" href="book_3725.ico">
    <link rel="stylesheet" href="style.css">
</head>
<?php
$polaczenie = mysqli_connect('localhost', 'root', '02dE@Ks7sw5sRc4cGj9', 'biblioteka_zss');
session_start();
?>

<body>
    <button class="button" id="toggleButton"><strong><span>☰</span></strong></button>
    <section class="panel" id="sidePanel">
        <br><br>
        <h2 id="pan_gl_nap">Panel Główny</h2>
        <ul>
            <!--li><button class="el_panel_gl" onclick="switchPanel('main0')" id="panGL" name=''>Strona główna</button></li-->
            <li><button class="el_panel_gl" onclick="switchPanel('main1')" id="konkursy">Konkursy</button></li>
            <li><button class="el_panel_gl" onclick="switchPanel('main2')" id="wyjazdy">Wyjazdy</button></li>
            <li><button class="el_panel_gl" onclick="switchPanel('main3')" id="wycieczki">Wycieczki</button></li>
            <li><form id="form_wyl" method="post" action=""><input type="hidden" name="confirm" value="false" id="confirmInput"><button class="el_panel_gl" type="submit" name="wyloguj" id="wyloguj"><strong style="font-size:large;">WYLOGUJ</strong></button></form></li>
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
            <button class="el_panel_gl" onclick="switchPanel('main1')" id="konkursy" style="width:300px;height:70px;margin:7px;font-size:290%;margin-bottom:40px;">Konkursy</button>
            <button class="el_panel_gl" onclick="switchPanel('main2')" id="wyjazdy" style="width:300px;height:70px;margin:7px;font-size:290%;">Wyjazdy</button>
            <button class="el_panel_gl" onclick="switchPanel('main3')" id="wycieczki" style="width:300px;height:70px;margin:7px;font-size:290%;">Wycieczki</button>
            <h1 style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); padding: 30px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin: 20px auto; margin-bottom:490px;">WITAM NA PANELU ADMINISTRATORA</h1>
    </main>
            <!--ZRÓB OGRANICZENIE DO ILOŚCI TEKTU W TYTÓL, TREŚĆ itd-->
    <main id='main1' class='main active' style='display:none;'>
    <section id="pn_DODATKOWA_KON" style="display:flex; gap: 250px; align-items: flex-start;">
        <section id='pn_KONKURS' style="flex: 1; max-width: 40%;">
            <form method='post' enctype='multipart/form-data' id="uploadForm">
                <div class='form-group'>
                    <h1 id="pan_kon">DODAJ KONKURS</h1>
                    <label for='tytul'>Tytuł:</label>
                    <input type='text' id='tytul' name='tytul' required placeholder="Dyplom za udział...">
                </div>

                <div class='form-group'>
                    <label for='tresc'>Treść:</label>
                    <textarea id='tresc' name='tresc' rows='4' required placeholder="Treść"></textarea>
                </div>

                <div class='form-group'>
                    <label for='data'>Data:</label>
                    <input type='date' id='data' name='data' required>
                </div>

                <div class='form-group'>
                    <label for='zdjecia'>Zdjęcia:</label>
                    <input type='file' id='zdjecia' name='zdjecia[]' class='file-input' data-id='1' multiple accept='image/*'>
                    <div id='preview' class='preview'></div>
                </div>

                <button type="reset">Wyczyść</button>
                <button type='submit' class='el_panel_gl' name="dodaj_main1">Dodaj</button>
            </form>
        </section>
        <section id="pn_KONKURS_dane" style="overflow-y:auto; overflow-x:hidden; max-width: 100%; height: 738px; flex: 1; padding: 10px; padding-right: 70px;">
            <h1 style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); padding: 18px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin-left:14px ;">DODANE KONKURSY</h1>
            <?php
                $konkursy = mysqli_query($polaczenie, "SELECT * FROM konkursy ORDER BY id DESC");
                if(mysqli_num_rows($konkursy) < 1){
                    echo "<h1>Nie ma aktualnie żadnych konkursów😞</h1>";
                } else {
                    while($k_wiersz = mysqli_fetch_array($konkursy)){
                        echo "<form method='post' enctype='multipart/form-data' id='uploadForm_res'>
                                <div class='form-group'>
                                    <label for='tytul'>Tytuł:</label>
                                    <input type='text' id='tytul' name='tytul' value='{$k_wiersz[1]}' required>
                                </div>

                                <div class='form-group'>
                                    <label for='tresc'>Treść:</label>
                                    <textarea id='tresc' name='tresc' required>{$k_wiersz[2]}</textarea>
                                </div>

                                <div class='form-group'>
                                    <label for='data'>Data:</label>
                                    <input type='date' id='data' name='data' value='{$k_wiersz[3]}' required>
                                </div>

                                <div class='form-group'>
                                    <label for='zdjecia'>Zdjęcia:</label>
                                    <input type='file' id='zdjecia' name='zdjecia[]' class='file-input' data-id='1' multiple accept='photo/konkursy/*'>
                                    <div id='preview' class='preview'></div>
                                </div>

                                <input type='number' value='{$k_wiersz[0]}' name='id' hidden>
                                <input type='hidden' name='confirm' value='false' id='confirmInput_res'>
                                <button type='submit' id='usun' name='usun_main1'>Usuń konkurs</button>
                                <button type='submit' class='el_panel_gl' name='zapisz_main1'>Zapisz zmiany</button>
                        </form><br><br><br>";
                    }
                }
                function removePolishChars($text) {
                    $polishChars = ['ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż', 'Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ź', 'Ż'];
                    $replaceChars = ['a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z', 'A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z'];
                    return str_replace($polishChars, $replaceChars, $text);
                }
                function sanitizePath($path) {
                    return preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $path);
                }

                if(isset($_POST['dodaj_main1']) || isset($_POST['zapisz_main1'])){
                    $tytul = mysqli_real_escape_string($polaczenie, $_POST['tytul']);
                    $tresc = mysqli_real_escape_string($polaczenie, $_POST['tresc']);
                    $data = mysqli_real_escape_string($polaczenie, $_POST['data']);
                    
                    $tytul_bez_pl_znak = removePolishChars($tytul);

                    $id_date = date('Y_m_d') . '_';
                    $sciezka_papki = sanitizePath($sciezka_papki);
                    $sciezka_papki = 'NEW/BIB_REAL_TEST/photo/konkursy/' . $tytul_bez_pl_znak . '_' . $id_date;
                
                    // Инициализация нового папки для записи данных, если её ещё нет
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $sciezka_papki;

                    echo "<script>console.log('Tytul: ". $tytul ."\n');
                                  console.log('Obrobiony tytul: ". $tytul_bez_pl_znak ."\n');
                                  console.log('Zformowana śćieżka: ". $sciezka_papki ."\n');
                                  console.log('Absolutna ścieżka: ". $targetPath ."\n');
                        </script>";

                    if (!is_dir($targetPath)) {
                        if (!mkdir($targetPath, 0777, true)) {
                            echo "<script>alert('Nie udało się stworzyć каталог');</script>";
                            exit;
                        }
                    }
                    
                    $dozwolone_typy = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                    $zdjecia_do_bazy = [];
                    
                    foreach ($_FILES['zdjecia']['tmp_name'] as $index => $tmpFile) {
                        $fileName = $_FILES['zdjecia']['name'][$index];
                        $fileType = $_FILES['zdjecia']['type'][$index];
                    
                        if (!in_array($fileType, $dozwolone_typy)) {
                            echo "<script>alert('Niedostępny typ pliku');</script>";
                            continue;
                        }
                        $uniqueFilename = $sciezka_papki . '/' . date('Y_m_d') . '__' . ($index + 1) . '_' . basename($fileName); // Формирование уникального ID файла
                    
                        $sciezka_test = $_SERVER['DOCUMENT_ROOT'] . "/" . $uniqueFilename;

                        if (move_uploaded_file($tmpFile, "$sciezka_test")) {
                            $zdjecia_do_bazy[] = $uniqueFilename;  // Сохранение пути к файлу
                    
                            // Копирование файлов в конкретную папку
                            $targetFile = $_SERVER['DOCUMENT_ROOT'] . $uniqueFilename;
                            if (!copy($targetFile, $targetPath . '/' . basename($uniqueFilename))) {
                                echo "<script>alert('Błąd podczas kopiowania pliku');</script>";
                            }
                        } else {
                            echo "<script>alert('Plik zapisał się prawidłowo naciśnij OK !');</script>";
                            echo "<script>alert('".$uniqueFilename."');</script>";
                        }
                    }
                    
                    $nazwy_zdjec = implode(',', $zdjecia_do_bazy);
                    
                    $dodanie_danych = "INSERT INTO konkursy (tytul, tresc, `data`, nazwy_zdjec) VALUES ('$tytul', '$tresc', '$data', '$nazwy_zdjec')";
                    
                    if (mysqli_query($polaczenie, $dodanie_danych) === true) {
                        echo "<script>alert('DANE DODANE');
                                    window.location.href='../BIB_REAL_TEST/admin.php';
                        </script>";
                    } else {
                        echo "<script>alert('POMYŁKA PRZY DODAWANIU DANYCH');</script>";
                    }
                    
                }


                if(isset($_POST['usun_main1'])){
                    $id = $_POST['id'];
                    echo "
                    <script>
                        if(document.getElementById('usun_main1').onclick){
                            if(confirm('Czy napewno chcesz usunąć ten konkurs?')){
                                '" . mysqli_query($polaczenie, "DELETE FROM konkursy WHERE id=$id");"';
                            }else{
                                alert('Usunięcie anulowane');
                        }
                            
                    }
                    </script>";
                }
                if(isset($_POST['zapisz_main1'])){
                    $id = $_POST['id'];
                    $tytul = $_POST['tytul'];
                    $tresc = $_POST['tresc'];
                    $data = $_POST['data'];
                    mysqli_query($polaczenie, "UPDATE konkursy SET tytul='$tytul' tresc='$tresc' `data`='$data' WHERE id=$id");
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

        $polaczenie = mysqli_connect('localhost', 'root', '02dE@Ks7sw5sRc4cGj9', 'biblioteka_zss');

        // Если пользователь отправил форму логина
        if(isset($_POST['zaloguj'])) {
            $email = mysqli_real_escape_string($polaczenie, $_POST['email']);
            $haslo = $_POST['haslo'];

            // Проверяем наличие пользователя с этим email
            $sprHaslo = mysqli_query($polaczenie, "SELECT haslo, uprawnienia FROM konta WHERE nazwa_uzytkownika='$email'");
            
            if ($sprHaslo && mysqli_num_rows($sprHaslo) > 0) {
                $row = mysqli_fetch_array($sprHaslo);
                $hashed_password = $row['haslo'];
                $uprawnienia = $row['uprawnienia'];

                // Проверяем пароль
                if (password_verify($haslo, $hashed_password)) {
                    // Сохранение данных сессии
                    $_SESSION['zalogowano'] = $uprawnienia;

                    // Переключение панелей
                    echo "
                    <script>
                        document.getElementById('main0').style.display='inline';
                        document.getElementById('logowanie').style.display='none';

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
                    </script>";
                } else {
                    echo "<script>
                            console.log('Wrong password');
                            alert('Nie prawidlowy email lub hasło! Przenosimy cię do strony głównej.');
                            window.location.href='../BIB_REAL_TEST/';
                        </script>";
                }
            } else {
                echo "<script>
                        console.log('Wrong email');
                        alert('Nie prawidlowy email lub hasło! Przenosimy ci do strony głównej');
                        window.location.href='../BIB_REAL_TEST/';
                    </script>";
            }
        }

        // Проверка наличия сессии после перезагрузки страницы и восстановление состояния
        if(isset($_SESSION['zalogowano'])) {
            echo "
            <script>
                document.getElementById('main0').style.display='inline';
                document.getElementById('logowanie').style.display='none';

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
            </script>";
        }


        if (isset($_POST['confirm']) && $_POST['confirm'] === 'true') {
            session_start();
            session_destroy();
            echo "
            <script>
                window.location.href='../BIB_REAL_TEST/';
            </script>;";
            exit();
        }

        mysqli_close($polaczenie);
        ?>

    
    <!--?php
    // if(isset($_POST['zaloguj'])) {
    //     $email = $_POST['email'];
    //     $haslo = $_POST['haslo'];
    //     $sprHaslo = mysqli_query($polaczenie, "SELECT haslo  FROM konta WHERE nazwa_uzytkownika='$email'");

    //     if ($sprHaslo && mysqli_num_rows($sprHaslo) > 0) {
    //         $row = mysqli_fetch_array($sprHaslo);
    //         $hashed_password = $row[0];

    //         if (password_verify($haslo, $hashed_password)) {
    //             $sesja = mysqli_fetch_array(mysqli_query($polaczenie, "SELECT `uprawnienia` FROM konta WHERE nazwa_uzytkownika='$email'"));
    //             $_SESSION['zalogowano'] = $sesja[0];
    //             echo "
    //             <script>
    //                 document.getElementById('main0').style.display='inline';
    //                 document.getElementById('logowanie').style.display='none';

    //                 // Переключение панелей
    //                 function switchPanel(panelId) {
    //                     // Скрыть все панели
    //                     document.querySelectorAll('.main').forEach(panel => {
    //                         panel.classList.remove('active');
    //                         panel.style.display = 'none'; // Скрыть панель
    //                     });
    //                     // Показать активную панель
    //                     const activePanel = document.getElementById(panelId);
    //                     if (activePanel) {
    //                         activePanel.classList.add('active');
    //                         activePanel.style.display = 'block'; // Показать панель
    //                     }
    //                 }
                

    //             </script>";
    //         } else {
    //             echo "<script>
    //                     console.log('złe hasło');
    //                     const alarm='Nie prawidlowy email lub hasło! \n Przenosimy cię do strony głównej..';
    //                     alert(alarm);
    //                     window.location.href='../BIB_REAL_TEST/';
    //                 </script>";
    //         } //window.location.href='../BIB_REAL_TEST/';
    //     } else {
    //         echo "<script>
    //                 console.log('zły email');
    //                 alert('Nie prawidlowy email lub hasło! Przenosimy cię do strony głównej.');
    //                 window.location.href='../BIB_REAL_TEST/';
    //             </script>";
    //     }
    // }
    // mysqli_close($polaczenie);
    ?-->

    <div id="overlay">
        <span id="close">X</span>
        <img src="" alt="Zoomed Image" style="border-radius: 15px;">
    </div>
    <script src="script.js"></script>
</body>
</html>