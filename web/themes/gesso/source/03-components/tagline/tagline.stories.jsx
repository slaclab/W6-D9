import parse from 'html-react-parser';

import twigTemplate from './tagline.twig';
import data from './tagline.yml';

const settings = {
  title: 'Components/Tagline'
};

const Tagline = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
Tagline.args = { ...data };

export default settings;
export { Tagline };
