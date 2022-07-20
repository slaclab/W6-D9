import Drupal from 'drupal';

Drupal.behaviors.filterModal = {
  attach(context) {
    const modalOuter = context.querySelector('.c-filter-modal');
    const modalInner = context.querySelector('.c-filter-modal__inner');
    const modalClose = context.querySelector('.c-filter-modal__close');
    const modalClear = context.querySelector('.c-filter-modal__clear');
    const modalApply = context.querySelector('.c-filter-modal__apply');
    const fields = context.querySelectorAll('input[type=checkbox]');

    if (modalClear) {
      modalClear.addEventListener('click', () => {
        fields.forEach(field => {
          field.checked = false;
        });
      });
    }

    if (!modalOuter || !modalInner || !modalClose) {
      return;
    }

    modalOuter.addEventListener('click', e => {
      if (!modalInner.contains(e.target)) {
        modalClose.click();
      }
    });

    // Integration: update to apply the filters.
    if (modalApply) {
      modalApply.addEventListener('click', () => {
        modalClose.click();
      })
    }
  },
};
