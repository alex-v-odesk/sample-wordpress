import {validation} from '../util/validation';
import {getGeoData as user} from './ipAddressGeoLocate';
import {sendToMarketo} from './munchkin.js';
import {processForm} from './processForm';
import {sendEvents} from './dataLayer';
import {ArrayFrom} from './polyfills';

// Polyfill our stupid IE friend
if (!Array.from) {
  Array.from = new ArrayFrom();
}

export default {
  init() {
    // Find all non-modal forms on the page
    const inlineForms = document.querySelectorAll('.js-form-inline');

    // Process each form
    Array.from(inlineForms, form => {
      $(form).form({
        selector: {
          field: 'input, textarea, select',
          group: '.field',
          input: 'input',
        },
        fields: validation,
        onSuccess: () => {
          processForm(form, false, user.country_name);
          sendToMarketo(form);
          sendEvents(form, 'Inline');
          return false;
        },
      });
    });
  },
};
