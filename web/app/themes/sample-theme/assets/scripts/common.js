import {menuLogic as initMenuItems} from './util/menu';
import {modalLogic as initModals} from './util/modals';
import {dropDownLogic as initDropdowns} from './util/dropDown';

export default {
  // JavaScript to be fired on all pages
  init() {
    // Initialise
    // - menu logic
    // - header BG colour change on scroll
    // - SemanticUI modal logic for forms and videos
    // - SemanticUI dropdown logic for all select fields
    initMenuItems();
    initModals();
    initDropdowns();
  },
  // JavaScript to be fired on all pages, after page specific JS is fired
  finalize() {
    // Stupid IE10 detection
    /* eslint-disable */
    if (/*@cc_on!@*/false) {
      document.body.className += ' h-ie10';
    }
    /* eslint-enable */
  },
};
