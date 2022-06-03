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

export default settings;
export { Section, SectionWithBackgroundImage };
