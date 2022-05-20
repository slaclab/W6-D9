import React from 'react';
import ReactDOMServer from 'react-dom/server';
import parse from 'html-react-parser';

import globalData from '../../00-config/storybook.global-data.yml';
import RegionTwig from '../../02-layouts/region/region.twig';
import SkiplinksTwig from '../../03-components/skiplinks/skiplinks.twig';
import HeaderTwig from '../../02-layouts/header/header.twig';
import BreadcrumbTwig from '../../02-layouts/breadcrumb/breadcrumb.twig';
import ContentTwig from '../../02-layouts/content/content.twig';
import { SiteName } from '../../03-components/site-name/site-name.stories.jsx';
import NavTwig from '../../02-layouts/nav/nav.twig';
import { AccountMenu } from '../../03-components/menu/menu--account/menu--account.stories.jsx';
import { DropdownMenu } from '../../03-components/dropdown-menu/dropdown-menu.stories.jsx';
import { Breadcrumb } from '../../03-components/breadcrumb/breadcrumb.stories.jsx';
import { BackToTop } from '../../03-components/back-to-top/back-to-top.stories.jsx';
import { Footer } from '../../02-layouts/footer/footer.stories.jsx';
import { Subfooter } from '../../02-layouts/subfooter/subfooter.stories';

const PageWrapper = props => {
  // eslint-disable-next-line react/prop-types
  const { children } = props;
  return (
    <>
      {parse(SkiplinksTwig())}
      <div className="l-site-container">
        {parse(
          HeaderTwig({
            has_constrain: true,
            header_content: ReactDOMServer.renderToStaticMarkup(
              <>
                {parse(
                  NavTwig({
                    modifier_classes: 'l-nav--account',
                    title: 'User account menu',
                    hide_title: true,
                    nav_id: 'nav-account',
                    nav_content: ReactDOMServer.renderToStaticMarkup(
                      <>{AccountMenu(AccountMenu.args)}</>
                    ),
                  })
                )}
                {SiteName(globalData)}
              </>
            ),
          })
        )}
        {parse(
          RegionTwig({
            region_name: 'navigation',
            has_constrain: true,
            region_content: ReactDOMServer.renderToStaticMarkup(
              <>
                {parse(
                  NavTwig({
                    modifier_classes: 'l-nav--main',
                    title: 'Main navigation',
                    hide_title: true,
                    nav_id: 'nav-main',
                    nav_content: ReactDOMServer.renderToStaticMarkup(
                      <>{DropdownMenu(DropdownMenu.args)}</>
                    ),
                  })
                )}
              </>
            ),
          })
        )}
        {parse(
          BreadcrumbTwig({
            has_constrain: false,
            breadcrumb_content: ReactDOMServer.renderToStaticMarkup(
              <>{Breadcrumb(Breadcrumb.args)}</>
            ),
          })
        )}
        <main id="main" className="c-main" role="main" tabIndex="-1">
          {parse(
            ContentTwig({
              has_constrain: true,
              content_content: ReactDOMServer.renderToStaticMarkup(
                <>{children}</>
              ),
            })
          )}
        </main>
        {Footer(Footer.args)}
        {Subfooter(Subfooter.args)}
      </div>
      {BackToTop({
        ...BackToTop.args,
        top_element: 'top',
        is_demo: false,
      })}
    </>
  );
};

export default PageWrapper;
