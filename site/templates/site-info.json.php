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
        'children' => array_values($item->children()->map(function ($children){
          return [
            'title'             => $children->title()->value(),
            'showinnavigation'  => $children->showinnavigation()->value(),
            'showinhome'        => $children->showinhome()->value(),
            'parent'            => [
                    'title'             => $children->parent()->title()->value(),
                    'showinnavigation'  => $children->parent()->showinnavigation()->value(),
                    'showinhome'        => $children->parent()->showinhome()->value(),
                    'slug'              => $children->parent()->slug(),
                    'uid'               => $children->parent()->uid(),
                    'uri'               => $children->parent()->uri(),
                    'url'               => $children->parent()->url(),
            ],
            'slug'              => $children->slug(),
            'uid'               => $children->uid(),
            'uri'               => $children->uri(),
            'url'               => $children->url(),
          ];
        })->data()),
      ];
    })->data()),
    'spectacles' => array_values($site->find('/spectacles')->children()->sortBy('dateStart', 'asc')->map(function($item) use ($kirby){

      $content = $item->content();

      $arrayToReturn = [
        'cover' => array_values( Utils::getImageArrayDataInPage( $content->cover()->toFiles() ) ),
        'pageContent'     => $item->toArray(),
      ];

      if (isset($arrayToReturn['pageContent']['content']['company'])) {
        $arrayToReturn['pageContent']['content']['company'] = $item->content()->company()->toStructure()->toArray();
      }
      if (isset($arrayToReturn['pageContent']['content']['eventtitle'])) {
        $arrayToReturn['pageContent']['content']['eventtitle'] = $item->content()->eventtitle()->split();
      }

      return $arrayToReturn;
    })->data()),
    'ticket_infos' => $site->find('/billetterie-infomaniak')->content()->shop()->value()
  ]);

}
