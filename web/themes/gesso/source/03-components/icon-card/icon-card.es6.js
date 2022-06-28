import Drupal from 'drupal';
import { animateIcon } from '../animated-icon/animated-icon.es6';

Drupal.behaviors.iconCard = {
  attach(context) {
    const iconCards = context.querySelectorAll('.c-icon-card a');
    iconCards.forEach(iconCard => {
      let insideIconCard = false;
      iconCard.addEventListener('mouseover', () => {
        if (!insideIconCard) {
          insideIconCard = true;
          animateIcon(iconCard);
        }
      });
      iconCard.addEventListener('mouseout', () => {
        if (!iconCard.matches(':hover')) {
          insideIconCard = false;
        }
      });
      const iconCardTitle = iconCard.querySelector('.c-icon-card__title');
      if (iconCardTitle) {
        const text = iconCardTitle.innerText.split(' ');
        const lastWord = text.pop();
        const lastWordMarkup = lastWord ? ` <span>${lastWord}</span>` : '';
        iconCardTitle.innerHTML = `${text.join(' ')}${lastWordMarkup}`;
      }
    });
  },
};
