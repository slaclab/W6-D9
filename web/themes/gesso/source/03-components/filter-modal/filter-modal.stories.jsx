import parse from 'html-react-parser';
import React from 'react';
import ReactDOMServer from 'react-dom/server';

import twigTemplate from './filter-modal.twig';
// import inputTemplate from '../form-item/form-item.twig';
// import labelTemplate from '../form-item/_input.twig';
import { Checkbox } from '../form-item/form-item--checkbox/form-item--checkbox.stories';
import { Radio } from '../form-item/form-item--radio/form-item--radio.stories';
import data from './filter-modal.yml';
import globalData from '../../00-config/storybook.global-data.yml';

const settings = {
  title: 'Components/Filter Modal'
};

const filterByType = ReactDOMServer.renderToStaticMarkup(
  <>
    {Radio({
      ...Radio.args,
      title: 'News',
      id: 'type-1',
      name: 'type',
    })}
    {Radio({
      ...Radio.args,
      title: 'Events',
      id: 'type-2',
      name: 'type',
    })}
    {Radio({
      ...Radio.args,
      title: 'Images',
      id: 'type-3',
      name: 'type',
    })}
    {Radio({
      ...Radio.args,
      title: 'Video',
      id: 'type-3',
      name: 'type',
    })}
  </>
);

const filterByArea = ReactDOMServer.renderToStaticMarkup(
  <>
    {Checkbox({
      ...Checkbox.args,
      title: 'X-Ray & Ultrafast Science',
      id: 'checkbox-1',
    })}
    {Checkbox({
      ...Checkbox.args,
      title: 'Physics of the Universe',
      id: 'checkbox-2',
    })}
    {Checkbox({
      ...Checkbox.args,
      title: 'Science of Life',
      id: 'checkbox-3',
    })}
  </>
);

const sortBy = ReactDOMServer.renderToStaticMarkup(
  <>
    {Radio({
      ...Radio.args,
      title: 'Relevancy',
      id: 'sort-1',
      name: 'sort',
      is_checked: true,
    })}
    {Radio({
      ...Radio.args,
      title: 'Newest',
      id: 'sort-2',
      name: 'sort',
    })}
    {Radio({
      ...Radio.args,
      title: 'Oldest',
      id: 'sort-3',
      name: 'sort',
    })}
  </>
);

const FilterModal = args =>
  parse(
    twigTemplate({
      ...args,
      filter_by_area: filterByArea,
      filter_by_type: filterByType,
      sort_by: sortBy,
    })
  );
FilterModal.args = { ...globalData, ...data };

export default settings;
export { FilterModal };
