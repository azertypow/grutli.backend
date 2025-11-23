<?php

Kirby::plugin('grutli/soundcloud-block', [
    'snippets' => [
        'blocks/soundCloudPlayer' => __DIR__ . '/snippets/soundCloudPlayer.php'
    ],
    'assets' => [
        'index.js' => __DIR__ . '/index.js',
        'index.css' => __DIR__ . '/index.css'
    ]
]);
