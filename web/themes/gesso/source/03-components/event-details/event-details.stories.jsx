import parse from 'html-react-parser';

import twigTemplate from './event-details.twig';
import data from './event-details.yml';
import globalData from '../../00-config/storybook.global-data.yml';
import './event-details.scss';

const settings = {
  title: 'Components/Event Details',
};

const EventDetails = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDetails.args = { ...globalData, ...data };

export default settings;
export { EventDetails };
