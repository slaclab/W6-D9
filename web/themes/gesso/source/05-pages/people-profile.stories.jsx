import React from 'react';

import ReactDOMServer from 'react-dom/server';
import PageWrapper from './page-wrappers/default.jsx';
import { PeopleProfile as PeopleProfileTemplate } from '../04-templates/people-profile/people-profile.stories';
import { Default as Pager } from '../03-components/pager/pager.stories';

export default {
  title: 'Pages/People Profile',
  parameters: {
    controls: {
      include: ['show_admin_info'],
    },
  },
};

const PeopleProfile = () => (
  <PageWrapper>
    {PeopleProfileTemplate({
      ...PeopleProfileTemplate.args,
      related_kicker: 'Related News',
      related_title: 'Selected Stories featuring Mark Hogan',
      related_content: ReactDOMServer.renderToStaticMarkup(
        <>{Pager(Pager.args)}</>
      ),
    })}
  </PageWrapper>
);
export { PeopleProfile };
