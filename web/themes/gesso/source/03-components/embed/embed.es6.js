import Drupal from 'drupal';

Drupal.behaviors.gessoEmbed = {
  attach(context) {
    const iframes = Array.from(context.querySelectorAll('.c-embed iframe'));

    iframes.forEach(iframe => {
      const parent = iframe.parentNode;
      const ratio =
        (iframe.width > 0 ? iframe.width : iframe.offsetWidth) /
        (iframe.height > 0 ? iframe.height : iframe.offsetHeight);

      const wrapper = document.createElement('div');
      wrapper.classList.add('c-embed__wrapper');
      wrapper.style.aspectRatio = ratio;
      wrapper.appendChild(iframe);

      iframe.style.aspectRatio = ratio;
      iframe.removeAttribute('height');
      iframe.removeAttribute('width');
      iframe.style.removeProperty('height');
      iframe.style.width = '100%';

      parent.appendChild(wrapper);
    });
  },
};
