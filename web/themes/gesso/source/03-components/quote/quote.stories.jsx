import parse from 'html-react-parser';

import twigTemplate from './quote.twig';
import data from './quote.yml';

const settings = {
  title: 'Components/Quote'
};

const Quote = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
Quote.args = { ...data };

export default settings;
export { Quote };
