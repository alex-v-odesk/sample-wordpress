import {getGeoData as user} from './ipAddressGeoLocate';
import {ArrayFrom} from './polyfills';

// Polyfill our stupid IE friend
if (!Array.from) {
  Array.from = new ArrayFrom();
}

function dropDownLogic() {
  // Initialise all Semantic UI dropdowns, mainly for <select> elements
  // Autofill country field
  (function () {
    Array.from(document.querySelectorAll('.dropdown'))
      .forEach(filter => {
        if (filter.getAttribute('name') == 'countryCode') {
          $(filter).dropdown('set selected', user.country_code);
        } else {
          $(filter).dropdown();
        }
      });
  })();

  // Initialise filters based on taxonomy
  (function () {
    Array.from(document
      .querySelectorAll('.js-filter'))
        .forEach(filter => {
          // Non-jquery method
          // filter.addEventListener('change', (select) => {
          //   const url = select.target.selectedOptions[0].value;
          // });
          Array.from(
            filter.querySelectorAll('.dropdown'))
              .forEach(select => {
                $(select).dropdown({
                  onChange: (value) => {
                    const url = value;
                    if (url!='') {
                      window.location.href = url;
                    } else {
                      alert('Please allow popups for this website, or open this page manually:' + url);
                    }
                  },
              });
            });
        });
  })();
}

export {dropDownLogic}
