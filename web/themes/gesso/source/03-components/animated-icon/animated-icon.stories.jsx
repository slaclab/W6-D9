import parse from 'html-react-parser';

import twigTemplate from './animated-icon.twig';
import globalData from '../../00-config/storybook.global-data.yml';
import data from './animated-icon.yml';
import './animated-icon.es6';

const settings = {
  title: 'Components/Animated Icon',
};

const AnimatedIcon = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
AnimatedIcon.args = { ...globalData, ...data };

export default settings;
export { AnimatedIcon };
