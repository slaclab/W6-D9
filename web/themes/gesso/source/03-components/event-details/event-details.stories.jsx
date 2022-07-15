import parse from 'html-react-parser';

import twigTemplate from './event-details.twig';
import globalData from '../../00-config/storybook.global-data.yml';
import data from './event-details.yml';
import './event-details.scss';

const settings = {
  title: 'Components/Event Details',
  parameters: {
    controls: {
      include: [
        'event_type',
        'month',
        'day',
        'image_url',
        'map_link_text',
        'calendar_link_text',
        'ctas',
        'zoom_details',
        'additional_links',
      ],
    },
  },
};

const EventDetails = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDetails.args = { ...globalData, ...data };

const EventDetailsMultiday = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDetailsMultiday.args = {
  ...globalData,
  ...data,
  is_multiday: true,
  day: '19-22',
  calendar_link_text: 'Thursday, April 19, 2022 - Saturday, April 22, 2022',
};

export default settings;
export { EventDetails, EventDetailsMultiday };
