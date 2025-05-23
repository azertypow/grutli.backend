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
//    'pageContent' => $item->toArray(),
    'title'         => $content->title()->value(),
    'slug'          => $item->slug(),
    'eventInfo'     => $content->eventInfo()->value(),
    'event_intro'   => $content->event_intro()->value(),
    'company'       => $content->company()->toStructure()->toArray(),
  ];
})->data();

$json['childrenDetails'] = array_values( $children );


echo json_encode($json);
