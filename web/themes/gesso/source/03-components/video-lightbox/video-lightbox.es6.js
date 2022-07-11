import Drupal from 'drupal';

Drupal.behaviors.videoLightbox = {
  attach(context) {
    const triggers = context.querySelectorAll('.js-video-lightbox');
    triggers.forEach(trigger => {
      const lightbox = document.getElementById(
        trigger.getAttribute('aria-controls')
      );
      if (!lightbox) return;
      function handleKeydown(event) {
        const { key, shiftKey } = event;
        if (key === 'Escape') {
          // eslint-disable-next-line no-use-before-define
          closeLightbox(event);
        }
        // Keep the user from tabbing out of the modal.
        const focusable = Array.from(
          lightbox.querySelectorAll(
            'button, [href], input, select, textarea, iframe'
          )
        ).filter(item => item.tabIndex !== -1);
        const numberFocusElements = focusable.length;
        const firstFocusableElement = focusable[0];
        const lastFocusableElement = focusable[numberFocusElements - 1];
        if (key === 'Tab') {
          if (shiftKey && document.activeElement === firstFocusableElement) {
            event.preventDefault();
            lastFocusableElement.focus();
          } else if (
            document.activeElement === lastFocusableElement &&
            !shiftKey
          ) {
            event.preventDefault();
            firstFocusableElement.focus();
          }
        }
      }
      function closeLightbox(event) {
        event.preventDefault();
        const videoIFrame = lightbox.querySelector('iframe');
        if (videoIFrame && videoIFrame.hasAttribute('src')) {
          videoIFrame.setAttribute('data-src', videoIFrame.getAttribute('src'));
          videoIFrame.removeAttribute('src');
        }
        lightbox.classList.add('u-hidden');
        trigger.focus();
        window.removeEventListener('keydown', handleKeydown);
      }
      const closeButton = lightbox.querySelector('.c-video-lightbox__close');
      closeButton.addEventListener('click', closeLightbox);
      trigger.addEventListener('click', () => {
        const videoIFrame = lightbox.querySelector('iframe');
        if (videoIFrame && videoIFrame.hasAttribute('data-src')) {
          videoIFrame.setAttribute('src', videoIFrame.getAttribute('data-src'));
        }
        lightbox.classList.remove('u-hidden');
        closeButton.focus();
        window.addEventListener('keydown', handleKeydown);
      });
    });
  },
};
