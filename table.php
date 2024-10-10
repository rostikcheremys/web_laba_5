<?php

if (!isset($_POST['region'])) {
    echo "Необхідно вибрати область!";
    exit;
}

$selectedRegion = $_POST['region'];
$dataFile = 'data/oblinfo.txt';

if (!file_exists($dataFile)) {
    echo "Файл не знайдено!";
    exit;
}

$data = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$regionData = [];

for ($i = 0; $i < count($data); $i += 3) {
    if (trim($data[$i]) === $selectedRegion) {
        $regionData = [
            'region' => $data[$i],
            'population' => $data[$i + 1],
            'universities' => $data[$i + 2]
        ];
        break;
    }
}

if (!empty($regionData)) {
    $universitiesPer100k = ($regionData['population'] != 0) ? round($regionData['universities'] * 100 / $regionData['population'], 2) : 0;

    echo "<h1 class='name-direction'>Інформація про обрану область: {$regionData['region']}</h1>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>" .
        "<tr><th>Область</th><th>Населення (тис.)</th><th>Кількість ВНЗ</th><th>ВНЗ на 100 тис. населення</th></tr>";

    echo "<tr>" .
        "<td>{$regionData['region']}</td>" .
        "<td>{$regionData['population']}</td>" .
        "<td>{$regionData['universities']}</td>" .
        "<td>{$universitiesPer100k}</td>" .
        "</tr>";

    echo "</table>";
} else {
    echo "Інформацію про обрану область не знайдено!";
}
