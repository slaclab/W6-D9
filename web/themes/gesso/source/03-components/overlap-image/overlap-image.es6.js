import Drupal from 'drupal';
import { throttle } from 'lodash';

Drupal.behaviors.overlapImage = {
  attach(context) {
    const overlapImages = context.querySelectorAll('.c-overlap-image');
    if (overlapImages.length) {
      const updateOnResize = () => {
        overlapImages.forEach(overlapImage => {
          const overlapImageText = overlapImage.querySelector(
            '.c-overlap-image__text'
          );
          if (overlapImageText) {
            overlapImage.style.setProperty(
              '--c-overlap-image-height',
              `${overlapImageText.offsetHeight}px`
            );
          }
        });
      };
      window.addEventListener('resize', throttle(updateOnResize, 150));
      updateOnResize();
    }
  },
};
