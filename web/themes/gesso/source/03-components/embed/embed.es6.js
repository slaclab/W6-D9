import Drupal from 'drupal';

Drupal.behaviors.embed = {
  attach(context) {
    console.log('hello!!');
    const iframes = Array.from(context.querySelectorAll('.c-embed iframe'));

    iframes.forEach(iframe => {
      const parent = iframe.parentNode;
      const ratio = iframe.width / iframe.height;

      console.log(ratio);

      const wrapper = document.createElement('div');
      wrapper.classList.add('c-embed__wrapper');
      wrapper.style.aspectRatio = ratio;
      wrapper.appendChild(iframe);

      console.log(wrapper);

      iframe.style.aspectRatio = ratio;
      iframe.removeAttribute('height');
      iframe.removeAttribute('width');
      iframe.style.width = '100%';

      parent.appendChild(wrapper);
    });
  }
};
