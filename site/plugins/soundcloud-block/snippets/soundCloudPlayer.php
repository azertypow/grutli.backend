<?php
/** @var \Kirby\Cms\Block $block */
$url = $block->url();

if (empty($url)) {
    return;
}

// Convert SoundCloud URL to embed format
$embedUrl = 'https://w.soundcloud.com/player/?url=' . urlencode($url) . '&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true';
?>

<div class="block block-type-soundcloudplayer">
    <iframe
        width="100%"
        height="166"
        scrolling="no"
        frameborder="no"
        allow="autoplay"
        src="<?= $embedUrl ?>">
    </iframe>
</div>
