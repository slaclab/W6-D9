import Drupal from 'drupal';
import { throttle } from 'lodash';
import { BREAKPOINTS } from '../../00-config/_GESSO.es6';

Drupal.behaviors.header = {
  attach(context) {
    const header = context.querySelector('.l-header');
    if (header) {
      document.documentElement.style.setProperty(
        '--gesso-header-initial-height',
        `${header.getBoundingClientRect().height}px`
      );
      const updateHeaderHeight = () => {
        document.documentElement.style.setProperty(
          '--gesso-header-current-height',
          `${header.getBoundingClientRect().height}px`
        );
      };
      const mediaQuery = window.matchMedia(
        `(min-width: ${BREAKPOINTS['mobile-menu']})`
      );
      const changeOnScroll = throttle(() => {
        if (window.scrollY === 0) {
          header.classList.remove('is-sticky');
        } else if (!header.classList.contains('is-sticky')) {
          header.classList.add('is-sticky');
        }
      }, 16);
      const updateScrollProgress = throttle(() => {
        const scrollTop =
          document.body.scrollTop || document.documentElement.scrollTop;
        const height =
          document.documentElement.scrollHeight -
          document.documentElement.clientHeight;
        const scrolledAmt = Math.round((scrollTop / height) * 100);
        header.style.setProperty('--gesso-scroll-progress', `${scrolledAmt}%`);
      }, 16);
      mediaQuery.addEventListener('change', event => {
        if (event.matches) {
          window.addEventListener('scroll', changeOnScroll);
          header.addEventListener('transitionend', updateHeaderHeight);
        } else {
          window.removeEventListener('scroll', changeOnScroll);
          header.removeEventListener('transitionend', updateHeaderHeight);
          updateHeaderHeight();
        }
      });
      if (mediaQuery.matches) {
        window.addEventListener('scroll', changeOnScroll);
        header.addEventListener('transitionend', updateHeaderHeight);
        changeOnScroll();
      }
      window.addEventListener('scroll', updateScrollProgress);
    }
  },
};
