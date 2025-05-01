<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen.
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */

header("Access-Control-Allow-Origin: *");

return [
    'debug' => true,
    'routes' => [
        [
            'pattern' => '/',
            'action' => function () {
                go('panel');
            },
        ],
        [
            'pattern' => '/site-info.json',
            'action' => function() {
                include_once 'site/templates/site-info.json.php';


                return \Kirby\Cms\Response::json(
                    getSiteInfo(kirby(), site())
                );
            }
        ],
    ],
    'panel' => [
        'css' => 'site/plugins/custom-panel/css/main.css'
    ],
    'hooks' => [
        'page.create:after' => function ($page) {
            if ($page->intendedTemplate()->name() == 'season') {
                try {
                    $page = $page->changeStatus('listed');
                } catch (Exception $e) {
                    // Optionnel : log ou silence en prod
                     error_log($e->getMessage());
                }
            }
        }
    ]
];
