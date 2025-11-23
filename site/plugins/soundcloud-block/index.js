panel.plugin("grutli/soundcloud-block", {
  blocks: {
    soundCloudPlayer: {
      computed: {
        embedUrl() {
          if (!this.content.url) {
            return null;
          }

          // Convert SoundCloud URL to embed format
          // https://soundcloud.com/artist/track -> https://w.soundcloud.com/player/?url=https://soundcloud.com/artist/track
          const url = this.content.url;
          return `https://w.soundcloud.com/player/?url=${encodeURIComponent(url)}&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true`;
        }
      },
      template: `
        <div @click="open" class="k-block-type-soundCloudPlayer">
          <div v-if="embedUrl" class="soundcloud-preview">
            <iframe
              width="100%"
              height="166"
              scrolling="no"
              frameborder="no"
              allow="autoplay"
              :src="embedUrl">
            </iframe>
          </div>
          <div v-else class="soundcloud-placeholder">
            <p>Ajouter une URL SoundCloud</p>
          </div>
        </div>
      `
    }
  }
});
