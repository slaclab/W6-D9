import Drupal from 'drupal';
import { throttle } from 'lodash';
import { BREAKPOINTS } from '../../00-config/_GESSO.es6';

Drupal.behaviors.header = {
  attach(context) {
    const header = context.querySelector('.l-header');
    if (header) {
      const updateHeaderInitialHeight = () => {
        const isAlreadySticky = header.classList.contains('is-sticky');
        const runOnceOnTransition = () => {
          document.documentElement.style.setProperty(
            '--gesso-header-initial-height',
            `${header.getBoundingClientRect().height}px`
          );
          header.removeEventListener('transitionend', runOnceOnTransition);
          if (isAlreadySticky) {
            header.classList.add('is-sticky');
          }
        };
        header.addEventListener('transitionend', runOnceOnTransition);
        if (isAlreadySticky) {
          header.classList.remove('is-sticky');
        }
        document.documentElement.style.setProperty(
          '--gesso-header-initial-height',
          `${header.getBoundingClientRect().height}px`
        );
      };
      const updateHeaderCurrentHeight = () => {
        let headerHeight = header.getBoundingClientRect().height;
        const alert = document.querySelector('.c-alert-bar');
        if (alert && !header.classList.contains('is-sticky')) {
          headerHeight += alert.getBoundingClientRect().height;
        }
        document.documentElement.style.setProperty(
          '--gesso-header-current-height',
          `${headerHeight}px`
        );
      };
      const changeOnScroll = throttle(() => {
        const ginToolbarSecondaryHeight = getComputedStyle(
          document.documentElement
        ).getPropertyValue('--ginToolbarSecondaryHeight');
        const stickyTop = ginToolbarSecondaryHeight
          ? parseFloat(ginToolbarSecondaryHeight)
          : 0;
        if (window.scrollY <= stickyTop) {
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
      const mediaQuery = window.matchMedia(
        `(max-width: ${BREAKPOINTS['mobile-menu']})`
      );
      mediaQuery.addEventListener('change', updateHeaderInitialHeight);
      window.addEventListener('scroll', changeOnScroll);
      header.addEventListener('transitionend', updateHeaderCurrentHeight);
      window.addEventListener('scroll', updateScrollProgress);
      document.documentElement.style.setProperty(
        '--gesso-header-initial-height',
        `${header.getBoundingClientRect().height}px`
      );
      updateHeaderCurrentHeight();
    }
  },
};
