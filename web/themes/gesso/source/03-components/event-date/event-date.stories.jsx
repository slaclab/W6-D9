import parse from 'html-react-parser';

import twigTemplate from './event-date.twig';
import data from './event-date.yml';

const settings = {
  title: 'Components/Event Date'
};

const EventDate = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
EventDate.args = { ...data };

export default settings;
export { EventDate };
