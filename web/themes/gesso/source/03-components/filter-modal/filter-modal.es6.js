import Drupal from 'drupal';

Drupal.behaviors.filterModal = {
  attach(context) {
    const modalOuter = context.querySelector('.c-filter-modal');
    const modalInner = context.querySelector('.c-filter-modal__inner');
    const modalClose = modalOuter && modalOuter.querySelector('.js-lightbox__close');

    if (!modalOuter || !modalInner || !modalClose) {
      return;
    }

    modalOuter.addEventListener('click', e => {
      if (!modalInner.contains(e.target)) {
        modalClose.click();
      }
    })
  },
};
