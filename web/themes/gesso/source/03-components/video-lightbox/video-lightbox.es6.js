import Drupal from 'drupal';

Drupal.behaviors.videoLightbox = {
  attach(context) {
    const triggers = context.querySelectorAll('.js-video-lightbox');
    triggers.forEach(trigger => {
      const lightbox = document.getElementById(
        trigger.getAttribute('aria-controls')
      );
      if (!lightbox) return;
      trigger.addEventListener('click', () => {
        const videoIFrame = lightbox.querySelector('iframe');
        if (videoIFrame && videoIFrame.hasAttribute('data-src')) {
          videoIFrame.setAttribute('src', videoIFrame.getAttribute('data-src'));
        }
        lightbox.classList.remove('u-hidden');
      });
    });
  },
};
