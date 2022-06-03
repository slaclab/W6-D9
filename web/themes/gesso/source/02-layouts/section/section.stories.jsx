import parse from 'html-react-parser';

import ReactDOMServer from 'react-dom/server';
import React from 'react';
import twigTemplate from './section.twig';
import gridTemplate from '../grid/grid.twig';
import data from './section.yml';
import { Default as Card } from '../../03-components/card/card.stories';

const settings = {
  title: 'Layouts/Section',
  argTypes: {
    is_demo: {
      table: {
        disable: true,
      },
    },
  },
};

const SectionContent = gridTemplate({
  grid_content: ReactDOMServer.renderToStaticMarkup(
    <>
      {Card(Card.args)}
      {Card(Card.args)}
      {Card(Card.args)}
    </>
  ),
  num_of_cols: 3,
});

const Template = args =>
  parse(
    twigTemplate({
      ...args,
      section_content: SectionContent,
    })
  );

const Section = Template.bind({});
Section.args = { ...data };

const SectionWithBackgroundImage = Template.bind({});
SectionWithBackgroundImage.args = {
  ...data,
  modifier_classes: 'l-section--dark l-section--bg-image',
};

const SectionWithPurpleBlackGradient = Template.bind({});
SectionWithPurpleBlackGradient.args = {
  ...data,
  modifier_classes: 'l-section--dark l-section--purple-black',
  section_buttons: `
    <a href="#0" class="c-button c-button--secondary">Button 1</a>
    <a href="#1" class="c-button c-button--secondary">Button 2</a>
  `,
};

const SectionWithBlueGreenGradient = Template.bind({});
SectionWithBlueGreenGradient.args = {
  ...data,
  modifier_classes: 'l-section--dark l-section--blue-green',
  section_buttons: `
    <a href="#0" class="c-button c-button--secondary">Button 1</a>
    <a href="#1" class="c-button c-button--secondary">Button 2</a>
  `,
};

const SectionWithCutout = Template.bind({});
SectionWithCutout.args = {
  ...data,
  modifier_classes: 'l-section--dark l-section--cutout',
  section_buttons: `
    <a href="#0" class="c-button c-button--secondary">Button 1</a>
    <a href="#1" class="c-button c-button--secondary">Button 2</a>
  `,
};

const SectionWithPattern = Template.bind({});
SectionWithPattern.args = {
  ...data,
  modifier_classes: 'l-section--pattern',
};

const SectionWithYellowBackground = Template.bind({});
SectionWithYellowBackground.args = {
  ...data,
  modifier_classes: 'l-section--yellow',
};

const SectionWithGrayGradient = Template.bind({});
SectionWithGrayGradient.args = {
  ...data,
  modifier_classes: 'l-section--gray-gradient',
};

const SectionWithPurpleBackground = Template.bind({});
SectionWithPurpleBackground.args = {
  ...data,
  modifier_classes: 'l-section--dark l-section--purple',
  section_buttons: `
    <a href="#0" class="c-button c-button--secondary">Button 1</a>
    <a href="#1" class="c-button c-button--secondary">Button 2</a>
  `,
};

const SectionWithBlueBackground = Template.bind({});
SectionWithBlueBackground.args = {
  ...data,
  modifier_classes: 'l-section--dark l-section--blue',
  section_buttons: `
    <a href="#0" class="c-button c-button--secondary">Button 1</a>
    <a href="#1" class="c-button c-button--secondary">Button 2</a>
  `,
};

export default settings;
export {
  Section,
  SectionWithBackgroundImage,
  SectionWithPurpleBlackGradient,
  SectionWithBlueGreenGradient,
  SectionWithCutout,
  SectionWithPattern,
  SectionWithYellowBackground,
  SectionWithGrayGradient,
  SectionWithPurpleBackground,
  SectionWithBlueBackground,
};
