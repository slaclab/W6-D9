import parse from 'html-react-parser';

import twigTemplate from './figure.twig';
import data from './figure.yml';
import videoData from './figure--iframe.yml';
import globalData from '../../00-config/storybook.global-data.yml';


const settings = {
  title: 'Components/Figure',
};

const Default = args => (
  parse(twigTemplate({
    ...args,
  }))
);
Default.args = { ...data };

const FigureCentered = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-center',
  }))
);
FigureCentered.args = { ...data };

const FigureCenteredWide = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-center u-align-wide',
  }))
);
FigureCenteredWide.args = { ...data };

const FigureLeftAligned = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-left',
  }))
);
FigureLeftAligned.args = { ...data };

const FigureRightAligned = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-right',
  }))
);
FigureRightAligned.args = { ...data };

const FigureWithVideo = args => (
  parse(twigTemplate({
    ...args,
  }))
);
FigureWithVideo.args = { ...videoData, ...globalData };

const FigureWithVideoCentered = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-center',
  }))
);
FigureWithVideoCentered.args = { ...videoData, ...globalData };

const FigureWithVideoLeftAligned = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-left',
  }))
);
FigureWithVideoLeftAligned.args = { ...videoData, ...globalData };

const FigureWithVideoRightAligned = args => (
  parse(twigTemplate({
    ...args,
    modifier_classes: 'u-align-right',
  }))
);
FigureWithVideoRightAligned.args = { ...videoData, ...globalData };

export default settings;
export { Default, FigureCentered, FigureCenteredWide, FigureLeftAligned, FigureRightAligned, FigureWithVideo, FigureWithVideoCentered, FigureWithVideoLeftAligned, FigureWithVideoRightAligned };
