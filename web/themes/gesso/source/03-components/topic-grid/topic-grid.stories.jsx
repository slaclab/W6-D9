import parse from 'html-react-parser';

import twigTemplate from './topic-grid.twig';
import data from './topic-grid.yml';

const settings = {
  title: 'Components/Topic Grid'
};

const TopicGrid = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
TopicGrid.args = { ...data };

export default settings;
export { TopicGrid };
