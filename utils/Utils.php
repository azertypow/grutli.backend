<?php

class Utils
{
    static function getImageArrayDataInPage(\Kirby\Cms\Files $files): array|null
    {
        return $files->map(function (\Kirby\Cms\File $item): array {
            return self::getJsonEncodeImageData($item);
        })->data();
    }

    static function muteImageFilesDataIfBlocksHasKeyValue(string $contentTypeKey, &$content): void
    {
        if (!isset($content['content'][$contentTypeKey])) return;

        foreach ($content['content'][$contentTypeKey] as &$itemArray) {
            //todo: images with s for profiles importation | change images to image in dataBase and profiles json result
            if (isset($itemArray['images'])) $itemArray['imageData'] = self::getImageArrayDataInArray($itemArray, 'images');
            if (isset($itemArray['image'])) $itemArray['imageData'] = self::getImageArrayDataInArray($itemArray, 'image');
        }
    }

    static function getImageArrayDataInArray(array &$itemArray, string $keyNameForImage): array
    {
        $getImageArrayData = Utils::getImageArrayDataInPage(new \Kirby\Cms\Files($itemArray[$keyNameForImage]));
        return $itemArray['imageData'] = array_values($getImageArrayData);
    }


    static function getJsonEncodeImageData(\Kirby\Cms\File $file): array
    {
        return [
            'caption' => $file->caption()->value(),
            'alt' => $file->alt()->value(),
            'link' => $file->link()->value(),
            'photoCredit' => $file->photoCredit()->value(),
            'url' => $file->url(),
            'mediaUrl' => $file->mediaUrl(),
            'width' => $file->width(),
            'height' => $file->height(),
            'resize' => [
                'tiny' => $file->resize(50, null, 10)->url(),
                'small' => $file->resize(500)->url(),
                'reg' => $file->resize(1280)->url(),
                'large' => $file->resize(1920)->url(),
                'xxl' => $file->resize(2500)->url(),
            ]
        ];
    }

    static function blockContentToJson(Kirby\Cms\Blocks $project): array {
        return array_values(
            $project
                ->map(
                    function ($item) {

                        if ($item->type() == 'image' | $item->type() == 'imageGallery') {

                            $arrayImages = Utils::getImageArrayDataInPage($item->content()->image()->tofiles());

                            return array_merge(
                                $item->toArray(),
                                [
                                    'images' => $arrayImages ? array_values($arrayImages) : [],
                                ]
                            );
                        }

                        return $item->toArray();

                    }
                )
                ->data()
        );
    }
}
