import parse from 'html-react-parser';

import twigTemplate from './card.twig';
import data from './card.yml';

import eventCardData from './card-event.yml';
import eventFallbackCardData from './card-event-fallback.yml';
import bioCardData from './card-bio.yml';
import globalData from '../../00-config/storybook.global-data.yml';

const settings = {
  title: 'Components/Card',
};

const Default = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
Default.args = { ...globalData, ...data };

const LargeCard = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-card--large',
    })
  );
LargeCard.args = { ...globalData, ...data };

const TeaserCard = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-card--teaser',
    })
  );
TeaserCard.args = { ...globalData, ...data };

const EventTeaserCard = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-card--teaser',
    })
  );
EventTeaserCard.args = { ...globalData, ...eventCardData };

const VideoCard = args =>
  parse(
    twigTemplate({
      ...args,
      is_video: true,
      type: 'Video',
      footer: 'Jun 2, 2020 · 1:08:48 runtime',
    })
  );
VideoCard.args = { ...globalData, ...data };

const EventCard = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventCard.args = { ...globalData, ...eventCardData };

const EventFallbackCard = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventFallbackCard.args = { ...globalData, ...eventFallbackCardData };

const ExtraLargeCardWithRightText = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
ExtraLargeCardWithRightText.args = {
  ...globalData,
  ...data,
  alignment: 'right',
  modifier_classes: 'c-card--xlarge',
  media: '<img src="https://picsum.photos/id/944/1340/600" alt="">',
};

const ExtraLargeCardWithLeftText = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
ExtraLargeCardWithLeftText.args = {
  ...ExtraLargeCardWithRightText.args,
  alignment: 'left',
};

const BioCard = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
BioCard.args = { ...globalData, ...bioCardData };

const LargeBioCard = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
LargeBioCard.args = {
  ...globalData,
  ...bioCardData,
  modifier_classes: 'c-card--bio c-card--bio-large',
};

export default settings;
export {
  Default,
  LargeCard,
  VideoCard,
  EventCard,
  EventFallbackCard,
  TeaserCard,
  EventTeaserCard,
  ExtraLargeCardWithRightText,
  ExtraLargeCardWithLeftText,
  BioCard,
  LargeBioCard,
};
