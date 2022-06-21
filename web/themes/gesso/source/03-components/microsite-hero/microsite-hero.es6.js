import Drupal from 'drupal';
import MobileMenu from '../mobile-menu/modules/_MobileMenu.es6';

Drupal.behaviors.micrositeHero = {
  attach(context) {
    const menuNodes = context.querySelectorAll('.c-microsite-hero__menu');
    menuNodes.forEach(menuNode => {
      const mobileMenu = new MobileMenu(menuNode, context, {
        classPrefix: 'c-microsite-hero__menu',
        otherBlockClass: '.c-microsite-hero__title--mobile',
      });
      mobileMenu.init();
    });
  },
};
