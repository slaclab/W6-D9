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
    }
  },
};
