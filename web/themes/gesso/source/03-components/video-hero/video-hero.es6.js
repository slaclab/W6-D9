import Drupal from 'drupal';
import { BREAKPOINTS } from '../../00-config/_GESSO.es6';

Drupal.behaviors.videoHero = {
  attach(context) {
    const videoHero = context.querySelector('.c-video-hero');
    if (videoHero) {
      const mediaQuery = window.matchMedia(
        `(min-width: ${BREAKPOINTS.desktop})`
      );
      const handleMediaQueryChange = event => {
        if (event.matches) {
          const videos = videoHero.querySelectorAll('.c-video-hero__video');
          const selectedVideoIndex = Math.floor(Math.random() * videos.length);
          const selectedVideo = videos[selectedVideoIndex];
          selectedVideo.insertAdjacentHTML(
            'beforebegin',
            `<iframe allowfullscreen src="${selectedVideo.dataset.src}"></iframe>`
          );
          selectedVideo.parentElement.classList.add('has-video');
        } else {
          const video = videoHero.querySelector('iframe');
          if (video) {
            video.parentElement.classList.remove('has-video');
            video.parentNode.removeChild(video);
          }
        }
      };
      mediaQuery.addEventListener('change', handleMediaQueryChange);
      handleMediaQueryChange(mediaQuery);
    }
  },
};
