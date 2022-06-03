import React from 'react';
import ReactDOMServer from 'react-dom/server';
import parse from 'html-react-parser';

import globalData from '../00-config/storybook.global-data.yml';
import PageWrapper from './page-wrappers/default.jsx';
import twigTemplate from '../04-templates/page/page.twig';
import sectionTwigTemplate from '../02-layouts/section/section.twig';
import { ArticleHero } from '../03-components/article-hero/article-hero.stories';
import { Quote } from '../03-components/quote/quote.stories';
import { FiftyFiftyLeftFadeIn } from '../03-components/fifty-fifty/fifty-fifty.stories';
import { WYSIWYG } from '../03-components/wysiwyg/wysiwyg.stories';
import { SectionWithBlueGreenGradient } from '../02-layouts/section/section.stories';

export default {
  title: 'Pages/Article',
  parameters: {
    controls: {
      include: ['show_admin_info'],
    },
  },
};

// For an example of reusing the same content as the Article component,
// see Page page.
const articleDemoContent = `
  ${ReactDOMServer.renderToStaticMarkup(
    WYSIWYG({
      content: `<p>Scientists have taken a major step forward in harnessing machine learning to accelerate the design for better batteries: Instead of using it just to speed up scientific analysis by looking for patterns in data, as researchers generally do, they combined it with knowledge gained from experiments and equations guided by physics to discover and explain a process that shortens the lifetimes of fast-charging lithium-ion batteries.</p>
  <p>It was the first time this approach, known as “scientific machine learning,” has been applied to battery cycling, said Will Chueh, an associate professor at Stanford University and investigator with the Department of Energy’s SLAC National Accelerator Laboratory who led the study. </p>
  <p>The research, reported today in Nature Materials, is the latest result from a collaboration between Stanford, SLAC, the Massachusetts Institute of Technology and Toyota Research Institute (TRI). The goal is to bring together foundational research and industry know-how to develop a long-lived electric vehicle battery that can be charged in 10 minutes.</p>`,
    })
  )}
  ${ReactDOMServer.renderToStaticMarkup(Quote(Quote.args))}
  ${ReactDOMServer.renderToStaticMarkup(
    WYSIWYG({
      content: `<p>“Battery technology is important for any type of electric powertrain," said Patrick Herring, senior research scientist for Toyota Research Institute. “By understanding the fundamental reactions that occur within the battery we can extend its life, enable faster charging and ultimately design better battery materials. We look forward to building on this work through future experiments to achieve lower-cost, better-performing batteries.”</p>
  <h2>A trio of advances</h2>
  <p>The new study builds on two previous advances where the group used more conventional forms of machine learning to dramatically accelerate both battery testing and the process of winnowing down many possible charging methods to find the ones that work best.</p>`,
    })
  )}
  ${sectionTwigTemplate({
    no_padding: true,
    section_content: ReactDOMServer.renderToStaticMarkup(
      FiftyFiftyLeftFadeIn({
        ...FiftyFiftyLeftFadeIn.args,
        has_constrain: true,
      })
    ),
  })}
  ${ReactDOMServer.renderToStaticMarkup(
    WYSIWYG({
      content: `  <p>While these studies allowed researchers to make much faster progress – reducing the time needed to determine battery lifetimes by 98%, for instance – they didn’t reveal the underlying physics or chemistry that made some batteries last longer than others, as the latest study did.</p>
  <h3>Combining all three approaches</h3>
  <p>Combining all three approaches could potentially slash the time needed to bring a new battery technology from the lab bench to the consumer by as much as two-thirds, Chueh said.</p>
  <p>“In this case, we are teaching the machine how to learn the physics of a new type of failure mechanism that could help us design better and safer fast-charging batteries,” Chueh said. “Fast charging is incredibly stressful and damaging to batteries, and solving this problem is key to expanding the nation’s fleet of electric vehicles as part of the overall strategy for fighting climate change.”</p>
  <p>The new combined approach can also be applied to developing the grid-scale battery systems needed for a greater deployment of wind and solar electricity, which will become even more urgent as the nation pursues recently announced Biden Administration goals of eliminating fossil fuels from electric power generation by 2035 and achieving net-zero carbon emissions by 2050.</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis, lectus magna fringilla urna, porttitor rhoncus dolor purus non enim praesent elementum facilisis leo, vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in ornare quam viverra orci sagittis eu volutpat odio. </p>
  <p>Facilisis mauris sit amet massa vitae tortor condimentum lacinia quis vel eros donec ac odio tempor orci dapibus ultrices in iaculis nunc sed augue lacus, viverra vitae congue eu, consequat ac felis donec et odio pellentesque diam volutpat commodo sed</p>
  <p>Facilisis mauris sit amet massa vitae tortor condimentum lacinia quis vel eros donec ac odio tempor orci dapibus ultrices in iaculis nunc sed augue lacus, viverra vitae congue eu, consequat ac felis donec et odio pellentesque diam volutpat commodo sed</p>`,
    })
  )}
`;

// For an example of customizing the content block on a demo page,
// see Page.
const articleContent = args =>
  twigTemplate({
    ...args,
    title:
      'In a leap for battery research, machine learning gets scientific smarts',
    date_format: 'medium-date',
    year: {
      long: '2021',
    },
    month: {
      long: 'March',
    },
    day: {
      short: '8',
    },
    author_name: 'Glennda Chui',
    content: articleDemoContent,
    lede: '<p>The latest advance from a research collaboration with industry could dramatically accelerate the development of sturdier batteries for fast-charging electric vehicles.</p>',
    toc_links: [
      {
        url: '#0',
        title: 'A trio of advances',
      },
      {
        url: '#1',
        title: 'Zooming in for closeups',
      },
      {
        url: '#2',
        title: 'The-rich-get-richer effect',
      },
      {
        url: '#3',
        title: 'Image Gallery',
      },
    ],
  });

const Article = args => (
  <PageWrapper hero={ArticleHero(ArticleHero.args)}>
    {parse(articleContent(args))}
    {SectionWithBlueGreenGradient(SectionWithBlueGreenGradient.args)}
  </PageWrapper>
);
Article.args = {
  ...globalData,
};

export { Article };
