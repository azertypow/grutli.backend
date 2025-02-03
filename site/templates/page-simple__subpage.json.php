<?php

require_once 'utils/Utils.php';

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Site;

/** @global Kirby\Cms\App $kirby */
/** @global Kirby\Cms\Site $site */
/** @global Kirby\Cms\Page $page */

$json = [];

$json['pageContent'] = $page->toArray();

if (isset($json['pageContent']['content']['content'])) {

   $content = $page->content()->content()->toBlocks()->map(function ($item) {

    $toReturn = $item->toArray();

    if (isset($toReturn['content']['htmlcontent'])) {
      $toReturn['content']['htmlcontent'] = Utils::blockContentToJson($item->content()->htmlcontent()->toBlocks());
    }
    if (isset($toReturn['content']['htmlcontent_falk'])) {
      $toReturn['content']['htmlcontent_falk'] = Utils::blockContentToJson($item->content()->htmlcontent_falk()->toBlocks());
    }

    return $toReturn;
  })->data();


  $json['pageContent']['content']['content'] = array_values($content);
}



echo json_encode($json);
