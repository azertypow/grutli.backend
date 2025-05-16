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


// content

$json['pageContent'] = $page->toArray();

if (isset($json['pageContent']['content']['htmldetails'])) {
  $json['pageContent']['content']['htmldetails'] = Utils::blockContentToJson($page->content()->htmldetails()->toBlocks());
}

if (isset($json['pageContent']['content']['htmlcontent'])) {
  $json['pageContent']['content']['htmlcontent'] = Utils::blockContentToJson($page->content()->htmlcontent()->toBlocks());
}

//


echo json_encode($json);
