import { tns } from 'tiny-slider';
import Drupal from 'drupal';
import { debounce } from 'lodash';
import { SITE_MARGINS } from '../../00-config/_GESSO.es6';

Drupal.behaviors.carousel = {
  attach(context) {
    const carousels = context.querySelectorAll('.c-carousel__slides');
    carousels.forEach(carousel => {
      const slider = tns({
        arrowKeys: true,
        autoWidth: true,
        center: false,
        container: carousel,
        controls: true,
        controlsPosition: 'bottom',
        items: 1.2,
        gutter: parseInt(SITE_MARGINS.mobile, 10),
        loop: true,
        navAsThumbnails: true,
        navContainer: carousel.parentNode.querySelector('.c-carousel__pager'),
        navPosition: 'bottom',
        nextButton: carousel.parentNode.querySelector('.c-carousel__next'),
        prevButton: carousel.parentNode.querySelector('.c-carousel__prev'),
        responsive: {
          1024: {
            gutter: parseInt(SITE_MARGINS.desktop, 10),
          },
          1200: {
            autoWidth: false,
            fixedWidth: 920,
          },
        },
        slideBy: 1,
      });
      const handleResize = debounce(() => {
        slider.refresh();
      }, 16);
      window.addEventListener('resize', handleResize);
    });
  },
};
