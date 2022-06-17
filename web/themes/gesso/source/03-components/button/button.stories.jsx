import parse from 'html-react-parser';

import twigTemplate from './button.twig';
import data from './button.yml';

const settings = {
  title: 'Components/Button',
};

const Primary = args =>
  parse(
    twigTemplate({
      ...args,
    })
  );
Primary.args = { ...data };

const Secondary = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--secondary',
    })
  );
Secondary.args = { ...data };

const Outline = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--outline',
    })
  );
Outline.args = { ...data };

const OutlineSecondary = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--outline-secondary',
    })
  );
OutlineSecondary.args = { ...data };

const Base = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--base',
    })
  );
Base.args = { ...data };

const Danger = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--danger',
    })
  );
Danger.args = { ...data };

const Small = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--small',
    })
  );
Small.args = { ...data };

const Large = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--large',
    })
  );
Large.args = { ...data };


const Chevron = args =>
  parse(
    twigTemplate({
      ...args,
      modifier_classes: 'c-button--chevron',
    })
  );
Chevron.args = { ...data };

export default settings;
export {
  Primary,
  Secondary,
  Outline,
  OutlineSecondary,
  Base,
  Danger,
  Large,
  Small,
  Chevron,
};
