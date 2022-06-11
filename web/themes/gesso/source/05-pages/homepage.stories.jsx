import React from 'react';

import globalData from '../00-config/storybook.global-data.yml';
import PageWrapper from './page-wrappers/default.jsx';
import { VideoHero } from '../03-components/video-hero/video-hero.stories';

export default {
  title: 'Pages/Homepage',
  parameters: {
    controls: {
      include: ['show_admin_info'],
    },
  },
};

const Homepage = args => (
  <PageWrapper {...args}>{VideoHero(VideoHero.args)}</PageWrapper>
);
Homepage.args = {
  ...globalData,
  bodyClasses: 'has-transparent-nav',
  hideBreadcrumbs: true,
  hideSocialLinks: true,
};

export { Homepage };
