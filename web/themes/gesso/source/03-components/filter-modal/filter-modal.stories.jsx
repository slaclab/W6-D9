import parse from 'html-react-parser';
import React from 'react';
import ReactDOMServer from 'react-dom/server';

import twigTemplate from './filter-modal.twig';
// import inputTemplate from '../form-item/form-item.twig';
// import labelTemplate from '../form-item/_input.twig';
import { Checkboxes } from '../form-item/form-item--checkboxes/form-item--checkboxes.stories';
import data from './filter-modal.yml';

const settings = {
  title: 'Components/Filter Modal'
};

const FilterModal = args =>
  parse(
    twigTemplate({
      ...args,
      filter_by_area: ReactDOMServer.renderToStaticMarkup(<Checkboxes/>)
    })
  );
FilterModal.args = { ...data };

export default settings;
export { FilterModal };
