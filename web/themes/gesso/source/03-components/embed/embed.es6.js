import Drupal from 'drupal';

Drupal.behaviors.embed = {
  attach(context) {
    const iframes = Array.from(context.getElementsByTagName('iframe'));

    iframes.forEach(iframe => {
      const ratio = iframe.width / iframe.height;

      iframe.style.aspectRatio = ratio;
      iframe.removeAttribute('height');
      iframe.removeAttribute('width');
    });
  }
};
