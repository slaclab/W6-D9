import React from 'react';

import PageWrapper from './page-wrappers/default.jsx';
import { Page as PageTemplate } from '../04-templates/page/page.stories';

export default {
  title: 'Pages/Page',
  parameters: {
    controls: {
      include: ['show_admin_info'],
    },
  },
};

const Page = args => (
  <PageWrapper>{PageTemplate(PageTemplate.args)}</PageWrapper>
);
export { Page };
