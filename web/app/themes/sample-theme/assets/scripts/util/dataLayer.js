// GA events push into GTM dataLayer

function sendEvents(form, type) {
  window.dataLayer.push({
    'event': 'formSubmission',
    'formLabel': type + ' Form Submit Button',
    'formPage': window.location.pathname,
    'formActionType': form.querySelector('input[name=actionType]').value,
    'formContactType': form.querySelector('input[name=contactTypeCode]').value,
  });
  window.google_trackConversion({
    google_conversion_id: 123,
    google_remarketing_only: false,
  });
}

// GA and AdWords events
function sendDemo() {
  dataLayer.push({
    'event': 'Trigger Demo',
    'formLabel': 'Header Evaluation Button',
    'formPage': window.location.pathname,
  });
}

export {sendEvents, sendDemo}
