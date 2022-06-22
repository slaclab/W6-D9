import parse from 'html-react-parser';

import twigTemplate from './card.twig';
import data from './card.yml';

import eventCardData from './card-event.yml';
import eventFallbackCardData from './card-event-fallback.yml';
import globalData from '../../00-config/storybook.global-data.yml';

const settings = {
  title: 'Components/Card',
};

const Default = args => (
  parse(twigTemplate({
    ...args,
  }))
);
Default.args = { ...globalData, ...data };

const LargeCard = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'c-card--large',
  }))
);
LargeCard.args = { ...globalData, ...data };

const VideoCard = args => (
  parse(twigTemplate({
    ...args,
    is_video: true,
    type: 'Video',
    footer: 'Jun 2, 2020 · 1:08:48 runtime',
  }))
);
VideoCard.args = { ...globalData, ...data };

const EventCard = args => (
  parse(twigTemplate({
    ...args,
  }))
);
EventCard.args = { ...globalData, ...eventCardData };

const EventFallbackCard = args => (
  parse(twigTemplate({
    ...args,
  }))
);
EventFallbackCard.args = { ...globalData, ...eventFallbackCardData };

export default settings;
export { Default, LargeCard, VideoCard, EventCard, EventFallbackCard };
