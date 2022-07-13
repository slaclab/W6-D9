import Isotope from 'isotope-layout';
import Packery from 'isotope-packery';
import Drupal from 'drupal';

Drupal.behaviors.carousel = {
  attach(context) {
    const grid = context.querySelector('.c-topic-grid');
    const iso = new Isotope(grid, {
      layoutMode: 'packery',
      itemSelector: '.c-topic-grid__item',
      // gutter: 20,
      percentPosition: true,
      packery: {
        columnWidth: '.c-topic-grid__sizer',
        gutter: '.c-topic-grid__gutter',
      }
    });

    const filterSelect = context.querySelector('.c-topic-grid__select');
    filterSelect.addEventListener('change', function filterGrid(e) {
      iso.arrange({ filter: this.value });
    });
  },
};
