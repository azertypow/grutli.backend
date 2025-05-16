<?php

require_once 'utils/Utils.php';

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Site;

/** @global Kirby\Cms\App $kirby */
/** @global Kirby\Cms\Site $site */
/** @global Kirby\Cms\Page $page */

$json = [];


// children pages

$children = $page->children()->listed()->map(function ($item){

  $content = $item->content();

  return [
    'cover' => array_values( Utils::getImageArrayDataInPage( $content->cover()->toFiles() ) ),
    'pageContent'     => $item->toArray(),
  ];
})->data();

$json['childrenDetails'] = array_values( $children );


echo json_encode($json);
