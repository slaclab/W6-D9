import parse from 'html-react-parser';

import ReactDOMServer from 'react-dom/server';
import React from 'react';
import twigTemplate from './header.twig';
import data from './header.yml';
import { MegaMenu } from '../../03-components/mega-menu/mega-menu.stories';
import './header.es6';

const settings = {
  title: 'Layouts/Header',
  argTypes: {
    is_demo: {
      table: {
        disable: true,
      },
    },
  },
};

const Header = args =>
  parse(
    twigTemplate({
      ...args,
      header_content: ReactDOMServer.renderToStaticMarkup(
        <>{MegaMenu(MegaMenu.args)}</>
      ),
    })
  );
Header.args = { ...data };

export default settings;
export { Header };
