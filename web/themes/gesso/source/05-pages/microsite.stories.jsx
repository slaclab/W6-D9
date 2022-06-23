import React from 'react';

import PageWrapper from './page-wrappers/microsite.jsx';
import { WYSIWYG } from '../03-components/wysiwyg/wysiwyg.stories';
import { MicrositeHero } from '../03-components/microsite-hero/microsite-hero.stories';

export default {
  title: 'Pages/Microsite',
  parameters: {
    controls: {
      include: ['show_admin_info'],
    },
  },
};

const Microsite = args => (
  <PageWrapper {...args}>
    <a id="intro" className="js-microsite-section" />
    {WYSIWYG(WYSIWYG.args)}
    <a id="tour-types" className="js-microsite-section" />
    {WYSIWYG(WYSIWYG.args)}
    <a id="facility-stops" className="js-microsite-section" />
    {WYSIWYG(WYSIWYG.args)}
    <a id="visitor-info" className="js-microsite-section" />
    {WYSIWYG(WYSIWYG.args)}
  </PageWrapper>
);
Microsite.args = {
  hero: MicrositeHero({
    ...MicrositeHero.args,
    microsite_hero_title: 'Public Tours',
  }),
};
export { Microsite };
