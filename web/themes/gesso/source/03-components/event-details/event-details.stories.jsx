import parse from 'html-react-parser';

import twigTemplate from './event-details.twig';
import globalData from '../../00-config/storybook.global-data.yml';

import data from './event-details.yml';
import plData from './event-details-purple-lavender.yml';
import tpData from './event-details-teal-palo.yml';
import cdData from './event-details-cardinal-digital.yml';

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

const EventDetailsPurpleLavender = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDetailsPurpleLavender.args = { ...globalData, ...plData };

const EventDetailsTealPalo = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDetailsTealPalo.args = { ...globalData, ...tpData };

const EventDetailsCardinalDigital = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDetailsCardinalDigital.args = { ...globalData, ...cdData };

export default settings;
export { EventDetails, EventDetailsPurpleLavender, EventDetailsTealPalo, EventDetailsCardinalDigital };
