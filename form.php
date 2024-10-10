<?php

$filename = 'data/oblinfo.txt';

if (file_exists($filename)) {
    $directions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $regions = [];

    for ($i = 0; $i < count($directions); $i += 3) {
        $regions[] = $directions[$i];
    }

} else {
    echo "Файл не знайдено!";
    exit;
}

echo '<form method="post" action="index-table.php">' .
    '<h2>Оберіть область:</h2>'.
    '<select name="region" class="select-input">';

foreach ($regions as $region) {
    echo '<option value="'.$region.'">'.$region.'</option>';
}

echo '<div class="button-container">' .
    '<input type="submit" value="Відправити запит" class="submit-button">' .
    '</div>' .
'</form>';
