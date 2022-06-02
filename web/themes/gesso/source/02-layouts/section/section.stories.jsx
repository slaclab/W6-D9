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

const Section = args =>
  parse(
    twigTemplate({
      ...args,
      section_content: SectionContent,
    })
  );
Section.args = { ...data };

export default settings;
export { Section };
