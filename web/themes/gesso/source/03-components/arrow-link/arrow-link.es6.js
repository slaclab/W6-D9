import Drupal from 'drupal';

Drupal.behaviors.arrowLink = {
  attach(context) {
    const arrowLinks = context.querySelectorAll(
      '.c-arrow-link, .c-arrow-link--white, .c-card--small-bio a'
    );
    arrowLinks.forEach(link => {
      const text = link.innerHTML.split(' ');
      const lastWord = text.pop();
      const lastWordMarkup = lastWord
        ? ` <span class="c-arrow-link__word">${lastWord}</span>`
        : '';
      link.innerHTML = `${text.join(' ')}${lastWordMarkup}`;
    });
  },
};
