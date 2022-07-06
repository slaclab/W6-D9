import ReactDOMServer from 'react-dom/server';
import React from 'react';
import parse from 'html-react-parser';

import twigTemplate from './event-detail.twig';
import data from './event-detail.yml';
import tagData from '../../03-components/tag-list/tag-list.yml';
import mapData from '../../03-components/map/map.yml';
import { EventDetails } from '../../03-components/event-details/event-details.stories';

const settings = {
  title: 'Templates/Event Detail'
};

const EventDetail = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );

EventDetail.args = {
  ...data,
  map_iframe: mapData.map_iframe,
  related_topics: tagData.items,
  details: ReactDOMServer.renderToStaticMarkup(<>{EventDetails(EventDetails.args)}</>),
};

export default settings;
export { EventDetail };
