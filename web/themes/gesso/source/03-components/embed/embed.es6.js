import Drupal from 'drupal';

Drupal.behaviors.embed = {
  attach(context) {
    let iframes = Array.from(context.getElementsByTagName('iframe'));

    iframes.forEach(iframe => {
      let ratio = iframe.width / iframe.height;

      iframe.style.aspectRatio = ratio;
      iframe.removeAttribute('height');
      iframe.removeAttribute('width');
    });
  }
};
