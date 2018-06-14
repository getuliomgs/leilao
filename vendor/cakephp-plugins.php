<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CakePdf' => $baseDir . '/vendor/friendsofcake/cakepdf/',
        'Cake/Localized' => $baseDir . '/vendor/cakephp/localized/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'TwitterBootstrap' => $baseDir . '/vendor/cakephp-brasil/twitter-bootstrap/',
        'boletophp' => $baseDir . '/plugins/boletophp/'
    ]
];
