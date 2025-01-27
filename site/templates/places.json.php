<?php

require_once 'utils/Utils.php';

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Site;

/** @global Kirby\Cms\App $kirby */
/** @global Kirby\Cms\Site $site */
/** @global Kirby\Cms\Page $page */

$json = [];

$children = $page->childrenAndDrafts()->map(function ($item){

  $content = $item->content();

  return [
    'title' => $content->title()->value(),
    'slug'  => $item->slug(),
  ];
})->data();

$json['value'] = array_values( $children );

echo json_encode($json);
