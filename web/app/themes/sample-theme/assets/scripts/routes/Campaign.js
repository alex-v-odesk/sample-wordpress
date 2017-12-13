export default {
  init() {

    // Strip styles from embedded Marketo forms
    function removeMarketoStyles (form) {
      form.removeAttribute('style');
      // Strip inline styles
      Array.from(form.querySelectorAll('*'))
        .forEach(el => {
          el.removeAttribute('style')
        });
      // Disable stylesheets that Forms 2.0 loads
      Array.from(document.styleSheets)
      .forEach(stylesheet => {
        let stylesheetLocation = document.createElement('A');
        stylesheetLocation.href = stylesheet.href;
        if (/.marketo.com$/.test(stylesheetLocation.hostname)) {
          stylesheet.disabled = !0
        } else if ((stylesheet.ownerNode || stylesheet.owningElement).parentNode == form) {
          stylesheet.disabled = !0
        }
      });
      form.setAttribute('data-styles-ready', '');
    }

    // Add wrapper with Semantic UI classes to each input + label pair
    function addRadioWrapper (form) {
      Array.from(form.querySelectorAll('.mktoRadioList input[type=radio]'))
      .forEach(radio => {
        let label = radio.nextElementSibling;
        let wrapper = document.createElement('div');
        wrapper.classList.add('ui', 'radio', 'checkbox');
        radio.parentNode.insertBefore(wrapper, radio);
        wrapper.appendChild(radio);
        wrapper.appendChild(label);
      });
    }

    // Find all forms when Forms 2.0 API is available and strip 'em clean
    MktoForms2.whenReady( () => {
      Array.from(document.querySelectorAll('.mktoForm'))
      .forEach(form => {
        removeMarketoStyles(form);
        addRadioWrapper(form);
      });
    });
  },
  finalize() {
  },
}
