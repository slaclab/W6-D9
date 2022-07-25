import Drupal from 'drupal';

Drupal.behaviors.embed = {
  attach(context) {
    const iframes = Array.from(context.querySelectorAll('.c-embed iframe'));

    iframes.forEach(iframe => {
      const parent = iframe.parentNode;
      const ratio = iframe.width / iframe.height;

      const wrapper = document.createElement('div');
      wrapper.classList.add('c-embed__wrapper');
      wrapper.style.aspectRatio = ratio;
      wrapper.appendChild(iframe);

      iframe.style.aspectRatio = ratio;
      iframe.removeAttribute('height');
      iframe.removeAttribute('width');
      iframe.style.width = '100%';

      parent.appendChild(wrapper);
    });
  }
};
