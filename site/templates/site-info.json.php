<?php

require_once 'utils/Utils.php';

/** @global Kirby\Cms\App $kirby */
/** @global Kirby\Cms\Site $site */
/** @global Kirby\Cms\Page $page */

function getSiteInfo(Kirby\Cms\App $kirby, Kirby\Cms\Site $site): bool|string
{
  return json_encode([
    'page-simple' => array_values($site->children()->filterBy('template', 'page-simple')->map(function($item) use ($kirby){

      $content = $item->content();

      return [
        'cover' => array_values( Utils::getImageArrayDataInPage( $content->cover()->toFiles() ) ),
        'pageContent'     => $item->toArray(),
      ];
    })->data()),
    'spectacles' => array_values($site->find('/spectacles')->children()->map(function($item) use ($kirby){

      $content = $item->content();

      return [
        'cover' => array_values( Utils::getImageArrayDataInPage( $content->cover()->toFiles() ) ),
        'pageContent'     => $item->toArray(),
      ];
    })->data()),
  ]);

}
