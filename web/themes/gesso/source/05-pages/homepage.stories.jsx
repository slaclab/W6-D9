import React from 'react';

import ReactDOMServer from 'react-dom/server';
import parse from 'html-react-parser';
import globalData from '../00-config/storybook.global-data.yml';
import sectionTwigTemplate from '../02-layouts/section/section.twig';
import PageWrapper from './page-wrappers/default.jsx';
import { VideoHero } from '../03-components/video-hero/video-hero.stories';
import { FiftyFifty } from '../03-components/fifty-fifty/fifty-fifty.stories';
import { ColorfulTagline } from '../03-components/tagline/tagline.stories';
import { WYSIWYG } from '../03-components/wysiwyg/wysiwyg.stories';

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
  </PageWrapper>
);
Homepage.args = {
  ...globalData,
  bodyClasses: 'has-transparent-nav',
  hideBreadcrumbs: true,
  hideSocialLinks: true,
};

export { Homepage };
