import Drupal from 'drupal';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

Drupal.behaviors.gessoTransitions = {
  attach(context) {
    // Fade In from Left
    const fadeIns = gsap.utils.toArray('.u-fade-left, .u-fade-right', context);
    fadeIns.forEach(item => {
      gsap.set(item, {
        autoAlpha: 0,
        x: item.classList.contains('u-fade-left') ? -100 : 100,
      });

      ScrollTrigger.create({
        trigger: item,
        start: 'bottom bottom',
        once: true,
        onEnter: () => {
          gsap.to(item, {
            autoAlpha: 1,
            x: 0,
          });
        },
      });
    });
  },
};
