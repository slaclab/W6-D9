import React from 'react';

import ReactDOMServer from 'react-dom/server';
import parse from 'html-react-parser';
import globalData from '../00-config/storybook.global-data.yml';
import sectionTwigTemplate from '../02-layouts/section/section.twig';
import gridTwigTemplate from '../02-layouts/grid/grid.twig';
import PageWrapper from './page-wrappers/default.jsx';
import { VideoHero } from '../03-components/video-hero/video-hero.stories';
import { FiftyFifty } from '../03-components/fifty-fifty/fifty-fifty.stories';
import { ColorfulTagline } from '../03-components/tagline/tagline.stories';
import { WYSIWYG } from '../03-components/wysiwyg/wysiwyg.stories';
import { IconCard } from '../03-components/icon-card/icon-card.stories';
import { Carousel } from '../03-components/carousel/carousel.stories';

export default {
  title: 'Pages/Homepage',
  parameters: {
    controls: {
      include: ['show_admin_info'],
    },
  },
};

const Homepage = args => (
  <PageWrapper {...args}>
    {VideoHero(VideoHero.args)}
    {parse(
      sectionTwigTemplate({
        has_constrain: true,
        section_content: ReactDOMServer.renderToStaticMarkup(
          FiftyFifty({
            col_1: ReactDOMServer.renderToStaticMarkup(
              ColorfulTagline({
                ...ColorfulTagline.args,
                tagline_content: false,
              })
            ),
            col_2: ReactDOMServer.renderToStaticMarkup(
              WYSIWYG({
                content: `<p class="c-lede">We explore how the universe works at the biggest, smallest and fastest scales and invent powerful tools used by scientists around the globe. Our research helps solve real-world problems and advances the interests of the nation.</p>
<p class="c-lede"><a href="#0" class="c-arrow-link"><strong>Our Story</strong></a><a href="#0" class="c-arrow-link"><strong>Our People</strong></a></p>`,
              })
            ),
          })
        ),
      })
    )}
    {parse(
      sectionTwigTemplate({
        has_constrain: true,
        modifier_classes: 'l-section--bg-image',
        section_content: gridTwigTemplate({
          grid_content: ReactDOMServer.renderToStaticMarkup(
            <>
              {IconCard(IconCard.args)}
              {IconCard({
                icon: 'space2',
                url: '#0',
                card_title: 'Physics of the Universe',
                card_description:
                  'Studying the particles & forces that knit the cosmos together',
              })}
              {IconCard({
                icon: 'accelerator1',
                url: '#0',
                card_title: 'Advanced Accelerators',
                card_description:
                  'Building smaller, faster, more powerful accelerators for all',
              })}
              {IconCard({
                icon: 'cryo2',
                url: '#0',
                card_title: 'Science of Life',
                card_description:
                  'Understanding the machinery of life at its most basic level',
              })}
              {IconCard({
                icon: 'accelerator2',
                url: '#0',
                card_title: 'New Technologies',
                card_description: 'Inventing new tools for science and society',
              })}
              {IconCard({
                icon: 'space1',
                url: '#0',
                card_title: 'Energy Sciences',
                card_description:
                  "Finding clean, sustainable solutions for the world's energy challenges",
              })}
            </>
          ),
          num_of_cols: 3,
        }),
      })
    )}
    {parse(
      sectionTwigTemplate({
        has_constrain: true,
        section_kicker: 'Where Research Happens',
        section_title: 'Facilities & Centers',
        section_title_url: '#0',
        section_intro: `<p>At our large-scale facilities and specialized centers, scientists take advantage of powerful tools and unique expertise and collaborate with each other across a wide range of disciplines. Working together is what makes science tick.</p>
<p><a href="#0" class="c-button c-button--chevron">Scientific Facilities</a><a href="#0" class="c-button c-button--chevron">Joint Institutes & Centers</a></p>`,
        section_content: ReactDOMServer.renderToStaticMarkup(
          <>{Carousel(Carousel.args)}</>
        ),
      })
    )}
    {parse(
      sectionTwigTemplate({
        has_constrain: true,
        section_kicker: 'Meet Our Teams',
        section_title: 'SLAC People',
        section_title_url: '#0',
        section_intro: `<p>To achieve our ambitious goals and keep SLAC a great place to work, the lab needs a creative, diverse and united workforce – people with a wide variety of experiences and ideas, skills and backgrounds.</p>`,
        section_content: ReactDOMServer.renderToStaticMarkup(
          <>
            {Carousel({
              ...Carousel.args,
            })}
          </>
        ),
        modifier_classes: 'l-section--dark l-section--purple-black',
      })
    )}
  </PageWrapper>
);
Homepage.args = {
  ...globalData,
  bodyClasses: 'has-transparent-nav',
  hideBreadcrumbs: true,
  hideSocialLinks: true,
};

export { Homepage };
