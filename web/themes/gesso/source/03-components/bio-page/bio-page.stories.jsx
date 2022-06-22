import parse from 'html-react-parser';

import twigTemplate from './bio-page.twig';
import data from './bio-page.yml';

const settings = {
  title: 'Components/Bio Page'
};

const BioPage = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
BioPage.args = { ...data };

export default settings;
export { BioPage };
