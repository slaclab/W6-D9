import Drupal from 'drupal';

Drupal.behaviors.arrowLink = {
  attach(context) {
    const arrowLinks = context.querySelectorAll(
      '.c-arrow-link, .c-arrow-link--white, .c-card--small-bio a'
    );
    arrowLinks.forEach(link => {
      const text = link.innerText.split(' ');
      const lastWord = text.pop();
      const lastWordMarkup = lastWord ? ` <span>${lastWord}</span>` : '';
      link.innerHTML = `${text.join(' ')}${lastWordMarkup}`;
    });
  },
};
