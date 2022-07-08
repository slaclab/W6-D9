/* eslint-disable camelcase */

import parse from 'html-react-parser';
import React from 'react';

import twigTemplate from './video-lightbox.twig';
import data from './video-lightbox.yml';
import './video-lightbox.scss';
import './video-lightbox.es6';

const settings = {
  title: 'Components/Video Lightbox',
};

const VideoLightbox = args => {
  const { lightbox_id } = args;
  return (
    <>
      <button
        type="button"
        aria-controls={lightbox_id}
        className="js-video-lightbox"
      >
        Trigger Lightbox
      </button>
      {parse(
        twigTemplate({
          ...args,
        })
      )}
    </>
  );
};
VideoLightbox.args = { ...data };

export default settings;
export { VideoLightbox };
