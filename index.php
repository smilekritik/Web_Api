<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();
$url = 'https://shikimori.me/api/animes?limit=10&order=random';
$response = $client->get($url);
$data = json_decode($response->getBody());

echo '<!DOCTYPE html><html lang="uk"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Аніме з API</title><link rel="stylesheet" type="text/css" href="style.css"></head><body>';
echo '<h1>Список випадкових аніме:</h1>';
echo '<div class="anime-grid">';

$count = 0;
foreach ($data as $anime) {
    if ($count % 5 === 0) {
        if ($count > 0) {
            echo '</div>';
        }
        echo '<div class="anime-row">';
    }
    echo '<div class="anime-card">';
    echo '<a href="https://shikimori.me' . $anime->url . '">';
    echo '<img class="anime-image" src="https://shikimori.me' . $anime->image->original . '" alt="' . $anime->russian . '">';
    echo '<div class="anime-title">' . $anime->russian . '</div>';
    echo '</a>';
    echo '<div class="anime-info"><strong>Тип:</strong> ' . $anime->kind . '</div>';
    echo '<div class="anime-info"><strong>Оцінка:</strong> ' . $anime->score . '</div>';
    echo '<div class="anime-info"><strong>Статус:</strong> ' . $anime->status . '</div>';
    echo '<div class="anime-info"><strong>Епізоди:</strong> ' . $anime->episodes . '</div>';
    echo '</div>';
    $count++;
}
if ($count > 0) {
    echo '</div>';
}

echo '</div>';
echo '</body></html>';
