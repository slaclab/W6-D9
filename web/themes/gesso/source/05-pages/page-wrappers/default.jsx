import React from 'react';
import ReactDOMServer from 'react-dom/server';
import parse from 'html-react-parser';

import globalData from '../../00-config/storybook.global-data.yml';
import RegionTwig from '../../02-layouts/region/region.twig';
import SkiplinksTwig from '../../03-components/skiplinks/skiplinks.twig';
import BreadcrumbTwig from '../../02-layouts/breadcrumb/breadcrumb.twig';
import ContentTwig from '../../02-layouts/content/content.twig';
import { Breadcrumb } from '../../03-components/breadcrumb/breadcrumb.stories.jsx';
import { BackToTop } from '../../03-components/back-to-top/back-to-top.stories.jsx';
import { Footer } from '../../02-layouts/footer/footer.stories.jsx';
import { Subfooter } from '../../02-layouts/subfooter/subfooter.stories';
import { Header } from '../../02-layouts/header/header.stories';
import { SocialShare } from '../../03-components/social-share/social-share.stories';

const PageWrapper = props => {
  // eslint-disable-next-line react/prop-types
  const { hideSocialLinks, hero, children } = props;
  return (
    <>
      {parse(SkiplinksTwig())}
      {Header(Header.args)}
      <div className="l-site-container">
        {hero}
        <main id="main" className="c-main" role="main" tabIndex="-1">
          <div className="c-main__meta">
            {parse(
              BreadcrumbTwig({
                has_constrain: false,
                breadcrumb_content: ReactDOMServer.renderToStaticMarkup(
                  <>{Breadcrumb(Breadcrumb.args)}</>
                ),
              })
            )}
            {!hideSocialLinks && SocialShare(SocialShare.args)}
          </div>
          {parse(
            ContentTwig({
              has_constrain: false,
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
